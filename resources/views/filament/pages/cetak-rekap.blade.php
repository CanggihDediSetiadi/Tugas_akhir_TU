{{-- SMAN 4 Surabaya - Halaman Cetak Rekap --}}
<x-filament-panels::page>
    {{ $this->content }}

    <style>
        .cr-hero-title { font-size:2rem; font-weight:800; line-height:1.15; letter-spacing:-0.02em; color:#191b23; }
        .cr-hero-sub { font-size:.93rem; color:#424754; margin-top:4px; }
        html.dark .cr-hero-title { color:#ffffff !important; }
        html.dark .cr-hero-sub { color:#e5e7eb !important; }
        .cr-btn-out, .cr-btn-pri, .cr-refresh-btn { display:inline-flex; align-items:center; justify-content:center; gap:7px; border-radius:8px; font-size:12px; font-weight:800; cursor:pointer; transition:background .15s, transform .15s; }
        .cr-btn-out { padding:9px 16px; background:#fff; color:#191b23; border:1px solid #dde0ef; }
        .cr-btn-out:hover { background:#f2f3fd; }
        .cr-btn-pri { padding:10px 18px; background:#0058be; color:#fff; border:none; box-shadow:0 3px 10px rgba(0,88,190,.25); }
        .cr-btn-pri:hover { background:#0049a0; transform:translateY(-1px); }
        .cr-refresh-btn { width:100%; padding:10px; background:#f2f3fd; border:1px solid #e1e2ec; color:#424754; }
        .cr-refresh-btn:hover { background:#e6e7f2; }
        .cr-stat-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(190px,1fr)); gap:16px; margin-bottom:24px; }
        .cr-card { background:#fff; border:1px solid #e1e2ec; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,.04); overflow:hidden; }
        .cr-stat-card { padding:20px; position:relative; overflow:hidden; }
        .cr-stat-lbl { font-size:10.5px; font-weight:800; letter-spacing:.07em; text-transform:uppercase; color:#727785; }
        .cr-stat-val { font-size:2.25rem; font-weight:800; line-height:1.1; color:#191b23; margin-top:6px; }
        .cr-layout { display:grid; grid-template-columns:minmax(280px,420px) 1fr; gap:20px; align-items:start; }
        .cr-head { padding:18px 22px; border-bottom:1px solid #ecedf7; }
        .cr-title { font-size:1rem; font-weight:800; color:#191b23; }
        .cr-body { padding:22px; display:grid; gap:18px; }
        .cr-field-label { display:block; margin-bottom:6px; font-size:10.5px; font-weight:800; letter-spacing:.06em; text-transform:uppercase; color:#727785; }
        .cr-select, .cr-input { width:100%; padding:9px 12px; border:1px solid #dde0ef; border-radius:8px; font-size:13px; color:#191b23; background:#fff; outline:none; }
        .cr-format-fixed { padding:10px 12px; border:1px solid #0058be; background:#eff6ff; color:#0058be; border-radius:8px; display:flex; align-items:center; justify-content:center; gap:6px; font-size:12px; font-weight:800; }
        .cr-preview { padding:24px; }
        .cr-preview-title { font-size:1.1rem; font-weight:800; color:#191b23; margin-bottom:6px; }
        .cr-preview-sub { font-size:13px; color:#727785; margin-bottom:18px; }
        .cr-table { width:100%; border-collapse:collapse; }
        .cr-table th { padding:10px 12px; font-size:10.5px; text-transform:uppercase; letter-spacing:.05em; color:#727785; background:#f5f5fe; border-bottom:1px solid #e1e2ec; text-align:left; }
        .cr-table td { padding:12px; font-size:13px; color:#191b23; border-bottom:1px solid #ecedf7; }
        @media (max-width:900px){ .cr-layout { grid-template-columns:1fr; } }
    </style>

    <div style="margin-top:-4px;">
        @php
            $sm = \App\Models\SuratMasuk::count();
            $sk = \App\Models\SuratKeluar::count();
            $dp = \App\Models\Disposisi::count();
            $arsip = \App\Models\ArsipDigital::count();
            $recentMasuk = \App\Models\SuratMasuk::latest()->limit(5)->get();
            $recentKeluar = \App\Models\SuratKeluar::latest()->limit(5)->get();
            $recentDisposisi = \App\Models\Disposisi::with('suratMasuk')->latest()->limit(5)->get();
            $previewMasuk = $recentMasuk->map(function ($item) {
                return [$item->nomor_surat, optional($item->tanggal_terima)->format('d M Y'), $item->asal_surat, $item->perihal, $item->status_label];
            })->values();
            $previewKeluar = $recentKeluar->map(function ($item) {
                return [$item->nomor_surat, optional($item->tanggal_surat)->format('d M Y'), $item->tujuan, $item->perihal, $item->status_label];
            })->values();
            $previewDisposisi = $recentDisposisi->map(function ($item) {
                return [$item->nomor_disposisi, optional($item->created_at)->format('d M Y'), $item->diteruskan_ke, $item->suratMasuk?->perihal ?? '-', $item->status_label];
            })->values();
        @endphp

        <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:24px;">
            <div>
                <h1 class="cr-hero-title">Cetak Rekap</h1>
                <p class="cr-hero-sub">Konfigurasi dan unduh laporan administrasi surat menyurat SMAN 4 Surabaya.</p>
            </div>
            <button class="cr-btn-pri" id="crDownloadBtn" onclick="crDownload()">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Unduh PDF
            </button>
        </div>

        <div class="cr-stat-grid">
            <div class="cr-card cr-stat-card"><p class="cr-stat-lbl">Surat Masuk</p><p class="cr-stat-val">{{ number_format($sm) }}</p></div>
            <div class="cr-card cr-stat-card"><p class="cr-stat-lbl">Surat Keluar</p><p class="cr-stat-val">{{ number_format($sk) }}</p></div>
            <div class="cr-card cr-stat-card"><p class="cr-stat-lbl">Disposisi</p><p class="cr-stat-val">{{ number_format($dp) }}</p></div>
            <div class="cr-card cr-stat-card"><p class="cr-stat-lbl">Arsip Digital</p><p class="cr-stat-val">{{ number_format($arsip) }}</p></div>
        </div>

        <div class="cr-layout">
            <div class="cr-card">
                <div class="cr-head"><p class="cr-title">Konfigurasi Laporan</p></div>
                <div class="cr-body">
                    <div>
                        <label class="cr-field-label">Tipe Laporan</label>
                        <select class="cr-select" id="crTipeLaporan" onchange="crUpdatePreview()">
                            <option value="surat_masuk">Surat Masuk</option>
                            <option value="surat_keluar">Surat Keluar</option>
                            <option value="disposisi">Disposisi</option>
                        </select>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div><label class="cr-field-label">Dari</label><input class="cr-input" type="date" id="crTglMulai"></div>
                        <div><label class="cr-field-label">Sampai</label><input class="cr-input" type="date" id="crTglSelesai"></div>
                    </div>
                    <div>
                        <label class="cr-field-label">Klasifikasi / Kategori</label>
                        <select class="cr-select" id="crKlasifikasi">
                            <option value="">Semua</option>
                            <option value="Biasa">Biasa</option>
                            <option value="Penting">Penting</option>
                            <option value="Rahasia">Rahasia</option>
                            <option value="Sangat Penting">Sangat Penting</option>
                        </select>
                    </div>
                    <div>
                        <label class="cr-field-label">Format Laporan</label>
                        <div class="cr-format-fixed">PDF</div>
                    </div>
                    <button class="cr-refresh-btn" type="button" onclick="crRefreshPreview()">
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                        Refresh Preview
                    </button>
                </div>
            </div>

            <div class="cr-card cr-preview">
                <p class="cr-preview-title">Preview Data</p>
                <p class="cr-preview-sub" id="crPreviewText">Menampilkan data terbaru untuk laporan Surat Masuk.</p>
                <div style="overflow-x:auto;">
                    <table class="cr-table">
                        <thead><tr><th>Nomor</th><th>Tanggal</th><th>Tujuan / Asal</th><th>Perihal</th><th>Status</th></tr></thead>
                        <tbody id="crPreviewBody">
                            @if($recentMasuk->isEmpty())
                                <tr><td colspan="5">Belum ada data surat masuk.</td></tr>
                            @else
                                @foreach($recentMasuk as $item)
                                    <tr><td>{{ $item->nomor_surat }}</td><td>{{ optional($item->tanggal_terima)->format('d M Y') }}</td><td>{{ $item->asal_surat }}</td><td>{{ $item->perihal }}</td><td>{{ $item->status_label }}</td></tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        const crPreviewRows = {
            surat_masuk: @json($previewMasuk),
            surat_keluar: @json($previewKeluar),
            disposisi: @json($previewDisposisi),
        };
        const crLabels = { surat_masuk: 'Surat Masuk', surat_keluar: 'Surat Keluar', disposisi: 'Disposisi' };

        function crUpdatePreview() {
            const tipe = document.getElementById('crTipeLaporan')?.value || 'surat_masuk';
            const rows = crPreviewRows[tipe] || [];
            const body = document.getElementById('crPreviewBody');
            const text = document.getElementById('crPreviewText');
            if (text) text.textContent = 'Menampilkan data terbaru untuk laporan ' + crLabels[tipe] + '.';
            if (!body) return;
            body.innerHTML = rows.length
                ? rows.map(row => `<tr>${row.map(col => `<td>${col ?? '-'}</td>`).join('')}</tr>`).join('')
                : '<tr><td colspan="5">Belum ada data.</td></tr>';
        }

        function crRefreshPreview() { crUpdatePreview(); }

        function crDownload() {
            const params = new URLSearchParams({
                tipe: document.getElementById('crTipeLaporan')?.value || 'surat_masuk',
                mulai: document.getElementById('crTglMulai')?.value || '',
                selesai: document.getElementById('crTglSelesai')?.value || '',
                klasifikasi: document.getElementById('crKlasifikasi')?.value || '',
                format: 'pdf',
            });
            window.location.href = '{{ route('rekap.download') }}?' + params.toString();
        }

        window.addEventListener('DOMContentLoaded', () => {
            const now = new Date();
            const y = now.getFullYear();
            const m = String(now.getMonth() + 1).padStart(2, '0');
            const d = String(now.getDate()).padStart(2, '0');
            const mulai = document.getElementById('crTglMulai');
            const selesai = document.getElementById('crTglSelesai');
            if (mulai) mulai.value = `${y}-${m}-01`;
            if (selesai) selesai.value = `${y}-${m}-${d}`;
        });
    </script>
</x-filament-panels::page>


