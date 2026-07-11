<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Rekap {{ $judulLaporan }} - SMAN 4 Surabaya</title>
    @php
        // Helper: format tanggal ke bahasa Indonesia
        $bulanId = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $hariId  = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $fmtTgl = function($dateStr) use ($bulanId) {
            if (!$dateStr) return '-';
            $dt = \Carbon\Carbon::parse($dateStr);
            return $dt->day . ' ' . $bulanId[$dt->month] . ' ' . $dt->year;
        };
        $now = \Carbon\Carbon::now();
        $nowFmt = $now->day . ' ' . $bulanId[$now->month] . ' ' . $now->year;
        $nowHari = $hariId[$now->dayOfWeek];
    @endphp
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 10px;
            color: #1a1a2e;
            background: #fff;
        }

        /* ───── KOP SURAT ───── */
        .header-wrapper {
            border-bottom: 3px solid #003087;
            padding-bottom: 10px;
            margin-bottom: 14px;
        }
        .header-inner {
            display: table;
            width: 100%;
        }
        .logo-cell {
            display: table-cell;
            width: 75px;
            vertical-align: middle;
            text-align: center;
        }
        .logo-cell img {
            width: 65px;
            height: 65px;
            object-fit: contain;
        }
        .title-cell {
            display: table-cell;
            vertical-align: middle;
            padding-left: 10px;
        }
        .kop-sekolah {
            font-size: 20px;
            font-weight: bold;
            color: #003087;
            line-height: 1.1;
            letter-spacing: -0.01em;
        }
        .kop-alamat {
            font-size: 8.5px;
            color: #444;
            margin-top: 3px;
            line-height: 1.5;
        }
        .kop-akred {
            display: table-cell;
            width: 80px;
            vertical-align: middle;
            text-align: center;
        }
        .akred-box {
            border: 2px solid #003087;
            border-radius: 4px;
            padding: 4px 6px;
            display: inline-block;
        }
        .akred-label {
            font-size: 7px;
            color: #555;
            text-transform: uppercase;
        }
        .akred-value {
            font-size: 22px;
            font-weight: bold;
            color: #003087;
            line-height: 1;
        }

        /* ───── JUDUL DOKUMEN ───── */
        .doc-title-section {
            text-align: center;
            margin-bottom: 14px;
        }
        .doc-title {
            font-size: 13px;
            font-weight: bold;
            color: #003087;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .doc-subtitle {
            font-size: 9px;
            color: #555;
            margin-top: 3px;
        }
        .doc-divider {
            width: 100%;
            height: 1px;
            background: #003087;
            margin-top: 8px;
        }

        /* ───── INFO LAPORAN ───── */
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 14px;
            border: 1px solid #c8d4e8;
            border-radius: 4px;
            background: #f0f5ff;
        }
        .info-row {
            display: table-row;
        }
        .info-label {
            display: table-cell;
            width: 130px;
            padding: 5px 10px;
            font-size: 9px;
            font-weight: bold;
            color: #003087;
            border-bottom: 1px solid #c8d4e8;
        }
        .info-colon {
            display: table-cell;
            width: 12px;
            padding: 5px 0;
            font-size: 9px;
            color: #003087;
            border-bottom: 1px solid #c8d4e8;
        }
        .info-value {
            display: table-cell;
            padding: 5px 10px;
            font-size: 9px;
            color: #222;
            border-bottom: 1px solid #c8d4e8;
        }
        .info-row:last-child .info-label,
        .info-row:last-child .info-colon,
        .info-row:last-child .info-value {
            border-bottom: none;
        }

        /* ───── TABEL DATA ───── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table thead tr {
            background: #003087;
        }
        .data-table thead th {
            padding: 7px 5px;
            font-size: 7.5px;
            font-weight: bold;
            color: #ffffff;
            text-align: left;
            letter-spacing: 0.03em;
            text-transform: uppercase;
            border: 1px solid #002070;
        }
        .data-table thead th:first-child {
            border-radius: 4px 0 0 0;
        }
        .data-table thead th:last-child {
            border-radius: 0 4px 0 0;
        }
        .data-table tbody tr {
            background: #ffffff;
        }
        .data-table tbody tr.row-even {
            background: #f7f9ff;
        }
        .data-table tbody td {
            padding: 5px 5px;
            font-size: 8px;
            color: #222;
            border: 1px solid #d5dff0;
            vertical-align: top;
            word-break: break-word;
        }
        .data-table tbody tr:hover {
            background: #e8effc;
        }

        /* No. column */
        .col-no {
            width: 28px;
            text-align: center;
        }

        /* ───── STATUS BADGE ───── */
        .badge {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 10px;
            font-size: 8px;
            font-weight: bold;
        }
        .badge-sudah   { background: #d1fae5; color: #065f46; }
        .badge-belum   { background: #fee2e2; color: #991b1b; }
        .badge-proses  { background: #fef9c3; color: #854d0e; }
        .badge-penting { background: #fde68a; color: #78350f; }
        .badge-biasa   { background: #e0f2fe; color: #0c4a6e; }
        .badge-rahasia { background: #ffe4e6; color: #9f1239; }

        /* ───── KOSONG ───── */
        .empty-state {
            text-align: center;
            padding: 30px;
            font-size: 9px;
            color: #888;
        }

        /* ───── FOOTER ───── */
        .footer-section {
            border-top: 1px solid #c8d4e8;
            padding-top: 10px;
            margin-top: 10px;
        }
        .footer-inner {
            display: table;
            width: 100%;
        }
        .footer-left {
            display: table-cell;
            vertical-align: top;
            font-size: 8px;
            color: #777;
        }
        .footer-right {
            display: table-cell;
            width: 200px;
            vertical-align: top;
            text-align: center;
        }
        .sign-area {
            font-size: 9px;
            color: #222;
        }
        .sign-place-date {
            margin-bottom: 2px;
        }
        .sign-role {
            font-weight: bold;
            color: #003087;
        }
        .sign-line {
            margin-top: 50px;
            border-bottom: 1px solid #333;
            width: 140px;
            display: inline-block;
        }
        .sign-nip {
            font-size: 7.5px;
            color: #555;
            margin-top: 2px;
        }
        .page-info {
            font-size: 7.5px;
            color: #999;
            margin-top: 6px;
        }
        .print-timestamp {
            font-size: 7.5px;
            color: #aaa;
        }

        /* ───── HALAMAN BARU ───── */
        .page-break { page-break-after: always; }
    </style>
</head>
<body>

    {{-- ═══════════════════ KOP SURAT ═══════════════════ --}}
    <div class="header-wrapper">
        <div class="header-inner">
            {{-- Logo asli SMAN 4 Surabaya --}}
            <div class="logo-cell">
                <img src="{{ public_path('sman4-logo.png') }}" alt="Logo SMAN 4 Surabaya">
            </div>

            {{-- Nama Sekolah & Alamat --}}
            <div class="title-cell">
                <div class="kop-sekolah">SMA NEGERI 4 SURABAYA</div>
                <div class="kop-alamat">
                    Jl. Wijaya Kusuma No.48, Ketabang, Kec. Genteng, Kota Surabaya, Jawa Timur 60272<br>
                    Telp. (031) 5341929 &nbsp;|&nbsp; Email: sman4sby@gmail.com &nbsp;|&nbsp; Website: sman4surabaya.sch.id
                </div>
            </div>

            {{-- Akreditasi --}}
            <div class="kop-akred">
                <div class="akred-box">
                    <div class="akred-label">Akreditasi</div>
                    <div class="akred-value">A</div>
                    <div class="akred-label">Unggul</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════ JUDUL LAPORAN ═══════════════════ --}}
    <div class="doc-title-section">
        <div class="doc-title">LAPORAN REKAP {{ strtoupper($judulLaporan) }}</div>
        <div class="doc-subtitle">Sistem Administrasi Tata Usaha – SMA Negeri 4 Surabaya</div>
        <div class="doc-divider"></div>
    </div>

    {{-- ═══════════════════ INFO LAPORAN ═══════════════════ --}}
    <div class="info-grid">
        <div class="info-row">
            <div class="info-label">Jenis Laporan</div>
            <div class="info-colon">:</div>
            <div class="info-value">{{ $judulLaporan }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Periode</div>
            <div class="info-colon">:</div>
            <div class="info-value">
                @if($periodeAwal && $periodeAkhir)
                    {{ $fmtTgl($periodeAwal) }} s/d {{ $fmtTgl($periodeAkhir) }}
                @elseif($periodeAwal)
                    Mulai {{ $fmtTgl($periodeAwal) }}
                @elseif($periodeAkhir)
                    Sampai {{ $fmtTgl($periodeAkhir) }}
                @else
                    Seluruh Periode
                @endif
            </div>
        </div>
        @if($klasifikasi)
        <div class="info-row">
            <div class="info-label">Klasifikasi / Kategori</div>
            <div class="info-colon">:</div>
            <div class="info-value">{{ $klasifikasi }}</div>
        </div>
        @endif
        <div class="info-row">
            <div class="info-label">Total Data</div>
            <div class="info-colon">:</div>
            <div class="info-value"><strong>{{ count($rows) }}</strong> data ditemukan</div>
        </div>
        <div class="info-row">
            <div class="info-label">Dicetak Pada</div>
            <div class="info-colon">:</div>
            <div class="info-value">{{ $nowHari }}, {{ $nowFmt }} pukul {{ $now->format('H:i') }} WIB</div>
        </div>
    </div>

    {{-- ═══════════════════ TABEL DATA ═══════════════════ --}}
    @if(count($rows) > 0)
        <table class="data-table">
            <thead>
                <tr>
                    <th class="col-no">No.</th>
                    @foreach($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $i => $row)
                    <tr class="{{ $i % 2 === 0 ? '' : 'row-even' }}">
                        <td class="col-no" style="text-align:center;">{{ $i + 1 }}</td>
                        @foreach($row as $cell)
                            <td>
                                @php
                                    $val  = (string) ($cell ?? '-');
                                    $low  = strtolower($val);
                                    $badge = '';
                                    if (str_contains($low, 'sudah dis'))     $badge = 'badge-sudah';
                                    elseif (str_contains($low, 'belum'))     $badge = 'badge-belum';
                                    elseif (str_contains($low, 'diproses')
                                         || str_contains($low, 'proses'))    $badge = 'badge-proses';
                                    elseif ($val === 'Penting')              $badge = 'badge-penting';
                                    elseif ($val === 'Sangat Penting')       $badge = 'badge-penting';
                                    elseif ($val === 'Biasa')                $badge = 'badge-biasa';
                                    elseif ($val === 'Rahasia')              $badge = 'badge-rahasia';
                                @endphp
                                @if($badge)
                                    <span class="badge {{ $badge }}">{{ $val }}</span>
                                @else
                                    {{ $val }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="empty-state">
            ⚠ &nbsp; Tidak ada data yang ditemukan untuk filter yang dipilih.
        </div>
    @endif

    {{-- ═══════════════════ FOOTER / TANDA TANGAN ═══════════════════ --}}
    <div class="footer-section">
        <div class="footer-inner">
            <div class="footer-left">
                <div>Dokumen ini dicetak secara otomatis oleh</div>
                <div><strong>Sistem Administrasi Tata Usaha SMAN 4 Surabaya</strong></div>
                <div class="print-timestamp">Dicetak: {{ $now->format('d/m/Y H:i:s') }} WIB</div>
            </div>
            <div class="footer-right">
                <div class="sign-area">
                    <div class="sign-place-date">Surabaya, {{ $nowFmt }}</div>
                    <div class="sign-role">Kepala Tata Usaha</div>
                    <div class="sign-line"></div>
                    <div>( _______________________ )</div>
                    <div class="sign-nip">NIP. ................................</div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
