{{-- SMAN 4 Surabaya – Halaman Daftar Surat Masuk --}}
<x-filament-panels::page>
    {{ $this->content }}

    <style>
        /* ── Base ── */
        .sm-hero-title { font-size:2rem; font-weight:800; line-height:1.15; letter-spacing:-0.02em; color:#191b23; }
        .sm-hero-sub   { font-size:.93rem; color:#424754; margin-top:4px; }

        html.dark .sm-hero-title { color:#ffffff !important; }
        html.dark .sm-hero-sub { color:#e5e7eb !important; }
        /* ── Buttons ── */
        .sm-btn-out {
            display:inline-flex;align-items:center;gap:6px;
            padding:8px 16px; background:#fff; border:1px solid #dde0ef;
            border-radius:8px; font-size:12px; font-weight:700; color:#191b23;
            cursor:pointer; box-shadow:0 1px 2px rgba(0,0,0,.05); transition:background .15s;
            text-decoration:none;
        }
        .sm-btn-out:hover { background:#f2f3fd; }
        .sm-btn-pri {
            display:inline-flex;align-items:center;gap:7px;
            padding:9px 18px; background:#0058be; border:none;
            border-radius:8px; font-size:12px; font-weight:700; color:#fff;
            cursor:pointer; box-shadow:0 2px 8px rgba(0,88,190,.35); transition:background .15s, transform .1s;
            text-decoration:none;
        }
        .sm-btn-pri:hover { background:#0049a0; transform:translateY(-1px); }

        /* ── Stat Cards ── */
        .sm-stat-card {
            background:#ffffff; border:1px solid #e1e2ec; border-radius:14px;
            padding:20px 22px; position:relative; overflow:hidden;
            box-shadow:0 1px 4px rgba(0,0,0,.06); transition:box-shadow .2s, transform .2s;
        }
        .sm-stat-card:hover { box-shadow:0 6px 18px rgba(0,0,0,.1); transform:translateY(-2px); }
        .sm-stat-bg { position:absolute;top:10px;right:10px;opacity:.08;pointer-events:none; transition:opacity .3s; }
        .sm-stat-card:hover .sm-stat-bg { opacity:.14; }
        .sm-stat-lbl { font-size:10.5px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:#727785; }
        .sm-stat-val { font-size:2.3rem;font-weight:800;line-height:1.1;color:#191b23;margin-top:6px; }
        .sm-stat-trend { display:flex;align-items:center;gap:5px;margin-top:8px;font-size:11.5px;font-weight:700; }
        .tr-blue  { color:#0058be; }
        .tr-green { color:#166534; }
        .tr-red   { color:#dc2626; }
        .tr-orange{ color:#924700; }

        /* ── Table Card ── */
        .sm-card {
            background:#fff; border:1px solid #e1e2ec; border-radius:14px;
            box-shadow:0 1px 4px rgba(0,0,0,.06); overflow:hidden;
        }
        .sm-card-head { padding:20px 24px 14px; display:flex; align-items:flex-end; justify-content:space-between; gap:12px; flex-wrap:wrap; border-bottom:1px solid #ecedf7; }
        .sm-section-title { font-size:1.05rem; font-weight:700; color:#191b23; }
        .sm-section-sub   { font-size:.82rem; color:#424754; margin-top:2px; }

        /* Filter/Search Bar */
        .sm-filter-bar { display:flex; gap:10px; align-items:center; flex-wrap:wrap; padding:14px 24px; background:#f9f9ff; border-bottom:1px solid #ecedf7; }
        .sm-search-wrap { position:relative; flex:1; min-width:200px; }
        .sm-search-wrap svg { position:absolute;left:11px;top:50%;transform:translateY(-50%);color:#727785;pointer-events:none; }
        .sm-search { width:100%;padding:8px 12px 8px 35px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;background:#fff;outline:none;color:#191b23;transition:border-color .2s; }
        .sm-search:focus { border-color:#0058be; box-shadow:0 0 0 3px rgba(0,88,190,.1); }
        .sm-select { padding:8px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:12px;font-weight:600;color:#424754;background:#fff;outline:none;cursor:pointer;transition:border-color .2s; }
        .sm-select:focus { border-color:#0058be; }

        /* Table */
        .sm-table { width:100%;border-collapse:collapse; }
        .sm-table th {
            padding:10px 16px;font-size:10.5px;font-weight:700;text-transform:uppercase;
            letter-spacing:.05em;color:#727785;background:#f5f5fe;
            border-bottom:1px solid #e1e2ec;white-space:nowrap;text-align:left;
        }
        .sm-table td { padding:13px 16px;font-size:13.5px;color:#191b23;border-bottom:1px solid #ecedf7;vertical-align:middle; }
        .sm-table tr:last-child td { border-bottom:none; }
        .sm-table tr:hover td { background:#f9f9ff; cursor:pointer; }
        .sm-table .center { text-align:center; }
        .sm-table .right  { text-align:right; }

        /* Badges */
        .sm-badge { display:inline-flex;align-items:center;padding:3px 10px;border-radius:4px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.04em; }
        .badge-penting  { background:#fee2e2;color:#991b1b;border:1px solid #fca5a5; }
        .badge-biasa    { background:#dbeafe;color:#1e40af;border:1px solid #93c5fd; }
        .badge-rahasia  { background:#374151;color:#f9fafb;border:1px solid #4b5563; }
        .badge-belum    { background:#fef9c3;color:#854d0e;border:1px solid #fde047; }
        .badge-disposisi{ background:#dbeafe;color:#1e40af;border:1px solid #93c5fd; }
        .badge-selesai  { background:#dcfce7;color:#166534;border:1px solid #86efac; }

        /* Action buttons */
        .sm-act-btn { background:none;border:none;cursor:pointer;color:#9ca3af;padding:5px;border-radius:6px;transition:color .15s, background .15s;display:inline-flex;align-items:center;justify-content:center; }
        .sm-act-btn:hover { color:#0058be;background:#eff6ff; }
        .sm-act-btn.danger:hover { color:#dc2626;background:#fee2e2; }

        /* Pagination */
        .sm-pagination { display:flex;align-items:center;justify-content:space-between;padding:14px 24px;border-top:1px solid #ecedf7;flex-wrap:wrap;gap:10px; }
        .sm-page-info  { font-size:12px;color:#727785; }
        .sm-page-btns  { display:flex;gap:6px; }
        .sm-page-btn   { padding:5px 11px;border:1px solid #dde0ef;background:#fff;border-radius:6px;font-size:12px;font-weight:600;color:#424754;cursor:pointer;transition:background .15s; }
        .sm-page-btn:hover   { background:#f2f3fd; }
        .sm-page-btn.active  { background:#0058be;border-color:#0058be;color:#fff; }
        .sm-page-btn:disabled { opacity:.45;cursor:default; }

        /* Empty state */
        .sm-empty { padding:60px 24px;text-align:center;color:#727785; }
        .sm-empty svg { margin:0 auto 16px;opacity:.35; }
        .sm-empty p  { font-size:.95rem;font-weight:600; }
        .sm-empty small { font-size:.82rem; }

        /* Flash alert */
        .sm-flash { display:flex;align-items:center;gap:10px;padding:12px 18px;background:#dcfce7;border:1px solid #86efac;border-radius:10px;margin-bottom:20px;font-size:13px;font-weight:700;color:#166534; }

        /* Responsive */
        @media(max-width:768px){
            .sm-stat-grid { grid-template-columns:repeat(2,1fr) !important; }
            .sm-filter-bar { flex-direction:column;align-items:stretch; }
        }
        @media(max-width:480px){
            .sm-stat-grid { grid-template-columns:1fr !important; }
        }
    </style>

    <div style="margin-top:-4px;">

        {{-- ── Flash Message ── --}}
        @if(session('sukses'))
        <div class="sm-flash">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
            {{ session('sukses') }}
        </div>
        @endif

        {{-- ── Page Header ── --}}
        <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:24px;">
            <div>
                <h1 class="sm-hero-title">Daftar Surat Masuk</h1>
                <p class="sm-hero-sub">Kelola dan pantau semua surat masuk SMAN 4 Surabaya di satu tempat.</p>
            </div>
            <div style="display:flex;gap:10px;flex-shrink:0;">
                @if(\App\Support\RoleAccess::canManageIncoming())
                <button class="sm-btn-pri" wire:click="$set('showModalTambah', true)">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Tambah Surat Masuk
                </button>
                @endif
            </div>
        </div>

        {{-- ── Stat Cards ── --}}
        @php
            $suratMasukList = \App\Models\SuratMasuk::orderBy('created_at', 'desc')->get();
            $total     = $suratMasukList->count();
            $belum     = $suratMasukList->where('status','belum_disposisi')->count();
            $disposisi = $suratMasukList->where('status','sudah_disposisi')->count();
            $selesai   = $suratMasukList->where('status','selesai')->count();
        @endphp

        <div class="sm-stat-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">

            {{-- Total --}}
            <div class="sm-stat-card">
                <div class="sm-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#0058be" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M2.25 9V6a2.25 2.25 0 012.25-2.25h15A2.25 2.25 0 0121.75 6v3M2.25 9h19.5"/></svg>
                </div>
                <p class="sm-stat-lbl">Total Surat Masuk</p>
                <p class="sm-stat-val">{{ number_format($total) }}</p>
                <div class="sm-stat-trend tr-blue">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                    Semua waktu
                </div>
            </div>

            {{-- Belum Disposisi --}}
            <div class="sm-stat-card">
                <div class="sm-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#dc2626" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                </div>
                <p class="sm-stat-lbl">Belum Disposisi</p>
                <p class="sm-stat-val" style="color:#dc2626;">{{ $belum }}</p>
                <div class="sm-stat-trend tr-red">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/></svg>
                    Segera diproses
                </div>
            </div>

            {{-- Sudah Disposisi --}}
            <div class="sm-stat-card">
                <div class="sm-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#1e40af" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                </div>
                <p class="sm-stat-lbl">Sudah Disposisi</p>
                <p class="sm-stat-val" style="color:#1e40af;">{{ $disposisi }}</p>
                <div class="sm-stat-trend tr-blue">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd"/></svg>
                    Menunggu tindak lanjut
                </div>
            </div>

            {{-- Selesai --}}
            <div class="sm-stat-card">
                <div class="sm-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#166534" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="sm-stat-lbl">Selesai</p>
                <p class="sm-stat-val" style="color:#166534;">{{ $selesai }}</p>
                <div class="sm-stat-trend tr-green">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
                    Proses selesai
                </div>
            </div>

        </div>

        {{-- ── Table Card ── --}}
        <div class="sm-card">

            {{-- Header --}}
            <div class="sm-card-head">
                <div>
                    <p class="sm-section-title">Semua Surat Masuk</p>
                    <p class="sm-section-sub">Menampilkan seluruh arsip surat masuk yang tersimpan di sistem.</p>
                </div>
                <span style="font-size:11px;font-weight:700;background:#eff6ff;color:#1e40af;padding:4px 12px;border-radius:20px;border:1px solid #bfdbfe;">
                    {{ $total }} surat
                </span>
            </div>

            {{-- Filter Bar --}}
            <div class="sm-filter-bar">
                <div class="sm-search-wrap">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    <input class="sm-search" id="smSearch" placeholder="Cari nomor surat, asal, perihal..." type="search" onkeyup="smFilterTable()"/>
                </div>
                <select class="sm-select" id="smStatusFilter" onchange="smFilterTable()">
                    <option value="">Semua Status</option>
                    <option value="belum_disposisi">Belum Disposisi</option>
                    <option value="sudah_disposisi">Sudah Disposisi</option>
                    <option value="selesai">Selesai</option>
                </select>
                <select class="sm-select" id="smKlasifikasiFilter" onchange="smFilterTable()">
                    <option value="">Semua Klasifikasi</option>
                    <option value="Biasa">Biasa</option>
                    <option value="Penting">Penting</option>
                    <option value="Rahasia">Rahasia</option>
                </select>
            </div>

            {{-- Table --}}
            <div style="overflow-x:auto;">
                <table class="sm-table" id="smTable">
                    <thead>
                        <tr>
                            <th>No. Surat</th>
                            <th>Asal Surat</th>
                            <th>Perihal</th>
                            <th>Tanggal Terima</th>
                            <th class="center">Klasifikasi</th>
                            <th class="center">Status</th>
                            <th class="right" style="padding-right:20px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="smTableBody">
                        @forelse($suratMasukList as $surat)
                        @php
                            $statusClass = match($surat->status) {
                                'belum_disposisi'  => 'badge-belum',
                                'sudah_disposisi'  => 'badge-disposisi',
                                'selesai'          => 'badge-selesai',
                                default            => 'badge-belum',
                            };
                            $statusLabel = match($surat->status) {
                                'belum_disposisi'  => 'Belum',
                                'sudah_disposisi'  => 'Sudah Disposisi',
                                'selesai'          => 'Selesai',
                                default            => $surat->status,
                            };
                            $klasClass = match($surat->klasifikasi ?? 'Biasa') {
                                'Penting'  => 'badge-penting',
                                'Rahasia'  => 'badge-rahasia',
                                default    => 'badge-biasa',
                            };
                        @endphp
                        <tr data-status="{{ $surat->status }}" data-klasifikasi="{{ $surat->klasifikasi ?? 'Biasa' }}">
                            <td>
                                <span style="font-family:monospace;font-size:12px;color:#545f73;white-space:nowrap;">
                                    {{ $surat->nomor_surat }}
                                </span>
                            </td>
                            <td style="font-weight:700;max-width:160px;">{{ Str::limit($surat->asal_surat, 30) }}</td>
                            <td style="color:#424754;max-width:240px;">{{ Str::limit($surat->perihal, 45) }}</td>
                            <td style="white-space:nowrap;color:#424754;font-size:13px;">
                                {{ $surat->tanggal_terima ? \Carbon\Carbon::parse($surat->tanggal_terima)->format('d M Y') : '-' }}
                            </td>
                            <td class="center"><span class="sm-badge {{ $klasClass }}">{{ $surat->klasifikasi ?? 'Biasa' }}</span></td>
                            <td class="center"><span class="sm-badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
                            <td class="right" style="padding-right:16px;">
                                <div style="display:inline-flex;gap:4px;">
                                    <button class="sm-act-btn" title="Lihat Detail" wire:click="lihatDetail({{ $surat->id }})">
                                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </button>
                                    @if(\App\Support\RoleAccess::canManageIncoming())
                                    <button class="sm-act-btn" title="Edit" wire:click="editSuratMasuk({{ $surat->id }})">
                                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                                    </button>
                                    <button class="sm-act-btn danger" title="Hapus" wire:click="konfirmasiHapus({{ $surat->id }})">
                                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="sm-empty">
                                    <svg width="60" height="60" fill="none" stroke="#9ca3af" stroke-width="1.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M2.25 9V6a2.25 2.25 0 012.25-2.25h15A2.25 2.25 0 0121.75 6v3M2.25 9h19.5"/></svg>
                                    <p>Belum ada surat masuk</p>
                                    <small>Klik "Tambah Surat Masuk" untuk menambahkan surat pertama.</small>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Info --}}
            <div class="sm-pagination">
                <span class="sm-page-info">Menampilkan <strong id="smShownCount">{{ $total }}</strong> dari <strong>{{ $total }}</strong> surat</span>
                <div class="sm-page-btns">
                    <button class="sm-page-btn" disabled>&#8592; Sebelumnya</button>
                    <button class="sm-page-btn active">1</button>
                    <button class="sm-page-btn" disabled>Berikutnya &#8594;</button>
                </div>
            </div>

        </div>
    </div>

    {{-- ── Modal Tambah Surat Masuk ── --}}
    @if($showModalTambah)
    <div style="display:flex;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;align-items:center;justify-content:center;padding:20px;" wire:click.self="$set('showModalTambah', false)">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:560px;box-shadow:0 20px 60px rgba(0,0,0,.25);overflow:hidden;" wire:click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border-bottom:1px solid #ecedf7;">
                <div>
                    <p style="font-size:1.05rem;font-weight:800;color:#191b23;">Tambah Surat Masuk</p>
                    <p style="font-size:.82rem;color:#424754;margin-top:2px;">Isi formulir di bawah ini untuk mencatat surat masuk baru.</p>
                </div>
                <button wire:click="$set('showModalTambah', false)" style="background:none;border:none;cursor:pointer;color:#9ca3af;padding:4px;border-radius:6px;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form wire:submit.prevent="simpanSuratMasuk" style="padding:24px;display:flex;flex-direction:column;gap:16px;">
                @if($errors->any())
                <div style="background:#fee2e2;border:1px solid #fca5a5;border-radius:8px;padding:10px 14px;font-size:12px;color:#991b1b;">
                    <ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">No. Surat <span style="color:#dc2626;">*</span></label>
                        <input wire:model="nomor_surat" placeholder="cth. 421.3/089/SMAN4/2024" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;color:#191b23;outline:none;"/>
                    </div>
                    <div>
                        <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Tanggal Terima <span style="color:#dc2626;">*</span></label>
                        <input wire:model="tanggal_terima" type="date" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;color:#191b23;outline:none;"/>
                    </div>
                </div>
                <div>
                    <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Asal Surat <span style="color:#dc2626;">*</span></label>
                    <input wire:model="asal_surat" placeholder="cth. Dinas Pendidikan Provinsi Jawa Timur" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;color:#191b23;outline:none;"/>
                </div>
                <div>
                    <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Perihal <span style="color:#dc2626;">*</span></label>
                    <input wire:model="perihal" placeholder="cth. Undangan Rapat Koordinasi Kurikulum" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;color:#191b23;outline:none;"/>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Klasifikasi</label>
                        <select wire:model="klasifikasi" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;color:#191b23;outline:none;background:#fff;cursor:pointer;">
                            <option value="Biasa">Biasa</option>
                            <option value="Penting">Penting</option>
                            <option value="Rahasia">Rahasia</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Status</label>
                        <select wire:model="status" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;color:#191b23;outline:none;background:#fff;cursor:pointer;">
                            <option value="belum_disposisi">Belum Disposisi</option>
                            <option value="sudah_disposisi">Sudah Disposisi</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Keterangan</label>
                    <textarea wire:model="keterangan" rows="3" placeholder="Catatan tambahan (opsional)..." style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;color:#191b23;outline:none;resize:vertical;font-family:inherit;"></textarea>
                </div>
                <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:4px;">
                    <button type="button" wire:click="$set('showModalTambah', false)" class="sm-btn-out">Batal</button>
                    <button type="submit" class="sm-btn-pri">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        <span wire:loading.remove wire:target="simpanSuratMasuk">Simpan Surat</span>
                        <span wire:loading wire:target="simpanSuratMasuk">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- ── Modal Edit Surat Masuk ── --}}
    @if($showModalEdit)
    <div style="display:flex;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;align-items:center;justify-content:center;padding:20px;" wire:click.self="$set('showModalEdit', false)">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:560px;box-shadow:0 20px 60px rgba(0,0,0,.25);overflow:hidden;" wire:click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border-bottom:1px solid #ecedf7;">
                <div>
                    <p style="font-size:1.05rem;font-weight:800;color:#191b23;">Edit Surat Masuk</p>
                    <p style="font-size:.82rem;color:#424754;margin-top:2px;">Perbarui informasi surat masuk ini.</p>
                </div>
                <button wire:click="$set('showModalEdit', false)" style="background:none;border:none;cursor:pointer;color:#9ca3af;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form wire:submit.prevent="updateSuratMasuk" style="padding:24px;display:flex;flex-direction:column;gap:16px;">
                @if($errors->any())
                <div style="background:#fee2e2;border:1px solid #fca5a5;border-radius:8px;padding:10px 14px;font-size:12px;color:#991b1b;">
                    <ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">No. Surat *</label>
                        <input wire:model="nomor_surat" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;outline:none;"/>
                    </div>
                    <div>
                        <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Tanggal Terima *</label>
                        <input wire:model="tanggal_terima" type="date" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;outline:none;"/>
                    </div>
                </div>
                <div>
                    <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Asal Surat *</label>
                    <input wire:model="asal_surat" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;outline:none;"/>
                </div>
                <div>
                    <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Perihal *</label>
                    <input wire:model="perihal" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;outline:none;"/>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Klasifikasi</label>
                        <select wire:model="klasifikasi" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;background:#fff;">
                            <option value="Biasa">Biasa</option>
                            <option value="Penting">Penting</option>
                            <option value="Rahasia">Rahasia</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Status</label>
                        <select wire:model="status" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;background:#fff;">
                            <option value="belum_disposisi">Belum Disposisi</option>
                            <option value="sudah_disposisi">Sudah Disposisi</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label style="font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px;">Keterangan</label>
                    <textarea wire:model="keterangan" rows="3" style="width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;outline:none;resize:vertical;font-family:inherit;"></textarea>
                </div>
                <div style="display:flex;gap:10px;justify-content:flex-end;">
                    <button type="button" wire:click="$set('showModalEdit', false)" class="sm-btn-out">Batal</button>
                    <button type="submit" class="sm-btn-pri">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                        <span wire:loading.remove wire:target="updateSuratMasuk">Simpan Perubahan</span>
                        <span wire:loading wire:target="updateSuratMasuk">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- ── Modal Detail Surat Masuk ── --}}
    @if($showModalDetail && $detailData)
    <div style="display:flex;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;align-items:center;justify-content:center;padding:20px;" wire:click.self="$set('showModalDetail', false)">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:520px;box-shadow:0 20px 60px rgba(0,0,0,.25);overflow:hidden;" wire:click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border-bottom:1px solid #ecedf7;background:#f9f9ff;">
                <p style="font-size:1.05rem;font-weight:800;color:#191b23;">Detail Surat Masuk</p>
                <button wire:click="$set('showModalDetail', false)" style="background:none;border:none;cursor:pointer;color:#9ca3af;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div style="padding:24px;display:flex;flex-direction:column;gap:14px;">
                @foreach(['nomor_surat'=>'No. Surat','tanggal_terima'=>'Tanggal Terima','asal_surat'=>'Asal Surat','perihal'=>'Perihal','klasifikasi'=>'Klasifikasi','status'=>'Status','keterangan'=>'Keterangan','dibuat'=>'Dicatat Pada'] as $key=>$label)
                <div style="display:flex;gap:12px;align-items:flex-start;">
                    <span style="font-size:11px;font-weight:700;text-transform:uppercase;color:#727785;width:130px;flex-shrink:0;padding-top:2px;">{{ $label }}</span>
                    <span style="font-size:13.5px;color:#191b23;font-weight:500;">{{ $detailData[$key] ?? '-' }}</span>
                </div>
                @endforeach
            </div>
            <div style="padding:16px 24px;border-top:1px solid #ecedf7;display:flex;justify-content:flex-end;">
                <button wire:click="$set('showModalDetail', false)" class="sm-btn-pri">Tutup</button>
            </div>
        </div>
    </div>
    @endif

    {{-- ── Modal Konfirmasi Hapus ── --}}
    @if($showModalHapus)
    <div style="display:flex;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center;padding:20px;">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:420px;box-shadow:0 20px 60px rgba(0,0,0,.25);padding:28px;text-align:center;">
            <div style="width:56px;height:56px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <svg width="28" height="28" fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
            </div>
            <p style="font-size:1.1rem;font-weight:800;color:#191b23;margin-bottom:8px;">Hapus Surat Masuk?</p>
            <p style="font-size:13px;color:#424754;margin-bottom:24px;">Data surat ini akan dihapus secara permanen dan tidak dapat dikembalikan.</p>
            <div style="display:flex;gap:10px;justify-content:center;">
                <button wire:click="$set('showModalHapus', false)" class="sm-btn-out">Batal</button>
                <button wire:click="hapusSuratMasuk" style="display:inline-flex;align-items:center;gap:6px;padding:9px 20px;background:#dc2626;border:none;border-radius:8px;font-size:12px;font-weight:700;color:#fff;cursor:pointer;">
                    <span wire:loading.remove wire:target="hapusSuratMasuk">Ya, Hapus</span>
                    <span wire:loading wire:target="hapusSuratMasuk">Menghapus...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <script>
        function smFilterTable() {
            const query = document.getElementById('smSearch').value.toLowerCase();
            const status = document.getElementById('smStatusFilter').value;
            const klas   = document.getElementById('smKlasifikasiFilter').value;
            const rows   = document.querySelectorAll('#smTableBody tr[data-status]');
            let shown    = 0;

            rows.forEach(row => {
                const text  = row.innerText.toLowerCase();
                const st    = row.dataset.status;
                const kl    = row.dataset.klasifikasi;

                const matchQ  = !query  || text.includes(query);
                const matchSt = !status || st === status;
                const matchKl = !klas   || kl === klas;

                if (matchQ && matchSt && matchKl) {
                    row.style.display = '';
                    shown++;
                } else {
                    row.style.display = 'none';
                }
            });

            const el = document.getElementById('smShownCount');
            if (el) el.textContent = shown;
        }
    </script>

</x-filament-panels::page>

