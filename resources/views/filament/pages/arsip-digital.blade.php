{{-- SMAN 4 Surabaya â€“ Halaman Arsip Digital --}}
<x-filament-panels::page>
    {{ $this->content }}

    <style>
        /* â”€â”€ Base â”€â”€ */
        .ad-hero-title { font-size:2rem; font-weight:800; line-height:1.15; letter-spacing:-0.02em; color:#191b23; }
        .ad-hero-sub   { font-size:.93rem; color:#424754; margin-top:4px; }

        html.dark .ad-hero-title { color:#ffffff !important; }
        html.dark .ad-hero-sub { color:#e5e7eb !important; }
        /* â”€â”€ Buttons â”€â”€ */
        .ad-btn-out {
            display:inline-flex; align-items:center; gap:6px;
            padding:8px 16px; background:#fff; border:1px solid #dde0ef;
            border-radius:8px; font-size:12px; font-weight:700; color:#191b23;
            cursor:pointer; box-shadow:0 1px 2px rgba(0,0,0,.05); transition:background .15s;
            text-decoration:none;
        }
        .ad-btn-out:hover { background:#f2f3fd; }
        .ad-btn-pri {
            display:inline-flex; align-items:center; gap:7px;
            padding:9px 18px; background:#0058be; border:none;
            border-radius:8px; font-size:12px; font-weight:700; color:#fff;
            cursor:pointer; box-shadow:0 2px 8px rgba(0,88,190,.35); transition:background .15s, transform .1s;
            text-decoration:none;
        }
        .ad-btn-pri:hover { background:#0049a0; transform:translateY(-1px); }

        /* â”€â”€ Stat Cards â”€â”€ */
        .ad-stat-card {
            background:#ffffff; border:1px solid #e1e2ec; border-radius:14px;
            padding:20px 22px; position:relative; overflow:hidden;
            box-shadow:0 1px 4px rgba(0,0,0,.06); transition:box-shadow .2s, transform .2s;
        }
        .ad-stat-card:hover { box-shadow:0 6px 18px rgba(0,0,0,.1); transform:translateY(-2px); }
        .ad-stat-bg { position:absolute; top:10px; right:10px; opacity:.08; pointer-events:none; transition:opacity .3s; }
        .ad-stat-card:hover .ad-stat-bg { opacity:.14; }
        .ad-stat-lbl { font-size:10.5px; font-weight:700; letter-spacing:.07em; text-transform:uppercase; color:#727785; }
        .ad-stat-val { font-size:2.3rem; font-weight:800; line-height:1.1; color:#191b23; margin-top:6px; }
        .ad-stat-trend { display:flex; align-items:center; gap:5px; margin-top:8px; font-size:11.5px; font-weight:700; }
        .tr-blue   { color:#0058be; }
        .tr-green  { color:#166534; }
        .tr-orange { color:#924700; }
        .tr-purple { color:#6b21a8; }

        /* â”€â”€ Filter Panel â”€â”€ */
        .ad-filter-panel {
            background:#fff; border:1px solid #e1e2ec; border-radius:14px;
            padding:20px 24px; margin-bottom:20px;
            box-shadow:0 1px 4px rgba(0,0,0,.06);
        }
        .ad-filter-title { font-size:.95rem; font-weight:700; color:#191b23; display:flex; align-items:center; gap:8px; margin-bottom:14px; }
        .ad-filter-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:14px; }
        .ad-filter-label { font-size:10.5px; font-weight:700; letter-spacing:.06em; text-transform:uppercase; color:#727785; display:block; margin-bottom:5px; }
        .ad-select {
            width:100%; padding:8px 12px; border:1px solid #dde0ef; border-radius:8px;
            font-size:13px; color:#191b23; background:#fff; outline:none; cursor:pointer;
            transition:border-color .2s;
        }
        .ad-select:focus { border-color:#0058be; box-shadow:0 0 0 3px rgba(0,88,190,.1); }
        .ad-status-btns { display:flex; gap:8px; }
        .ad-status-btn {
            flex:1; padding:8px 10px; border-radius:8px; font-size:11px; font-weight:700;
            cursor:pointer; border:1px solid #dde0ef; background:#f2f3fd; color:#424754;
            transition:all .15s; text-align:center;
        }
        .ad-status-btn.active-btn { background:#0058be; color:#fff; border-color:#0058be; box-shadow:0 2px 6px rgba(0,88,190,.3); }
        .ad-search-wrap { position:relative; }
        .ad-search-wrap svg { position:absolute; left:11px; top:50%; transform:translateY(-50%); color:#727785; pointer-events:none; }
        .ad-search {
            width:100%; padding:8px 12px 8px 35px; border:1px solid #dde0ef; border-radius:8px;
            font-size:13px; background:#fff; outline:none; color:#191b23; transition:border-color .2s;
        }
        .ad-search:focus { border-color:#0058be; box-shadow:0 0 0 3px rgba(0,88,190,.1); }

        /* â”€â”€ Toolbar â”€â”€ */
        .ad-toolbar { display:flex; align-items:center; justify-content:space-between; margin-bottom:16px; flex-wrap:wrap; gap:10px; }
        .ad-breadcrumb { display:flex; align-items:center; gap:6px; font-size:13px; color:#727785; }
        .ad-breadcrumb a { color:#0058be; font-weight:600; text-decoration:none; }
        .ad-breadcrumb a:hover { text-decoration:underline; }
        .ad-view-toggle { display:flex; border:1px solid #e1e2ec; border-radius:8px; overflow:hidden; }
        .ad-view-btn { padding:7px 11px; background:#fff; border:none; cursor:pointer; color:#727785; transition:all .15s; }
        .ad-view-btn.active-view { background:#0058be; color:#fff; }
        .ad-view-btn:hover:not(.active-view) { background:#f2f3fd; color:#0058be; }

        /* â”€â”€ Archive Grid â”€â”€ */
        .ad-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(240px,1fr)); gap:14px; }
        .ad-item {
            background:#fff; border:1px solid #e1e2ec; border-radius:14px;
            padding:18px 18px 16px; cursor:pointer;
            box-shadow:0 1px 4px rgba(0,0,0,.05);
            transition:border-color .2s, box-shadow .2s, transform .2s;
            position:relative;
        }
        .ad-item:hover { border-color:#0058be; box-shadow:0 6px 20px rgba(0,88,190,.12); transform:translateY(-3px); }
        .ad-item-header { display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:12px; }
        .ad-item-icon-wrap { width:48px; height:48px; border-radius:10px; display:flex; align-items:center; justify-content:center; }
        .ad-more-btn { background:none; border:none; cursor:pointer; color:#c2c6d6; padding:4px; border-radius:6px; transition:color .15s, background .15s; }
        .ad-more-btn:hover { color:#0058be; background:#eff6ff; }
        .ad-item-name { font-size:.9rem; font-weight:700; color:#191b23; margin-bottom:4px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
        .ad-item-meta { font-size:11px; color:#727785; margin-bottom:10px; }
        .ad-item-footer { display:flex; align-items:center; justify-content:space-between; }
        .ad-item-date { font-size:10.5px; color:#9ca3af; }
        .ad-add-card {
            border:2px dashed #dde0ef; border-radius:14px; padding:18px;
            display:flex; flex-direction:column; align-items:center; justify-content:center;
            cursor:pointer; min-height:170px; transition:all .2s;
            background:transparent;
        }
        .ad-add-card:hover { border-color:#0058be; background:#f0f6ff; }
        .ad-add-card svg { color:#c2c6d6; transition:color .2s; margin-bottom:8px; }
        .ad-add-card:hover svg { color:#0058be; }
        .ad-add-label { font-size:12px; font-weight:700; color:#9ca3af; transition:color .2s; }
        .ad-add-card:hover .ad-add-label { color:#0058be; }

        /* â”€â”€ List View â”€â”€ */
        .ad-list-card { background:#fff; border:1px solid #e1e2ec; border-radius:14px; box-shadow:0 1px 4px rgba(0,0,0,.06); overflow:hidden; }
        .ad-list-head { padding:14px 20px 10px; border-bottom:1px solid #ecedf7; }
        .ad-table { width:100%; border-collapse:collapse; }
        .ad-table th {
            padding:10px 16px; font-size:10.5px; font-weight:700; text-transform:uppercase;
            letter-spacing:.05em; color:#727785; background:#f5f5fe;
            border-bottom:1px solid #e1e2ec; white-space:nowrap; text-align:left;
        }
        .ad-table td { padding:12px 16px; font-size:13.5px; color:#191b23; border-bottom:1px solid #ecedf7; vertical-align:middle; }
        .ad-table tr:last-child td { border-bottom:none; }
        .ad-table tr:hover td { background:#f9f9ff; cursor:pointer; }
        .ad-table .center { text-align:center; }
        .ad-table .right  { text-align:right; }

        /* â”€â”€ Badges â”€â”€ */
        .ad-badge { display:inline-flex; align-items:center; padding:3px 9px; border-radius:4px; font-size:10px; font-weight:800; text-transform:uppercase; letter-spacing:.04em; }
        .badge-penting  { background:#fee2e2; color:#991b1b; border:1px solid #fca5a5; }
        .badge-terbatas { background:#fef3c7; color:#92400e; border:1px solid #fde68a; }
        .badge-biasa    { background:#dbeafe; color:#1e40af; border:1px solid #93c5fd; }
        .badge-rahasia  { background:#374151; color:#f9fafb; border:1px solid #4b5563; }
        .badge-tervalidasi { background:#dcfce7; color:#166534; border:1px solid #86efac; }
        .badge-draft    { background:#fef9c3; color:#854d0e; border:1px solid #fde047; }

        /* â”€â”€ Recent Activity Table â”€â”€ */
        .ad-activity-card { background:#fff; border:1px solid #e1e2ec; border-radius:14px; box-shadow:0 1px 4px rgba(0,0,0,.06); overflow:hidden; margin-top:28px; }
        .ad-activity-head { display:flex; align-items:center; justify-content:space-between; padding:18px 24px 14px; border-bottom:1px solid #ecedf7; }
        .ad-activity-title { font-size:1.05rem; font-weight:700; color:#191b23; }
        .ad-act-badge {
            display:inline-flex; align-items:center; padding:3px 9px; border-radius:4px;
            font-size:10px; font-weight:800; letter-spacing:.04em; text-transform:uppercase;
        }
        .act-download { background:#dcfce7; color:#166534; border:1px solid #86efac; }
        .act-edit     { background:#dbeafe; color:#1e40af; border:1px solid #93c5fd; }
        .act-akses    { background:#f3e8ff; color:#6b21a8; border:1px solid #d8b4fe; }
        .act-upload   { background:#fef3c7; color:#92400e; border:1px solid #fde68a; }
        .act-hapus    { background:#fee2e2; color:#991b1b; border:1px solid #fca5a5; }

        /* â”€â”€ Action Buttons â”€â”€ */
        .ad-act-btn { background:none; border:none; cursor:pointer; color:#9ca3af; padding:5px; border-radius:6px; transition:color .15s, background .15s; display:inline-flex; align-items:center; justify-content:center; }
        .ad-act-btn:hover { color:#0058be; background:#eff6ff; }
        .ad-act-btn.danger:hover { color:#dc2626; background:#fee2e2; }

        /* â”€â”€ Upload Modal â”€â”€ */
        .ad-modal-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:9999; align-items:center; justify-content:center; padding:20px; }
        .ad-modal-box { background:#fff; border-radius:16px; width:100%; max-width:580px; box-shadow:0 20px 60px rgba(0,0,0,.25); overflow:hidden; }
        .ad-modal-head { display:flex; align-items:center; justify-content:space-between; padding:20px 24px; border-bottom:1px solid #ecedf7; }
        .ad-modal-title { font-size:1.05rem; font-weight:800; color:#191b23; }
        .ad-modal-sub   { font-size:.82rem; color:#424754; margin-top:2px; }
        .ad-modal-close { background:none; border:none; cursor:pointer; color:#9ca3af; padding:4px; border-radius:6px; transition:color .15s; }
        .ad-modal-close:hover { color:#dc2626; }
        .ad-modal-body  { padding:24px; display:flex; flex-direction:column; gap:16px; }
        .ad-field-label { font-size:11px; font-weight:700; color:#424754; text-transform:uppercase; letter-spacing:.05em; display:block; margin-bottom:5px; }
        .ad-field-input {
            width:100%; padding:9px 12px; border:1px solid #dde0ef; border-radius:8px;
            font-size:13px; color:#191b23; outline:none; transition:border-color .2s;
        }
        .ad-field-input:focus { border-color:#0058be; box-shadow:0 0 0 3px rgba(0,88,190,.1); }
        .ad-field-select {
            width:100%; padding:9px 12px; border:1px solid #dde0ef; border-radius:8px;
            font-size:13px; color:#191b23; outline:none; background:#fff; cursor:pointer;
        }
        .ad-field-select:focus { border-color:#0058be; box-shadow:0 0 0 3px rgba(0,88,190,.1); }
        .ad-dropzone {
            border:2px dashed #c2c6d6; border-radius:10px; padding:32px;
            text-align:center; cursor:pointer; transition:all .2s;
            background:#f9f9ff;
        }
        .ad-dropzone:hover, .ad-dropzone.dragover { border-color:#0058be; background:#eff6ff; }
        .ad-dropzone p { font-size:13px; color:#424754; margin-top:10px; }
        .ad-dropzone small { font-size:11px; color:#9ca3af; }
        .ad-modal-footer { display:flex; gap:10px; justify-content:flex-end; padding-top:4px; }

        /* â”€â”€ Storage Info â”€â”€ */
        .ad-storage-bar { background:#f2f3fd; border:1px solid #e1e2ec; border-radius:12px; padding:14px 18px; margin-top:20px; }

        /* â”€â”€ Responsive â”€â”€ */
        @media(max-width:900px) {
            .ad-filter-grid { grid-template-columns:repeat(2,1fr); }
            .ad-grid { grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); }
        }
        @media(max-width:600px) {
            .ad-filter-grid { grid-template-columns:1fr; }
            .ad-grid { grid-template-columns:repeat(2,1fr); }
        }
    </style>

    <div style="margin-top:-4px;">

        {{-- â”€â”€ Flash Message â”€â”€ --}}
        @if(session('sukses'))
        <div style="display:flex;align-items:center;gap:10px;padding:12px 18px;background:#dcfce7;border:1px solid #86efac;border-radius:10px;margin-bottom:20px;font-size:13px;font-weight:700;color:#166534;">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
            {{ session('sukses') }}
        </div>
        @endif

        {{-- â”€â”€ Page Header â”€â”€ --}}
        <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:24px;">
            <div>
                <h1 class="ad-hero-title">Arsip Digital</h1>
                <p class="ad-hero-sub">Kelola dan temukan dokumen historis SMAN 4 Surabaya dengan cepat dan terorganisir.</p>
            </div>
            <div style="display:flex;gap:10px;flex-shrink:0;">
                <button class="ad-btn-out" onclick="document.getElementById('modalBuatFolder').style.display='flex'">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                    Buat Folder
                </button>
                <button class="ad-btn-pri" onclick="document.getElementById('modalUnggah').style.display='flex'">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                    Unggah Dokumen
                </button>
            </div>
        </div>

        {{-- â”€â”€ Stat Cards â”€â”€ --}}
        @php
            try {
                $arsipList  = \App\Models\ArsipDigital::orderBy('created_at','desc')->get();
            } catch (\Exception $e) {
                $arsipList  = collect();
            }
            $totalDok   = $arsipList->where('tipe','file')->count();
            $totalFolder= $arsipList->where('tipe','folder')->count();
            $tervalidasi= $arsipList->where('status','tervalidasi')->count();
            $draft      = $arsipList->where('status','draft')->count();
            $totalBytes = $arsipList->sum('ukuran_bytes');
            // Format total storage
            $storageLabel = $totalBytes < 1024*1024*1024
                ? round($totalBytes/(1024*1024),1).' MB'
                : round($totalBytes/(1024*1024*1024),2).' GB';
        @endphp

        <div class="ad-stat-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:24px;">

            {{-- Total Dokumen --}}
            <div class="ad-stat-card">
                <div class="ad-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#0058be" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                </div>
                <p class="ad-stat-lbl">Total Dokumen</p>
                <p class="ad-stat-val">{{ number_format($totalDok) }}</p>
                <div class="ad-stat-trend tr-blue">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                    Semua waktu
                </div>
            </div>

            {{-- Total Folder --}}
            <div class="ad-stat-card">
                <div class="ad-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#924700" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/></svg>
                </div>
                <p class="ad-stat-lbl">Total Folder</p>
                <p class="ad-stat-val" style="color:#924700;">{{ number_format($totalFolder) }}</p>
                <div class="ad-stat-trend tr-orange">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 01-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 01-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 01-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584zM12 18a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/></svg>
                    Terorganisir
                </div>
            </div>

            {{-- Tervalidasi --}}
            <div class="ad-stat-card">
                <div class="ad-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#166534" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                </div>
                <p class="ad-stat-lbl">Tervalidasi</p>
                <p class="ad-stat-val" style="color:#166534;">{{ number_format($tervalidasi) }}</p>
                <div class="ad-stat-trend tr-green">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
                    Sudah diverifikasi
                </div>
            </div>


        </div>

        {{-- â”€â”€ Filter Panel â”€â”€ --}}
        <div class="ad-filter-panel">
            <div class="ad-filter-title">
                <svg width="18" height="18" fill="none" stroke="#0058be" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/></svg>
                Filter & Pencarian
            </div>
            <div class="ad-filter-grid">
                {{-- Search --}}
                <div>
                    <label class="ad-filter-label">Cari Dokumen</label>
                    <div class="ad-search-wrap">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        <input class="ad-search" id="adSearch" placeholder="Nama dokumen, kategori..." type="search" onkeyup="adFilterGrid()">
                    </div>
                </div>
                {{-- Tahun --}}
                <div>
                    <label class="ad-filter-label">Tahun Arsip</label>
                    <select class="ad-select" id="adTahunFilter" onchange="adFilterGrid()">
                        <option value="">Semua Tahun</option>
                        @for($y = date('Y'); $y >= 2019; $y--)
                        <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                {{-- Kategori --}}
                <div>
                    <label class="ad-filter-label">Kategori</label>
                    <select class="ad-select" id="adKategoriFilter" onchange="adFilterGrid()">
                        <option value="">Semua Kategori</option>
                        <option>Surat Masuk</option>
                        <option>Surat Keluar</option>
                        <option>SK Guru/Staff</option>
                        <option>Ijazah/Sertifikat</option>
                        <option>Laporan</option>
                        <option>Umum</option>
                    </select>
                </div>
                {{-- Status --}}
                <div>
                    <label class="ad-filter-label">Status Validasi</label>
                    <div class="ad-status-btns">
                        <button class="ad-status-btn active-btn" id="statusAll" onclick="adSetStatus('')">Semua</button>
                        <button class="ad-status-btn" id="statusValidasi" onclick="adSetStatus('tervalidasi')">Tervalidasi</button>
                        <button class="ad-status-btn" id="statusDraft" onclick="adSetStatus('draft')">Draft</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- â”€â”€ Toolbar: Breadcrumb & View Toggle â”€â”€ --}}
        <div class="ad-toolbar">
            <nav class="ad-breadcrumb">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/></svg>
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                <a href="#">Arsip Digital</a>
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                <span style="color:#191b23;font-weight:700;">Semua Dokumen</span>
            </nav>
            <div style="display:flex;align-items:center;gap:12px;">
                <span id="adItemCount" style="font-size:12px;color:#727785;font-weight:600;">
                    Menampilkan <strong>{{ $arsipList->count() }}</strong> item
                </span>
                <div class="ad-view-toggle">
                    <button class="ad-view-btn active-view" id="btnGrid" onclick="adSwitchView('grid')" title="Grid View">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M3 6a3 3 0 013-3h2.25a3 3 0 013 3v2.25a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm9.75 0a3 3 0 013-3H18a3 3 0 013 3v2.25a3 3 0 01-3 3h-2.25a3 3 0 01-3-3V6zM3 15.75a3 3 0 013-3h2.25a3 3 0 013 3V18a3 3 0 01-3 3H6a3 3 0 01-3-3v-2.25zm9.75 0a3 3 0 013-3H18a3 3 0 013 3V18a3 3 0 01-3 3h-2.25a3 3 0 01-3-3v-2.25z" clip-rule="evenodd"/></svg>
                    </button>
                    <button class="ad-view-btn" id="btnList" onclick="adSwitchView('list')" title="List View">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.625 6.75a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0zm4.875 0A.75.75 0 018.25 6h12a.75.75 0 010 1.5h-12a.75.75 0 01-.75-.75zM2.625 12a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0zM7.5 12a.75.75 0 01.75-.75h12a.75.75 0 010 1.5h-12A.75.75 0 017.5 12zm-4.875 5.25a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0zm4.875 0a.75.75 0 01.75-.75h12a.75.75 0 010 1.5h-12a.75.75 0 01-.75-.75z" clip-rule="evenodd"/></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- â”€â”€ Archive Grid View â”€â”€ --}}
        <div id="adGridView">
            <div class="ad-grid" id="adGridContainer">

                @forelse($arsipList as $item)
                @php
                    $isFolder = $item->tipe === 'folder';
                    $fmt      = strtolower($item->format ?? '');
                    $klasClass = match($item->klasifikasi) {
                        'Penting'  => 'badge-penting',
                        'Terbatas' => 'badge-terbatas',
                        'Rahasia'  => 'badge-rahasia',
                        default    => 'badge-biasa',
                    };
                    $stClass = $item->status === 'tervalidasi' ? 'badge-tervalidasi' : 'badge-draft';
                @endphp
                <div class="ad-item"
                    data-nama="{{ strtolower($item->nama_dokumen) }}"
                    data-kategori="{{ $item->kategori }}"
                    data-tahun="{{ $item->tahun }}"
                    data-status="{{ $item->status }}">
                    <div class="ad-item-header">
                        @if($isFolder)
                        <div style="width:48px;height:48px;display:flex;align-items:center;justify-content:center;">
                            <svg width="44" height="44" viewBox="0 0 24 24" fill="#924700"><path d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3 1.146z"/></svg>
                        </div>
                        @elseif(in_array($fmt, ['pdf']))
                        <div class="ad-item-icon-wrap" style="background:#fee2e2;">
                            <svg width="28" height="28" fill="none" stroke="#dc2626" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        </div>
                        @elseif(in_array($fmt, ['doc','docx']))
                        <div class="ad-item-icon-wrap" style="background:#dbeafe;">
                            <svg width="28" height="28" fill="none" stroke="#1e40af" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9zm3.75 11.625c0 .621-.504 1.125-1.125 1.125H9.375a1.125 1.125 0 01-1.125-1.125V9.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125v6.375z"/></svg>
                        </div>
                        @elseif(in_array($fmt, ['xls','xlsx']))
                        <div class="ad-item-icon-wrap" style="background:#dcfce7;">
                            <svg width="28" height="28" fill="none" stroke="#166534" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h1.5C5.496 19.5 6 18.996 6 18.375m-3.75.125v-2.25m0 2.25c0 .621.504 1.125 1.125 1.125m0 0h.375m0 0v-3.75m0 0a1.125 1.125 0 011.125-1.125H9m-5.625 3.75h1.5m-1.5 0a1.125 1.125 0 01-1.125-1.125V15m0 0c0-.621.504-1.125 1.125-1.125h1.5m0 0a1.125 1.125 0 011.125 1.125V18m-3.75-7.5h.75M6 9.75h.75m0 0V7.5m0 2.25h2.25m0 0V7.5m0 2.25H12m-3-3H6m6 0h.75m0 0V7.5m0 2.25H15M3 7.5h18M3 7.5A2.25 2.25 0 015.25 5.25h13.5A2.25 2.25 0 0121 7.5v12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 19.5V7.5z"/></svg>
                        </div>
                        @elseif(in_array($fmt, ['jpg','jpeg','png','webp']))
                        <div class="ad-item-icon-wrap" style="background:#fef3c7;">
                            <svg width="28" height="28" fill="none" stroke="#92400e" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                        </div>
                        @else
                        <div class="ad-item-icon-wrap" style="background:#f3e8ff;">
                            <svg width="28" height="28" fill="none" stroke="#6b21a8" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                        </div>
                        @endif
                        <button class="ad-more-btn" onclick="event.stopPropagation()">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M4.5 12a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zm6 0a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" clip-rule="evenodd"/></svg>
                        </button>
                    </div>
                    <p class="ad-item-name" title="{{ $item->nama_dokumen }}">{{ $item->nama_dokumen }}</p>
                    <p class="ad-item-meta">
                        {{ $item->kategori }}
                        @if(!$isFolder && $item->ukuran_bytes > 0)
                        â€¢ {{ $item->ukuran_format }}
                        @elseif($isFolder)
                        â€¢ {{ $item->children()->count() }} item
                        @endif
                    </p>
                    <div class="ad-item-footer">
                        <span class="ad-badge {{ $klasClass }}">{{ $item->klasifikasi }}</span>
                        <span class="ad-item-date">{{ $item->updated_at->format('d M Y') }}</span>
                    </div>
                </div>
                @empty
                {{-- Empty state ditampilkan di bawah --}}
                @endforelse

                @if(\App\Support\RoleAccess::canManageArsip()){{-- Tombol Buat Folder Baru --}}
                <div class="ad-add-card" onclick="document.getElementById('modalBuatFolder').style.display='flex'">
                    <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="ad-add-label">Buat Folder Baru</p>
                </div>
                @endif
            </div>

            @if($arsipList->isEmpty())
            <div style="text-align:center;padding:60px 24px;color:#727785;">
                <svg width="64" height="64" fill="none" stroke="#c2c6d6" stroke-width="1.2" viewBox="0 0 24 24" style="margin:0 auto 16px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 13.5l3 3m0 0l3-3m-3 3v-6m1.06-4.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/></svg>
                <p style="font-size:.95rem;font-weight:700;">Belum ada dokumen</p>
                <small style="font-size:.82rem;">Klik "Unggah Dokumen" untuk menambahkan arsip pertama.</small>
            </div>
            @endif
        </div>

        {{-- â”€â”€ Archive List View (hidden by default) â”€â”€ --}}
        <div id="adListView" style="display:none;">
            <div class="ad-list-card">
                <div class="ad-list-head">
                    <p style="font-size:.95rem;font-weight:700;color:#191b23;">Semua Dokumen</p>
                    <p style="font-size:.82rem;color:#424754;margin-top:2px;">Daftar seluruh arsip digital SMAN 4 Surabaya</p>
                </div>
                <div style="overflow-x:auto;">
                    <table class="ad-table" id="adListTable">
                        <thead>
                            <tr>
                                <th>Nama Dokumen</th>
                                <th>Kategori</th>
                                <th class="center">Klasifikasi</th>
                                <th class="center">Status</th>
                                <th>Format</th>
                                <th>Ukuran</th>
                                <th>Tahun</th>
                                <th class="right" style="padding-right:20px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="adListBody">
                            @forelse($arsipList as $item)
                            @php
                                $isFolder  = $item->tipe === 'folder';
                                $klasClass = match($item->klasifikasi) {
                                    'Penting'  => 'badge-penting',
                                    'Terbatas' => 'badge-terbatas',
                                    'Rahasia'  => 'badge-rahasia',
                                    default    => 'badge-biasa',
                                };
                                $stClass = $item->status === 'tervalidasi' ? 'badge-tervalidasi' : 'badge-draft';
                            @endphp
                            <tr data-nama="{{ strtolower($item->nama_dokumen) }}"
                                data-kategori="{{ $item->kategori }}"
                                data-tahun="{{ $item->tahun }}"
                                data-status="{{ $item->status }}">
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        @if($isFolder)
                                        <svg width="20" height="20" fill="#924700" viewBox="0 0 24 24"><path d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3 1.146z"/></svg>
                                        @elseif(strtolower($item->format??'') === 'pdf')
                                        <svg width="20" height="20" fill="none" stroke="#dc2626" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                        @else
                                        <svg width="20" height="20" fill="none" stroke="#0058be" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                        @endif
                                        <span style="font-weight:600;font-size:13px;">{{ $item->nama_dokumen }}</span>
                                    </div>
                                </td>
                                <td style="font-size:13px;color:#424754;">{{ $item->kategori }}</td>
                                <td class="center"><span class="ad-badge {{ $klasClass }}">{{ $item->klasifikasi }}</span></td>
                                <td class="center"><span class="ad-badge {{ $stClass }}">{{ $item->status === 'tervalidasi' ? 'Tervalidasi' : 'Draft' }}</span></td>
                                <td style="font-family:monospace;font-size:12px;color:#545f73;text-transform:uppercase;">{{ $item->format ?? ($isFolder ? 'Folder' : '-') }}</td>
                                <td style="font-size:13px;color:#424754;">{{ $item->ukuran_format }}</td>
                                <td style="font-size:13px;color:#424754;">{{ $item->tahun ?? '-' }}</td>
                                <td class="right" style="padding-right:16px;">
                                    <div style="display:inline-flex;gap:4px;">
                                        <button class="ad-act-btn" title="Lihat Detail">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </button>
                                        @if($item->path_file)
                                        <a class="ad-act-btn" title="Unduh" href="{{ route('arsip.download', $item) }}">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                        </a>
                                        @else
                                        <button class="ad-act-btn" title="Unduh" type="button" disabled>
                                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                                        </button>
                                        @endif
                                        <button class="ad-act-btn" title="Edit">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                                        </button>
                                        @if(\App\Support\RoleAccess::canManageArsip())
                                            <button class="ad-act-btn danger" title="Hapus" wire:click="hapusArsip({{ $item->id }})" onclick="return confirm('Hapus arsip ini?')">
                                                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <div style="text-align:center;padding:50px 24px;color:#727785;">
                                        <p style="font-size:.95rem;font-weight:700;">Belum ada dokumen</p>
                                        <small>Klik "Unggah Dokumen" untuk menambahkan arsip pertama.</small>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- â”€â”€ Aktivitas Terkini â”€â”€ --}}
        <div class="ad-activity-card">
            <div class="ad-activity-head">
                <div>
                    <p class="ad-activity-title">Aktivitas Terkini</p>
                    <p style="font-size:.82rem;color:#424754;margin-top:2px;">Log akses dan perubahan dokumen arsip.</p>
                </div>
                <a href="#" style="font-size:12px;font-weight:700;color:#0058be;text-decoration:none;">Lihat Semua Log</a>
            </div>
            <div style="overflow-x:auto;">
                <table class="ad-table">
                    <thead>
                        <tr>
                            <th>Dokumen</th>
                            <th>Kategori</th>
                            <th class="center">Aksi</th>
                            <th>Pengguna</th>
                            <th class="right" style="padding-right:20px;">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Dummy aktivitas terkini â€“ ganti dengan data nyata dari log tabel --}}
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <svg width="18" height="18" fill="none" stroke="#dc2626" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <span style="font-size:13px;font-weight:600;">Laporan_PPDB_2024.pdf</span>
                                </div>
                            </td>
                            <td style="font-size:13px;color:#424754;">Laporan</td>
                            <td class="center"><span class="ad-act-badge act-download">DIUNDUH</span></td>
                            <td style="font-size:13px;">Admin TU (Pak Budi)</td>
                            <td class="right" style="font-size:12px;color:#727785;padding-right:20px;">10 menit lalu</td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <svg width="18" height="18" fill="none" stroke="#1e40af" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/></svg>
                                    <span style="font-size:13px;font-weight:600;">SK_Kepala_Sekolah_003.docx</span>
                                </div>
                            </td>
                            <td style="font-size:13px;color:#424754;">SK Guru/Staff</td>
                            <td class="center"><span class="ad-act-badge act-edit">DIEDIT</span></td>
                            <td style="font-size:13px;">Sekretaris (Ibu Maya)</td>
                            <td class="right" style="font-size:12px;color:#727785;padding-right:20px;">2 jam lalu</td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <svg width="18" height="18" fill="#924700" viewBox="0 0 24 24"><path d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3 1.146z"/></svg>
                                    <span style="font-size:13px;font-weight:600;">Arsip Kepegawaian 2023</span>
                                </div>
                            </td>
                            <td style="font-size:13px;color:#424754;">Umum</td>
                            <td class="center"><span class="ad-act-badge act-akses">DIAKSES</span></td>
                            <td style="font-size:13px;">Kepala Sekolah</td>
                            <td class="right" style="font-size:12px;color:#727785;padding-right:20px;">Hari ini, 09:15</td>
                        </tr>
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <svg width="18" height="18" fill="none" stroke="#92400e" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                                    <span style="font-size:13px;font-weight:600;">Scan_Ijazah_Batch_2024.zip</span>
                                </div>
                            </td>
                            <td style="font-size:13px;color:#424754;">Ijazah/Sertifikat</td>
                            <td class="center"><span class="ad-act-badge act-upload">DIUNGGAH</span></td>
                            <td style="font-size:13px;">Admin TU (Pak Budi)</td>
                            <td class="right" style="font-size:12px;color:#727785;padding-right:20px;">Kemarin, 14:30</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>{{-- End main wrapper --}}


    {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
         Modal: Unggah Dokumen
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
    <div id="modalUnggah" class="ad-modal-overlay">
        <div class="ad-modal-box">
            <div class="ad-modal-head">
                <div>
                    <p class="ad-modal-title">Unggah Dokumen Baru</p>
                    <p class="ad-modal-sub">Tambahkan dokumen ke arsip digital SMAN 4 Surabaya.</p>
                </div>
                <button class="ad-modal-close" onclick="document.getElementById('modalUnggah').style.display='none'">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form wire:submit.prevent="unggahDokumen" enctype="multipart/form-data" class="ad-modal-body">
                
                {{-- Dropzone --}}
                <div class="ad-dropzone" id="adDropzone" onclick="document.getElementById('adFileInput').click()">
                    <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                    <p>Klik atau seret file ke sini</p>
                    <small>PDF, DOCX, XLSX, JPG, PNG, ZIP â€“ Maks. 50 MB</small>
                    <input type="file" id="adFileInput" wire:model="arsipFiles" style="display:none;" multiple onchange="adUpdateDropzone(this)">
                </div>
                <div id="adFileList" style="display:none;font-size:12px;color:#424754;padding:8px 12px;background:#f2f3fd;border-radius:8px;"></div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label class="ad-field-label">Nama Dokumen <span style="color:#dc2626;">*</span></label>
                        <input class="ad-field-input" wire:model="nama_dokumen" required placeholder="cth. Laporan PPDB 2024">
                    </div>
                    <div>
                        <label class="ad-field-label">Tahun Arsip</label>
                        <input class="ad-field-input" wire:model="tahun" type="number" min="2000" max="2099" placeholder="{{ date('Y') }}">
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label class="ad-field-label">Kategori</label>
                        <select class="ad-field-select" wire:model="kategori">
                            <option>Surat Masuk</option>
                            <option>Surat Keluar</option>
                            <option>SK Guru/Staff</option>
                            <option>Ijazah/Sertifikat</option>
                            <option>Laporan</option>
                            <option>Umum</option>
                        </select>
                    </div>
                    <div>
                        <label class="ad-field-label">Klasifikasi</label>
                        <select class="ad-field-select" wire:model="klasifikasi">
                            <option>Biasa</option>
                            <option>Penting</option>
                            <option>Terbatas</option>
                            <option>Rahasia</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="ad-field-label">Keterangan</label>
                    <textarea class="ad-field-input" wire:model="keterangan" rows="2" placeholder="Catatan tambahan (opsional)..." style="resize:vertical;font-family:inherit;"></textarea>
                </div>
                <div class="ad-modal-footer">
                    <button type="button" class="ad-btn-out" onclick="document.getElementById('modalUnggah').style.display='none'">Batal</button>
                    <button type="submit" class="ad-btn-pri">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                        Unggah Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•
         Modal: Buat Folder Baru
    â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
    <div id="modalBuatFolder" class="ad-modal-overlay">
        <div class="ad-modal-box" style="max-width:440px;">
            <div class="ad-modal-head">
                <div>
                    <p class="ad-modal-title">Buat Folder Baru</p>
                    <p class="ad-modal-sub">Organisir arsip ke dalam folder yang mudah ditemukan.</p>
                </div>
                <button class="ad-modal-close" onclick="document.getElementById('modalBuatFolder').style.display='none'">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form wire:submit.prevent="buatFolder" class="ad-modal-body">
                
                <div>
                    <label class="ad-field-label">Nama Folder <span style="color:#dc2626;">*</span></label>
                    <input class="ad-field-input" wire:model="nama_dokumen" required placeholder="cth. Arsip Kepegawaian 2024">
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label class="ad-field-label">Kategori</label>
                        <select class="ad-field-select" wire:model="kategori">
                            <option>Umum</option>
                            <option>Surat Masuk</option>
                            <option>Surat Keluar</option>
                            <option>SK Guru/Staff</option>
                            <option>Ijazah/Sertifikat</option>
                            <option>Laporan</option>
                        </select>
                    </div>
                    <div>
                        <label class="ad-field-label">Klasifikasi</label>
                        <select class="ad-field-select" wire:model="klasifikasi">
                            <option>Biasa</option>
                            <option>Penting</option>
                            <option>Terbatas</option>
                            <option>Rahasia</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="ad-field-label">Keterangan</label>
                    <textarea class="ad-field-input" wire:model="keterangan" rows="2" placeholder="Deskripsi folder (opsional)..." style="resize:vertical;font-family:inherit;"></textarea>
                </div>
                <div class="ad-modal-footer">
                    <button type="button" class="ad-btn-out" onclick="document.getElementById('modalBuatFolder').style.display='none'">Batal</button>
                    <button type="submit" class="ad-btn-pri">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        Buat Folder
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        /* â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ View Switch â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        function adSwitchView(mode) {
            const gridView = document.getElementById('adGridView');
            const listView = document.getElementById('adListView');
            const btnGrid  = document.getElementById('btnGrid');
            const btnList  = document.getElementById('btnList');
            if (mode === 'grid') {
                gridView.style.display = '';
                listView.style.display = 'none';
                btnGrid.classList.add('active-view');
                btnList.classList.remove('active-view');
            } else {
                gridView.style.display = 'none';
                listView.style.display = '';
                btnList.classList.add('active-view');
                btnGrid.classList.remove('active-view');
            }
        }

        /* â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ Status Filter â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        let _adCurrentStatus = '';
        function adSetStatus(val) {
            _adCurrentStatus = val;
            document.getElementById('statusAll').classList.toggle('active-btn', val === '');
            document.getElementById('statusValidasi').classList.toggle('active-btn', val === 'tervalidasi');
            document.getElementById('statusDraft').classList.toggle('active-btn', val === 'draft');
            adFilterGrid();
        }

        /* â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ Filter Logic â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        function adFilterGrid() {
            const query    = document.getElementById('adSearch').value.toLowerCase().trim();
            const tahun    = document.getElementById('adTahunFilter').value;
            const kategori = document.getElementById('adKategoriFilter').value;
            const status   = _adCurrentStatus;

            // Grid
            const gridItems = document.querySelectorAll('#adGridContainer .ad-item');
            let shownGrid = 0;
            gridItems.forEach(el => {
                const nama  = el.dataset.nama    || '';
                const kat   = el.dataset.kategori || '';
                const thn   = el.dataset.tahun   || '';
                const st    = el.dataset.status  || '';

                const ok = (!query    || nama.includes(query))
                        && (!tahun    || thn === tahun)
                        && (!kategori || kat === kategori)
                        && (!status   || st === status);

                el.style.display = ok ? '' : 'none';
                if (ok) shownGrid++;
            });

            // List
            const listRows = document.querySelectorAll('#adListBody tr[data-nama]');
            let shownList = 0;
            listRows.forEach(row => {
                const nama  = row.dataset.nama    || '';
                const kat   = row.dataset.kategori || '';
                const thn   = row.dataset.tahun   || '';
                const st    = row.dataset.status  || '';

                const ok = (!query    || nama.includes(query))
                        && (!tahun    || thn === tahun)
                        && (!kategori || kat === kategori)
                        && (!status   || st === status);

                row.style.display = ok ? '' : 'none';
                if (ok) shownList++;
            });

            // Update count label
            const countEl = document.getElementById('adItemCount');
            if (countEl) {
                const shown = document.getElementById('adGridView').style.display === 'none' ? shownList : shownGrid;
                countEl.innerHTML = 'Menampilkan <strong>' + shown + '</strong> item';
            }
        }

        /* â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ Dropzone â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        function adUpdateDropzone(input) {
            const listEl = document.getElementById('adFileList');
            if (input.files.length === 0) { listEl.style.display='none'; return; }
            listEl.style.display = 'block';
            let html = '<strong>File dipilih:</strong><ul style="margin:6px 0 0 14px;">';
            for (const f of input.files) {
                const size = f.size < 1024*1024 ? (f.size/1024).toFixed(1)+' KB' : (f.size/(1024*1024)).toFixed(1)+' MB';
                html += `<li>${f.name} <span style="color:#9ca3af;">(${size})</span></li>`;
            }
            html += '</ul>';
            listEl.innerHTML = html;
        }

        // Drag-and-drop
        const dz = document.getElementById('adDropzone');
        if (dz) {
            ['dragenter','dragover'].forEach(ev => dz.addEventListener(ev, e => { e.preventDefault(); dz.classList.add('dragover'); }));
            ['dragleave','drop'].forEach(ev => dz.addEventListener(ev, e => { e.preventDefault(); dz.classList.remove('dragover'); }));
            dz.addEventListener('drop', e => {
                const fi = document.getElementById('adFileInput');
                fi.files = e.dataTransfer.files;
                adUpdateDropzone(fi);
            });
        }

        /* â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ Close modals on backdrop click â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        ['modalUnggah','modalBuatFolder'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.addEventListener('click', function(e) { if (e.target === this) this.style.display = 'none'; });
        });

        /* â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ Hover animation (grid items) â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
        document.querySelectorAll('.ad-item').forEach(card => {
            card.addEventListener('mouseenter', () => card.style.transform = 'translateY(-3px)');
            card.addEventListener('mouseleave', () => card.style.transform = 'translateY(0)');
        });
    </script>

</x-filament-panels::page>


