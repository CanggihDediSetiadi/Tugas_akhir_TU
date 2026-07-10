<?php

namespace App\Support;

use Illuminate\Support\Str;
use ZipArchive;

class ReportExporter
{
    public static function download(array $rows, string $baseName, string $format)
    {
        $format = strtolower($format ?: 'csv');
        return match ($format) {
            'xlsx', 'excel' => self::xlsx($rows, $baseName),
            'word', 'doc', 'docx' => self::word($rows, $baseName),
            'pdf' => self::pdf($rows, $baseName),
            default => self::csv($rows, $baseName),
        };
    }

    public static function csv(array $rows, string $baseName)
    {
        return response()->streamDownload(function () use ($rows) {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            foreach ($rows as $row) fputcsv($handle, $row);
            fclose($handle);
        }, $baseName . '.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    public static function word(array $rows, string $baseName)
    {
        $html = '<html><head><meta charset="utf-8"><style>table{border-collapse:collapse;width:100%;font-family:Arial;font-size:12px}th,td{border:1px solid #999;padding:6px}th{background:#eaf2ff}</style></head><body>';
        $html .= '<h2>' . e(str_replace('-', ' ', Str::title($baseName))) . '</h2><table>';
        foreach ($rows as $i => $row) {
            $html .= '<tr>';
            foreach ($row as $cell) $html .= ($i === 0 ? '<th>' : '<td>') . e((string) $cell) . ($i === 0 ? '</th>' : '</td>');
            $html .= '</tr>';
        }
        $html .= '</table></body></html>';
        return response($html, 200, [
            'Content-Type' => 'application/msword; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $baseName . '.doc"',
        ]);
    }

    public static function xlsx(array $rows, string $baseName)
    {
        $tmp = tempnam(sys_get_temp_dir(), 'xlsx_');
        $zip = new ZipArchive();
        $zip->open($tmp, ZipArchive::OVERWRITE);
        $zip->addFromString('[Content_Types].xml', '<?xml version="1.0" encoding="UTF-8"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml"/><Default Extension="xml" ContentType="application/xml"/><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml"/><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml"/></Types>');
        $zip->addFromString('_rels/.rels', '<?xml version="1.0" encoding="UTF-8"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/></Relationships>');
        $zip->addFromString('xl/workbook.xml', '<?xml version="1.0" encoding="UTF-8"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><sheets><sheet name="Rekap" sheetId="1" r:id="rId1"/></sheets></workbook>');
        $zip->addFromString('xl/_rels/workbook.xml.rels', '<?xml version="1.0" encoding="UTF-8"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/></Relationships>');
        $sheet = '<?xml version="1.0" encoding="UTF-8"?><worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main"><sheetData>';
        foreach ($rows as $r => $row) {
            $sheet .= '<row r="' . ($r + 1) . '">';
            foreach ($row as $c => $cell) {
                $ref = self::col($c + 1) . ($r + 1);
                $sheet .= '<c r="' . $ref . '" t="inlineStr"><is><t>' . htmlspecialchars((string) $cell, ENT_XML1 | ENT_COMPAT, 'UTF-8') . '</t></is></c>';
            }
            $sheet .= '</row>';
        }
        $sheet .= '</sheetData></worksheet>';
        $zip->addFromString('xl/worksheets/sheet1.xml', $sheet);
        $zip->close();
        return response()->download($tmp, $baseName . '.xlsx', ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])->deleteFileAfterSend(true);
    }

    public static function pdf(array $rows, string $baseName)
    {
        $lines = [strtoupper(str_replace('-', ' ', $baseName)), ''];
        foreach ($rows as $row) $lines[] = implode(' | ', array_map(fn ($v) => (string) $v, $row));
        $content = self::pdfContent($lines);
        return response($content, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $baseName . '.pdf"',
        ]);
    }

    private static function pdfContent(array $lines): string
    {
        $text = "BT\n/F1 10 Tf\n50 790 Td\n";
        foreach (array_slice($lines, 0, 55) as $line) {
            $safe = str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], mb_strimwidth($line, 0, 115, '...'));
            $text .= '(' . $safe . ") Tj\n0 -14 Td\n";
        }
        $text .= "ET";
        $objects = [];
        $objects[] = '1 0 obj << /Type /Catalog /Pages 2 0 R >> endobj';
        $objects[] = '2 0 obj << /Type /Pages /Kids [3 0 R] /Count 1 >> endobj';
        $objects[] = '3 0 obj << /Type /Page /Parent 2 0 R /MediaBox [0 0 595 842] /Resources << /Font << /F1 4 0 R >> >> /Contents 5 0 R >> endobj';
        $objects[] = '4 0 obj << /Type /Font /Subtype /Type1 /BaseFont /Helvetica >> endobj';
        $objects[] = '5 0 obj << /Length ' . strlen($text) . " >> stream\n" . $text . "\nendstream endobj";
        $pdf = "%PDF-1.4\n";
        $offsets = [0];
        foreach ($objects as $obj) { $offsets[] = strlen($pdf); $pdf .= $obj . "\n"; }
        $xref = strlen($pdf);
        $pdf .= "xref\n0 " . (count($objects) + 1) . "\n0000000000 65535 f \n";
        for ($i = 1; $i <= count($objects); $i++) $pdf .= str_pad((string) $offsets[$i], 10, '0', STR_PAD_LEFT) . " 00000 n \n";
        return $pdf . "trailer << /Size " . (count($objects) + 1) . " /Root 1 0 R >>\nstartxref\n" . $xref . "\n%%EOF";
    }

    private static function col(int $index): string
    {
        $letters = '';
        while ($index > 0) { $index--; $letters = chr(65 + ($index % 26)) . $letters; $index = intdiv($index, 26); }
        return $letters;
    }
}