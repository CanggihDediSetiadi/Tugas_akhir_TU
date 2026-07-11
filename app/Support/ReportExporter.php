<?php

namespace App\Support;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use ZipArchive;

class ReportExporter
{
    public static function download(array $rows, string $baseName, string $format, array $meta = [])
    {
        $format = strtolower($format ?: 'csv');
        return match ($format) {
            'xlsx', 'excel' => self::xlsx($rows, $baseName),
            'word', 'doc', 'docx' => self::word($rows, $baseName),
            'pdf' => self::pdf($rows, $baseName, $meta),
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

    public static function pdf(array $rows, string $baseName, array $meta = [])
    {
        // Pisahkan header (baris pertama) dari data
        $headers = count($rows) > 0 ? array_shift($rows) : [];

        // Parse nama file jadi judul yang lebih bersih
        // baseName format: rekap-surat_masuk-20260711-103254
        $parts       = explode('-', $baseName);
        $tipePart    = $parts[1] ?? 'laporan';
        $judulMap    = [
            'surat_masuk'  => 'Surat Masuk',
            'surat keluar' => 'Surat Keluar',
            'surat_keluar' => 'Surat Keluar',
            'disposisi'    => 'Disposisi',
        ];
        $judulLaporan = $judulMap[$tipePart] ?? Str::title(str_replace(['_', '-'], ' ', $tipePart));

        $pdf = Pdf::loadView('pdf.rekap', [
            'judulLaporan' => $judulLaporan,
            'headers'      => $headers,
            'rows'         => $rows,
            'periodeAwal'  => $meta['mulai'] ?? null,
            'periodeAkhir' => $meta['selesai'] ?? null,
            'klasifikasi'  => $meta['klasifikasi'] ?? null,
        ])
        ->setPaper('a4', 'portrait')
        ->setOption('isHtml5ParserEnabled', true)
        ->setOption('isRemoteEnabled', true)
        ->setOption('defaultFont', 'DejaVu Sans');

        return response($pdf->output(), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $baseName . '.pdf"',
        ]);
    }

    private static function col(int $index): string
    {
        $letters = '';
        while ($index > 0) { $index--; $letters = chr(65 + ($index % 26)) . $letters; $index = intdiv($index, 26); }
        return $letters;
    }
}