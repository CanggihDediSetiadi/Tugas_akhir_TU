{{-- SMAN 4 Surabaya – Halaman Disposisi --}}
<x-filament-panels::page>
    {{ $this->content }}

    <style>
        /* ── Base ── */
        .dp-hero-title { font-size:2rem; font-weight:800; line-height:1.15; letter-spacing:-0.02em; color:#191b23; }
        .dp-hero-sub   { font-size:.93rem; color:#424754; margin-top:4px; }

        html.dark .dp-hero-title { color:#ffffff !important; }
        html.dark .dp-hero-sub { color:#e5e7eb !important; }
        /* ── Buttons ── */
        .dp-btn-out {
            display:inline-flex;align-items:center;gap:6px;
            padding:8px 16px; background:#fff; border:1px solid #dde0ef;
            border-radius:8px; font-size:12px; font-weight:700; color:#191b23;
            cursor:pointer; box-shadow:0 1px 2px rgba(0,0,0,.05); transition:background .15s;
            text-decoration:none;
        }
        .dp-btn-out:hover { background:#f2f3fd; }
        .dp-btn-pri {
            display:inline-flex;align-items:center;gap:7px;
            padding:9px 18px; background:#0058be; border:none;
            border-radius:8px; font-size:12px; font-weight:700; color:#fff;
            cursor:pointer; box-shadow:0 2px 8px rgba(0,88,190,.35); transition:background .15s, transform .1s;
            text-decoration:none;
        }
        .dp-btn-pri:hover { background:#0049a0; transform:translateY(-1px); }
        .dp-btn-danger {
            display:inline-flex;align-items:center;gap:7px;
            padding:9px 18px; background:#fff; border:1px solid #dde0ef;
            border-radius:8px; font-size:12px; font-weight:700; color:#424754;
            cursor:pointer; transition:background .15s;
        }
        .dp-btn-danger:hover { background:#f2f3fd; }

        /* ── Stat Cards ── */
        .dp-stat-card {
            background:#ffffff; border:1px solid #e1e2ec; border-radius:14px;
            padding:20px 22px; position:relative; overflow:hidden;
            box-shadow:0 1px 4px rgba(0,0,0,.06); transition:box-shadow .2s, transform .2s;
        }
        .dp-stat-card:hover { box-shadow:0 6px 18px rgba(0,0,0,.1); transform:translateY(-2px); }
        .dp-stat-bg { position:absolute;top:10px;right:10px;opacity:.08;pointer-events:none;transition:opacity .3s; }
        .dp-stat-card:hover .dp-stat-bg { opacity:.14; }
        .dp-stat-lbl { font-size:10.5px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:#727785; }
        .dp-stat-val { font-size:2.3rem;font-weight:800;line-height:1.1;color:#191b23;margin-top:6px; }
        .dp-stat-trend { display:flex;align-items:center;gap:5px;margin-top:8px;font-size:11.5px;font-weight:700; }
        .tr-blue  { color:#0058be; }
        .tr-green { color:#166534; }
        .tr-red   { color:#dc2626; }
        .tr-orange{ color:#924700; }

        /* ── Table Card ── */
        .dp-card {
            background:#fff; border:1px solid #e1e2ec; border-radius:14px;
            box-shadow:0 1px 4px rgba(0,0,0,.06); overflow:hidden;
        }
        .dp-card-head { padding:20px 24px 14px; display:flex; align-items:flex-end; justify-content:space-between; gap:12px; flex-wrap:wrap; border-bottom:1px solid #ecedf7; }
        .dp-section-title { font-size:1.05rem; font-weight:700; color:#191b23; }
        .dp-section-sub   { font-size:.82rem; color:#424754; margin-top:2px; }

        /* Filter Bar */
        .dp-filter-bar { display:flex; gap:10px; align-items:center; flex-wrap:wrap; padding:14px 24px; background:#f9f9ff; border-bottom:1px solid #ecedf7; }
        .dp-search-wrap { position:relative; flex:1; min-width:200px; }
        .dp-search-wrap svg { position:absolute;left:11px;top:50%;transform:translateY(-50%);color:#727785;pointer-events:none; }
        .dp-search { width:100%;padding:8px 12px 8px 35px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;background:#fff;outline:none;color:#191b23;transition:border-color .2s; }
        .dp-search:focus { border-color:#0058be; box-shadow:0 0 0 3px rgba(0,88,190,.1); }
        .dp-select { padding:8px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:12px;font-weight:600;color:#424754;background:#fff;outline:none;cursor:pointer; }
        .dp-select:focus { border-color:#0058be; }

        /* Table */
        .dp-table { width:100%;border-collapse:collapse; }
        .dp-table th { padding:10px 16px;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#727785;background:#f5f5fe;border-bottom:1px solid #e1e2ec;white-space:nowrap;text-align:left; }
        .dp-table td { padding:13px 16px;font-size:13.5px;color:#191b23;border-bottom:1px solid #ecedf7;vertical-align:middle; }
        .dp-table tr:last-child td { border-bottom:none; }
        .dp-table tr:hover td { background:#f9f9ff; cursor:pointer; }
        .dp-table .center { text-align:center; }
        .dp-table .right  { text-align:right; }

        /* Badges */
        .dp-badge { display:inline-flex;align-items:center;padding:3px 10px;border-radius:4px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.04em; }
        .badge-pending  { background:#fef9c3;color:#854d0e;border:1px solid #fde047; }
        .badge-diproses { background:#dbeafe;color:#1e40af;border:1px solid #93c5fd; }
        .badge-selesai  { background:#dcfce7;color:#166534;border:1px solid #86efac; }
        .badge-segera   { background:#e0f2fe;color:#075985;border:1px solid #7dd3fc; }
        .badge-sangat   { background:#fee2e2;color:#991b1b;border:1px solid #fca5a5; }

        /* Action buttons */
        .dp-act-btn { background:none;border:none;cursor:pointer;color:#9ca3af;padding:5px;border-radius:6px;transition:color .15s, background .15s;display:inline-flex;align-items:center;justify-content:center; }
        .dp-act-btn:hover { color:#0058be;background:#eff6ff; }
        .dp-act-btn.danger:hover { color:#dc2626;background:#fee2e2; }

        /* Pagination */
        .dp-pagination { display:flex;align-items:center;justify-content:space-between;padding:14px 24px;border-top:1px solid #ecedf7;flex-wrap:wrap;gap:10px; }
        .dp-page-info  { font-size:12px;color:#727785; }
        .dp-page-btns  { display:flex;gap:6px; }
        .dp-page-btn   { padding:5px 11px;border:1px solid #dde0ef;background:#fff;border-radius:6px;font-size:12px;font-weight:600;color:#424754;cursor:pointer;transition:background .15s; }
        .dp-page-btn:hover   { background:#f2f3fd; }
        .dp-page-btn.active  { background:#0058be;border-color:#0058be;color:#fff; }
        .dp-page-btn:disabled { opacity:.45;cursor:default; }

        /* Empty */
        .dp-empty { padding:60px 24px;text-align:center;color:#727785; }
        .dp-empty svg { margin:0 auto 16px;opacity:.35; }
        .dp-empty p  { font-size:.95rem;font-weight:600; }
        .dp-empty small { font-size:.82rem; }

        /* Flash */
        .dp-flash { display:flex;align-items:center;gap:10px;padding:12px 18px;background:#dcfce7;border:1px solid #86efac;border-radius:10px;margin-bottom:20px;font-size:13px;font-weight:700;color:#166534; }

        /* ── Detail Panel (Drawer-style) ── */
        .dp-overlay { display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9998; }
        .dp-detail-panel {
            position:fixed;top:0;right:-700px;width:min(700px,100vw);height:100vh;
            background:#fff;z-index:9999;box-shadow:-8px 0 32px rgba(0,0,0,.15);
            transition:right .3s cubic-bezier(.4,0,.2,1);display:flex;flex-direction:column;overflow:hidden;
        }
        .dp-detail-panel.open { right:0; }
        .dp-panel-head { display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border-bottom:1px solid #ecedf7;flex-shrink:0; }
        .dp-panel-body { flex:1;overflow-y:auto;padding:24px; }
        .dp-panel-body::-webkit-scrollbar { width:5px; }
        .dp-panel-body::-webkit-scrollbar-thumb { background:#c2c6d6;border-radius:99px; }

        /* Timeline */
        .dp-timeline { position:relative;padding-left:28px; }
        .dp-timeline::before { content:'';position:absolute;left:9px;top:6px;bottom:6px;width:2px;background:#e1e2ec; }
        .dp-tl-item { position:relative;margin-bottom:20px; }
        .dp-tl-item:last-child { margin-bottom:0; }
        .dp-tl-dot { position:absolute;left:-28px;width:20px;height:20px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:#0058be;border:3px solid #d8e2ff; }
        .dp-tl-dot.pending { background:#fff;border:2px solid #0058be; }
        .dp-tl-dot.pending::after { content:'';width:8px;height:8px;background:#0058be;border-radius:50%;animation:pulse-ring 1.5s ease-in-out infinite; }
        @keyframes pulse-ring { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(.8)} }

        /* Info grid */
        .dp-info-grid { display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px; }
        .dp-info-label { font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#727785;margin-bottom:3px; }
        .dp-info-val   { font-size:14px;color:#191b23;font-weight:500; }

        /* Form inside panel */
        .dp-form-label { font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px; }
        .dp-form-input { width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;color:#191b23;outline:none;background:#fff;transition:border-color .2s; }
        .dp-form-input:focus { border-color:#0058be;box-shadow:0 0 0 3px rgba(0,88,190,.1); }
        .dp-radio-card { display:flex;align-items:center;gap:8px;padding:9px 12px;border:1.5px solid #dde0ef;border-radius:8px;cursor:pointer;transition:border-color .15s, background .15s;font-size:13px;font-weight:600;color:#424754; }
        .dp-radio-card:has(input:checked) { border-color:#0058be;background:#eff6ff;color:#0058be; }

        /* Lembar disposisi digital */
        .dp-paper-card { background:#fff;border:1px solid #d5d8e5;border-radius:14px;box-shadow:0 2px 8px rgba(0,0,0,.06);overflow:hidden; }
        .dp-paper-head { padding:22px 26px;text-align:center;border-bottom:2px solid #1f2937;background:#fafafa; }
        .dp-paper-title { font-size:1.25rem;font-weight:900;letter-spacing:.06em;color:#111827;text-transform:uppercase; }
        .dp-paper-sub { font-size:.8rem;color:#64748b;margin-top:4px; }
        .dp-paper-body { padding:24px 26px;display:flex;flex-direction:column;gap:20px; }
        .dp-sheet-section { border:1px solid #d8dbe7;border-radius:10px;padding:16px;background:#fff; }
        .dp-sheet-title { font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.07em;color:#334155;margin-bottom:12px; }
        .dp-type-grid { display:grid;grid-template-columns:repeat(5,1fr);gap:9px; }
        .dp-data-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:14px; }
        .dp-main-grid { display:grid;grid-template-columns:1fr 1.15fr .75fr;gap:14px;align-items:stretch; }
        .dp-check-list { display:flex;flex-direction:column;gap:7px; }
        .dp-check-item { display:flex;align-items:flex-start;gap:8px;padding:7px 9px;border:1px solid #e2e5ef;border-radius:7px;font-size:12.5px;color:#334155;cursor:pointer;line-height:1.35; }
        .dp-check-item:has(input:checked) { border-color:#0058be;background:#eff6ff;color:#0058be;font-weight:700; }
        .dp-check-item input { margin-top:2px;accent-color:#0058be; }
        .dp-readonly { background:#f8fafc;color:#475569; }
        .dp-note { padding:11px 14px;background:#fffbea;border:1px solid #fde68a;border-radius:8px;font-size:12px;color:#713f12;line-height:1.55; }

        /* Modal konfirmasi hapus */
        .dp-delete-overlay { position:fixed;inset:0;z-index:10000;display:flex;align-items:center;justify-content:center;padding:20px;background:rgba(15,23,42,.55);backdrop-filter:blur(3px); }
        .dp-delete-modal { width:100%;max-width:430px;background:#fff;border-radius:18px;box-shadow:0 24px 70px rgba(15,23,42,.3);overflow:hidden;animation:dpModalIn .2s ease-out; }
        .dp-delete-top { padding:28px 28px 22px;text-align:center;background:linear-gradient(180deg,#fff7f7 0%,#fff 100%); }
        .dp-delete-icon { width:62px;height:62px;margin:0 auto 16px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#dc2626;background:#fee2e2;box-shadow:0 0 0 9px #fff1f2; }
        .dp-delete-title { font-size:1.15rem;font-weight:800;color:#191b23; }
        .dp-delete-text { margin-top:8px;font-size:13px;line-height:1.6;color:#64748b; }
        .dp-delete-number { display:inline-block;max-width:100%;margin-top:13px;padding:7px 12px;border:1px solid #fecaca;border-radius:7px;background:#fff;color:#b91c1c;font-family:monospace;font-size:12px;font-weight:700;overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
        .dp-delete-actions { display:flex;gap:10px;padding:18px 24px 24px;border-top:1px solid #f1f2f7; }
        .dp-delete-cancel, .dp-delete-confirm { flex:1;display:inline-flex;align-items:center;justify-content:center;gap:7px;padding:10px 16px;border-radius:9px;font-size:13px;font-weight:700;cursor:pointer;transition:all .15s; }
        .dp-delete-cancel { border:1px solid #d8dbe7;background:#fff;color:#475569; }
        .dp-delete-cancel:hover { background:#f8fafc;border-color:#b8bdcc; }
        .dp-delete-confirm { border:none;background:#dc2626;color:#fff;box-shadow:0 4px 12px rgba(220,38,38,.28); }
        .dp-delete-confirm:hover { background:#b91c1c;transform:translateY(-1px); }
        .dp-delete-confirm:disabled { opacity:.65;cursor:wait;transform:none; }
        @keyframes dpModalIn { from { opacity:0;transform:translateY(10px) scale(.98); } to { opacity:1;transform:none; } }

        /* Tips card */
        .dp-tips { display:flex;gap:10px;align-items:flex-start;padding:12px 14px;background:#fef9c3;border:1px solid #fde047;border-radius:10px; }

        @media(max-width:640px){
            .dp-stat-grid { grid-template-columns:repeat(2,1fr) !important; }
            .dp-info-grid { grid-template-columns:1fr; }
            .dp-type-grid, .dp-data-grid, .dp-main-grid { grid-template-columns:1fr; }
        }
    </style>

    {{-- ── Overlay ── --}}
    <div class="dp-overlay" id="dpOverlay" onclick="closeDetailPanel()"></div>

    {{-- ── Detail Side Panel ── --}}
    <div class="dp-detail-panel" id="dpDetailPanel">
        <div class="dp-panel-head">
            <div>
                <p style="font-size:1.1rem;font-weight:800;color:#191b23;">Detail Disposisi</p>
                <p style="font-size:.82rem;color:#424754;margin-top:2px;">SMAN 4 Surabaya – Tata Usaha</p>
            </div>
            <button onclick="closeDetailPanel()" style="background:none;border:none;cursor:pointer;color:#9ca3af;padding:4px;border-radius:6px;transition:color .15s;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#9ca3af'">
                <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="dp-panel-body" id="dpPanelBody">
            {{-- Diisi via JS --}}
        </div>
    </div>

    <div style="margin-top:-4px;">

        {{-- Flash --}}
        @if(session('sukses'))
        <div class="dp-flash">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
            {{ session('sukses') }}
        </div>
        @endif

        {{-- Page Header --}}
        <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:24px;">
            <div>
                <h1 class="dp-hero-title">{{ \App\Support\RoleAccess::isDisposisiRecipient() ? 'Disposisi Saya' : 'Disposisi Surat' }}</h1>
                <p class="dp-hero-sub">{{ \App\Support\RoleAccess::isDisposisiRecipient() ? 'Lihat dan tindak lanjuti disposisi yang ditujukan kepada Anda.' : 'Teruskan dan kelola disposisi surat masuk SMAN 4 Surabaya.' }}</p>
            </div>
        </div>

        {{-- Stat Cards --}}
        @php
            $disposisiQuery = \App\Models\Disposisi::with('suratMasuk')->orderBy('created_at','desc');
            if (\App\Support\RoleAccess::isDisposisiRecipient()) {
                $disposisiQuery->forRecipients(\App\Support\RoleAccess::disposisiRecipients());
            }
            $disposisiList = $disposisiQuery->get();
            $total    = $disposisiList->count();
            $pending  = $disposisiList->where('status','pending')->count();
            $diproses = $disposisiList->where('status','diproses')->count();
            $selesai  = $disposisiList->where('status','selesai')->count();

            // Surat masuk yang belum punya disposisi
            $belumDisposisi = \App\Models\SuratMasuk::where('status','belum_disposisi')->count();
        @endphp

        <div class="dp-stat-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">

            <div class="dp-stat-card">
                <div class="dp-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#0058be" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
                </div>
                <p class="dp-stat-lbl">Total Disposisi</p>
                <p class="dp-stat-val">{{ number_format($total) }}</p>
                <div class="dp-stat-trend tr-blue">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                    Semua waktu
                </div>
            </div>

            <div class="dp-stat-card">
                <div class="dp-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#dc2626" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                </div>
                <p class="dp-stat-lbl">{{ \App\Support\RoleAccess::isDisposisiRecipient() ? 'Menunggu' : 'Surat Belum Disposisi' }}</p>
                <p class="dp-stat-val" style="color:#dc2626;">{{ \App\Support\RoleAccess::isDisposisiRecipient() ? $pending : $belumDisposisi }}</p>
                <div class="dp-stat-trend tr-red">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/></svg>
                    {{ \App\Support\RoleAccess::isDisposisiRecipient() ? 'Perlu ditindaklanjuti' : 'Segera ditindak' }}
                </div>
            </div>

            <div class="dp-stat-card">
                <div class="dp-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#1e40af" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="dp-stat-lbl">Sedang Diproses</p>
                <p class="dp-stat-val" style="color:#1e40af;">{{ $pending + $diproses }}</p>
                <div class="dp-stat-trend tr-blue">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd"/></svg>
                    Menunggu tindak lanjut
                </div>
            </div>

            <div class="dp-stat-card">
                <div class="dp-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#166534" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="dp-stat-lbl">Selesai</p>
                <p class="dp-stat-val" style="color:#166534;">{{ $selesai }}</p>
                <div class="dp-stat-trend tr-green">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
                    Proses selesai
                </div>
            </div>

        </div>

        {{-- ── TABS: Buat Disposisi Baru | Daftar Disposisi ── --}}
        <div style="display:flex;gap:0;border-bottom:2px solid #e1e2ec;margin-bottom:24px;">
            @if(\App\Support\RoleAccess::canCreateDisposisi())<button id="tabBuat" onclick="switchTab('buat')" style="padding:10px 20px;font-size:13px;font-weight:700;border:none;background:none;cursor:pointer;color:#0058be;border-bottom:2px solid #0058be;margin-bottom:-2px;transition:all .15s;">
                + Buat Disposisi Baru
            </button>
            @endif
            <button id="tabDaftar" onclick="switchTab('daftar')" style="padding:10px 20px;font-size:13px;font-weight:700;border:none;background:none;cursor:pointer;color:#727785;border-bottom:2px solid transparent;margin-bottom:-2px;transition:all .15s;">
                Daftar Disposisi
            </button>
        </div>

        {{-- ── TAB: BUAT DISPOSISI BARU ── --}}
        <div id="paneBuat" style="display:{{ \App\Support\RoleAccess::canCreateDisposisi() ? 'block' : 'none' }};">
            @php
                $suratMasukOptions = \App\Models\SuratMasuk::orderByDesc('tanggal_terima')->orderByDesc('created_at')->get();
                $instruksiOptions = ['Hadiri / Wakili', 'Selesaikan / Proses', 'Siapkan Surat Tugas', 'Cukup Diketahui', 'Arsip di Tata Usaha', 'Bicarakan / Laporkan', 'Tindak Lanjuti', 'Pertimbangkan'];
                $penerimaOptions = ['Waka Kurikulum', 'Waka Kesiswaan', 'Waka Sarana Prasarana', 'Waka Humas', 'Koordinator Tata Usaha', 'Koordinator BK', 'Koordinator Mapel', 'Bendahara', 'OSIS'];
            @endphp

            <div class="dp-paper-card">
                <div class="dp-paper-head">
                    <p class="dp-paper-title">Lembar Disposisi</p>
                    <p class="dp-paper-sub">SMAN 4 Surabaya — Tata Usaha</p>
                </div>
                <form wire:submit.prevent="simpanDisposisi" class="dp-paper-body">
                    @if($errors->any())
                    <div style="background:#fee2e2;border:1px solid #fca5a5;border-radius:8px;padding:10px 14px;font-size:12px;color:#991b1b;">
                        <ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                    @endif

                    <div>
                        <label class="dp-form-label">Pilih Surat Masuk <span style="color:#dc2626">*</span></label>
                        <select wire:model="surat_masuk_id" class="dp-form-input" style="cursor:pointer;" required>
                            <option value="">— Pilih surat masuk —</option>
                            @forelse($suratMasukOptions as $sm)
                            <option value="{{ $sm->id }}">{{ $sm->no_urut_masuk ?: '-' }} — {{ \Illuminate\Support\Str::limit($sm->asal_surat, 32) }} — {{ \Illuminate\Support\Str::limit($sm->perihal, 55) }}</option>
                            @empty
                            <option value="" disabled>Belum ada surat masuk.</option>
                            @endforelse
                        </select>
                    </div>

                    <section class="dp-sheet-section">
                        <p class="dp-sheet-title">Klasifikasi / Sifat Surat</p>
                        <div class="dp-type-grid">
                            @foreach(['Biasa', 'Penting', 'Segera', 'Rahasia', 'Lain-lain'] as $jenis)
                            <label class="dp-radio-card"><input type="radio" wire:model="sifat" value="{{ $jenis }}" style="accent-color:#0058be;"><span>{{ $jenis }}</span></label>
                            @endforeach
                        </div>
                    </section>

                    <section class="dp-sheet-section">
                        <p class="dp-sheet-title">Agenda dan Penyelesaian</p>
                        <div class="dp-data-grid">
                            <div><label class="dp-form-label">No. Agenda <span style="color:#dc2626">*</span></label><input wire:model="nomor_agenda" class="dp-form-input" placeholder="Contoh: 001" required></div>
                            <div><label class="dp-form-label">Tanggal Disposisi <span style="color:#dc2626">*</span></label><input type="date" wire:model="tanggal_disposisi" class="dp-form-input" required></div>
                            <div><label class="dp-form-label">Tanggal Penyelesaian</label><input type="date" wire:model="tanggal_penyelesaian" class="dp-form-input"></div>
                        </div>
                    </section>

                    <section class="dp-sheet-section">
                        <p class="dp-sheet-title">Data Surat</p>
                        <div class="dp-data-grid">
                            <div><label class="dp-form-label">Asal Surat <span style="color:#dc2626">*</span></label><input wire:model="asal_surat" class="dp-form-input" placeholder="Contoh: Komite SMAN 4 Surabaya" required></div>
                            <div><label class="dp-form-label">Tanggal Surat <span style="color:#dc2626">*</span></label><input type="date" wire:model="tanggal_surat" class="dp-form-input" required></div>
                            <div><label class="dp-form-label">Tanggal Terima <span style="color:#dc2626">*</span></label><input type="date" wire:model="tanggal_terima" class="dp-form-input" required></div>
                            <div style="grid-column:1/-1;"><label class="dp-form-label">Perihal <span style="color:#dc2626">*</span></label><input wire:model="perihal" class="dp-form-input" placeholder="Contoh: Koordinasi Program Sekolah" required></div>
                        </div>
                    </section>

                    <div class="dp-main-grid">
                        <section class="dp-sheet-section">
                            <p class="dp-sheet-title">Instruksi / Informasi</p>
                            <div class="dp-check-list">
                                @foreach($instruksiOptions as $nomor => $item)
                                <label class="dp-check-item"><input type="checkbox" wire:model="instruksi_pilihan" value="{{ $item }}"><span>{{ $nomor + 1 }}. {{ $item }}</span></label>
                                @endforeach
                            </div>
                            <input wire:model="instruksi_lainnya" class="dp-form-input" placeholder="Instruksi lainnya..." style="margin-top:9px;">
                        </section>

                        <section class="dp-sheet-section">
                            <p class="dp-sheet-title">Diteruskan Kepada / Telah Membaca <span style="color:#dc2626">*</span></p>
                            <div class="dp-check-list">
                                @foreach($penerimaOptions as $nomor => $item)
                                <label class="dp-check-item"><input type="checkbox" wire:model="penerima_pilihan" value="{{ $item }}"><span>{{ $nomor + 1 }}. {{ $item }}</span></label>
                                @endforeach
                            </div>
                            <input wire:model="penerima_lainnya" class="dp-form-input" placeholder="Penerima lainnya..." style="margin-top:9px;">
                        </section>

                        <section class="dp-sheet-section">
                            <p class="dp-sheet-title">Tanda Tangan / Paraf</p>
                            <textarea wire:model="paraf" class="dp-form-input" rows="12" placeholder="Nama atau catatan paraf..."></textarea>
                        </section>
                    </div>

                    <section class="dp-sheet-section">
                        <label class="dp-sheet-title" style="display:block;">Memo</label>
                        <textarea wire:model="memo" class="dp-form-input" rows="4" placeholder="Tuliskan memo disposisi..."></textarea>
                    </section>

                    <div class="dp-note"><strong>Catatan:</strong> Setelah membaca atau melaksanakan tugas, surat harus dikembalikan ke petugas agendaris di Tata Usaha.</div>
                    <div style="display:flex;gap:10px;justify-content:flex-end;">
                        <button type="button" wire:click="resetForm" class="dp-btn-out">Reset</button>
                        <button type="submit" class="dp-btn-pri">
                            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                            Kirim Disposisi
                        </button>
                    </div>
                </form>
            </div>

            @if(false)
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;align-items:start;">

                {{-- Form Buat Disposisi --}}
                <div class="dp-card" style="padding:24px;">
                    <p style="font-size:1.05rem;font-weight:800;color:#191b23;margin-bottom:4px;">Form Disposisi</p>
                    <p style="font-size:.82rem;color:#424754;margin-bottom:20px;">Isi dan teruskan disposisi surat masuk kepada pejabat yang berwenang.</p>

                    <form wire:submit.prevent="simpanDisposisi" style="display:flex;flex-direction:column;gap:16px;">
                        
                        <div>
                            <label class="dp-form-label">Pilih Surat Masuk <span style="color:#dc2626">*</span></label>
                            @php
                                $suratMasukOptions = \App\Models\SuratMasuk::orderByDesc('tanggal_terima')->orderByDesc('created_at')->get();
                            @endphp
                            <select wire:model="surat_masuk_id" class="dp-form-input" style="padding:9px 12px;cursor:pointer;" required>
                                <option value="">- Pilih surat masuk -</option>
                                @forelse($suratMasukOptions as $sm)
                                <option value="{{ $sm->id }}">
                                    {{ \Illuminate\Support\Str::limit($sm->asal_surat, 35) }} - {{ \Illuminate\Support\Str::limit($sm->perihal, 60) }}
                                </option>
                                @empty
                                <option value="" disabled>Belum ada surat masuk. Tambahkan data di menu Surat Masuk terlebih dahulu.</option>
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <label class="dp-form-label">Diteruskan Ke <span style="color:#dc2626">*</span></label>
                            <select wire:model="diteruskan_ke" class="dp-form-input" style="padding:9px 12px;cursor:pointer;" required>
                                <option value="">— Pilih penerima —</option>
                                <option value="Kepala Sekolah">Kepala Sekolah</option>
                                <option value="Wakasek Bid. Kurikulum">Wakasek Bid. Kurikulum</option>
                                <option value="Wakasek Bid. Kesiswaan">Wakasek Bid. Kesiswaan</option>
                                <option value="Wakasek Bid. Hubungan Industri">Wakasek Bid. Hubungan Industri</option>
                                <option value="Wakasek Bid. Sarana Prasarana">Wakasek Bid. Sarana Prasarana</option>
                                <option value="Bendahara Sekolah">Bendahara Sekolah</option>
                                <option value="Kepala Tata Usaha">Kepala Tata Usaha</option>
                            </select>
                        </div>
                        <div>
                            <label class="dp-form-label">Sifat Disposisi</label>
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;">
                                <label class="dp-radio-card">
                                    <input type="radio" wire:model="sifat" value="sangat_segera" style="accent-color:#0058be;">
                                    <span>Sangat Segera</span>
                                </label>
                                <label class="dp-radio-card">
                                    <input type="radio" wire:model="sifat" value="segera" style="accent-color:#0058be;">
                                    <span>Segera</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="dp-form-label">Instruksi / Catatan</label>
                            <textarea wire:model="instruksi" class="dp-form-input" rows="4" placeholder="Tulis instruksi khusus untuk penerima..."></textarea>
                        </div>
                        <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:4px;">
                            <button type="reset" class="dp-btn-out">Reset</button>
                            <button type="submit" class="dp-btn-pri">
                                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                                Kirim Disposisi
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Tips + Info Panel --}}
                <div style="display:flex;flex-direction:column;gap:16px;">
                    <div class="dp-tips">
                        <svg width="22" height="22" fill="#d97706" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:1px;"><path fill-rule="evenodd" d="M9 4.5a.75.75 0 01.721.544l.813 2.846a3.75 3.75 0 002.576 2.576l2.846.813a.75.75 0 010 1.442l-2.846.813a3.75 3.75 0 00-2.576 2.576l-.813 2.846a.75.75 0 01-1.442 0l-.813-2.846a3.75 3.75 0 00-2.576-2.576l-2.846-.813a.75.75 0 010-1.442l2.846-.813A3.75 3.75 0 007.466 7.89l.813-2.846A.75.75 0 019 4.5z" clip-rule="evenodd"/></svg>
                        <div>
                            <p style="font-size:12px;font-weight:800;color:#92400e;margin-bottom:4px;">Tips Disposisi</p>
                            <ul style="font-size:12px;color:#78350f;line-height:1.7;list-style:disc;padding-left:14px;">
                                <li>Pastikan nomor surat sudah dicatat di buku agenda sebelum disposisi dikirim.</li>
                                <li>Lampirkan file pendukung jika disposisi diteruskan ke Bendahara Sekolah.</li>
                                <li>Sifat "Sangat Segera" harus ditanggapi maksimal 1×24 jam.</li>
                                <li>Konfirmasi penerimaan dari pejabat tujuan setelah disposisi dikirim.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="dp-card" style="padding:20px;">
                        <p style="font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#727785;margin-bottom:12px;">Struktur Disposisi SMAN 4 Surabaya</p>
                        @php
                            $strukturItems = [
                                ['Kepala Sekolah','Kebijakan & keputusan strategis','#0058be'],
                                ['Wakasek Kurikulum','Administrasi & pembelajaran','#1e40af'],
                                ['Wakasek Kesiswaan','Kegiatan & ekstra siswa','#166534'],
                                ['Wakasek Hub. Industri','Kerjasama & prakerin','#854d0e'],
                                ['Bendahara Sekolah','Keuangan & anggaran','#991b1b'],
                                ['Kepala Tata Usaha','Surat & arsip sekolah','#374151'],
                            ];
                        @endphp
                        @foreach($strukturItems as [$jabatan, $keterangan, $warna])
                        <div style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f0f0f5;">
                            <span style="width:8px;height:8px;border-radius:50%;background:{{ $warna }};flex-shrink:0;"></span>
                            <div>
                                <p style="font-size:12.5px;font-weight:700;color:#191b23;">{{ $jabatan }}</p>
                                <p style="font-size:11px;color:#727785;">{{ $keterangan }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        {{-- ── TAB: DAFTAR DISPOSISI ── --}}
        <div id="paneDaftar" style="display:{{ \App\Support\RoleAccess::canCreateDisposisi() ? 'none' : 'block' }};">
            <div class="dp-card">

                <div class="dp-card-head">
                    <div>
                        <p class="dp-section-title">Semua Disposisi</p>
                        <p class="dp-section-sub">Daftar seluruh disposisi yang telah dibuat di sistem.</p>
                    </div>
                    <span style="font-size:11px;font-weight:700;background:#eff6ff;color:#1e40af;padding:4px 12px;border-radius:20px;border:1px solid #bfdbfe;">
                        {{ $total }} disposisi
                    </span>
                </div>

                <div class="dp-filter-bar">
                    <div class="dp-search-wrap">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                        <input class="dp-search" id="dpSearch" placeholder="Cari nomor, penerima, perihal..." type="search" onkeyup="dpFilterTable()"/>
                    </div>
                    <select class="dp-select" id="dpStatusFilter" onchange="dpFilterTable()">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <select class="dp-select" id="dpSifatFilter" onchange="dpFilterTable()">
                        <option value="">Semua Sifat</option>
                        <option value="sangat_segera">Sangat Segera</option>
                        <option value="segera">Segera</option>
                        <option value="Biasa">Biasa</option>
                        <option value="Penting">Penting</option>
                        <option value="Segera">Segera (Lembar)</option>
                        <option value="Rahasia">Rahasia</option>
                        <option value="Lain-lain">Lain-lain</option>
                    </select>
                </div>

                <div style="overflow-x:auto;">
                    <table class="dp-table" id="dpTable">
                        <thead>
                            <tr>
                                <th>No. Disposisi</th>
                                <th>Perihal Surat</th>
                                <th>Diteruskan Ke</th>
                                <th>Tanggal Dibuat</th>
                                <th class="center">Sifat</th>
                                <th class="center">Status</th>
                                <th class="right" style="padding-right:20px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dpTableBody">
                            @forelse($disposisiList as $d)
                            @php
                                $statusClass = match($d->status) {
                                    'pending'  => 'badge-pending',
                                    'diproses' => 'badge-diproses',
                                    'selesai'  => 'badge-selesai',
                                    default    => 'badge-pending',
                                };
                                $sifatClass = match($d->sifat) {
                                    'sangat_segera', 'Penting', 'Rahasia' => 'badge-sangat',
                                    default         => 'badge-segera',
                                };
                                $perihal = $d->perihal ?? $d->suratMasuk?->perihal ?? '—';
                            @endphp
                            <tr data-status="{{ $d->status }}" data-sifat="{{ $d->sifat }}"
                                onclick="openDetailPanel({{ json_encode([
                                    'nomor'       => $d->nomor_disposisi,
                                    'diteruskan'  => $d->diteruskan_ke,
                                    'sifat'       => $d->sifat_label,
                                    'instruksi'   => $d->instruksi ?? '-',
                                    'status'      => $d->status_label,
                                    'tanggal'     => $d->created_at->format('d M Y H:i'),
                                    'perihal'     => $perihal,
                                    'noSurat'     => $d->suratMasuk?->nomor_surat ?? '-',
                                    'asal'        => $d->asal_surat ?? $d->suratMasuk?->asal_surat ?? '-',
                                ]) }})" style="cursor:pointer;">
                                <td>
                                    <span style="font-family:monospace;font-size:12px;color:#545f73;white-space:nowrap;">{{ $d->nomor_disposisi }}</span>
                                </td>
                                <td style="color:#424754;max-width:220px;">{{ \Illuminate\Support\Str::limit($perihal, 40) }}</td>
                                <td style="font-weight:700;">{{ $d->diteruskan_ke }}</td>
                                <td style="white-space:nowrap;color:#424754;font-size:13px;">{{ ($d->tanggal_disposisi ?? $d->created_at)->format('d M Y') }}</td>
                                <td class="center"><span class="dp-badge {{ $sifatClass }}">{{ $d->sifat_label }}</span></td>
                                <td class="center"><span class="dp-badge {{ $statusClass }}">{{ $d->status_label }}</span></td>
                                <td class="right" style="padding-right:16px;" onclick="event.stopPropagation()">
                                    <div style="display:inline-flex;gap:4px;">
                                        <button class="dp-act-btn" title="Lihat Detail"
                                            onclick="openDetailPanel({{ json_encode([
                                                'nomor'       => $d->nomor_disposisi,
                                                'diteruskan'  => $d->diteruskan_ke,
                                                'sifat'       => $d->sifat_label,
                                                'instruksi'   => $d->instruksi ?? '-',
                                                'status'      => $d->status_label,
                                                'tanggal'     => $d->created_at->format('d M Y H:i'),
                                                'perihal'     => $perihal,
                                                'noSurat'     => $d->suratMasuk?->nomor_surat ?? '-',
                                                'asal'        => $d->asal_surat ?? $d->suratMasuk?->asal_surat ?? '-',
                                            ]) }})">
                                            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        </button>
                                        @if(\App\Support\RoleAccess::canFollowUpDisposisi() && $d->status === 'pending')
                                        <button class="dp-act-btn" title="Tandai Diproses" wire:click="tandaiDiproses({{ $d->id }})">
                                            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m5-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                        </button>
                                        @endif
                                        @if(\App\Support\RoleAccess::canFollowUpDisposisi() && in_array($d->status, ['pending', 'diproses'], true))
                                        <button class="dp-act-btn" title="Tandai Selesai" wire:click="tandaiSelesai({{ $d->id }})">
                                            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                        </button>
                                        @endif
                                        @if(\App\Support\RoleAccess::canManageDisposisi())
                                        <button class="dp-act-btn danger" title="Hapus" wire:click="konfirmasiHapus({{ $d->id }})">
                                            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9 7V5h6v2m-7 4v7m4-7v7m4-7v7M8 21h8a2 2 0 0 0 2-2V7H6v12a2 2 0 0 0 2 2Z"/></svg>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">
                                    <div class="dp-empty">
                                        <svg width="60" height="60" fill="none" stroke="#9ca3af" stroke-width="1.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
                                        <p>Belum ada disposisi</p>
                                        <small>Gunakan tab "Buat Disposisi Baru" untuk membuat disposisi pertama.</small>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="dp-pagination">
                    <span class="dp-page-info">Menampilkan <strong id="dpShownCount">{{ $total }}</strong> dari <strong>{{ $total }}</strong> disposisi</span>
                    <div class="dp-page-btns">
                        <button class="dp-page-btn" disabled>&#8592; Sebelumnya</button>
                        <button class="dp-page-btn active">1</button>
                        <button class="dp-page-btn" disabled>Berikutnya &#8594;</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if($showModalHapus)
    <div class="dp-delete-overlay" wire:click.self="batalHapus" role="dialog" aria-modal="true" aria-labelledby="dpDeleteTitle">
        <div class="dp-delete-modal">
            <div class="dp-delete-top">
                <div class="dp-delete-icon">
                    <svg width="28" height="28" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                </div>
                <p class="dp-delete-title" id="dpDeleteTitle">Hapus Disposisi?</p>
                <p class="dp-delete-text">Data disposisi berikut akan dihapus secara permanen dan tidak dapat dikembalikan.</p>
                <span class="dp-delete-number">{{ $hapusNomor }}</span>
            </div>
            <div class="dp-delete-actions">
                <button type="button" class="dp-delete-cancel" wire:click="batalHapus">Batal</button>
                <button type="button" class="dp-delete-confirm" wire:click="hapusDisposisi" wire:loading.attr="disabled" wire:target="hapusDisposisi">
                    <svg wire:loading.remove wire:target="hapusDisposisi" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 7h12M9 7V5h6v2m-7 4v7m4-7v7m4-7v7M8 21h8a2 2 0 002-2V7H6v12a2 2 0 002 2z"/></svg>
                    <span wire:loading.remove wire:target="hapusDisposisi">Ya, Hapus</span>
                    <span wire:loading wire:target="hapusDisposisi">Menghapus...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <script>
        /* ── Tab switching ── */
        function switchTab(tab) {
            const isBuat = tab === 'buat';
            document.getElementById('paneBuat').style.display   = isBuat ? 'block' : 'none';
            document.getElementById('paneDaftar').style.display = isBuat ? 'none'  : 'block';
            document.getElementById('tabBuat').style.color        = isBuat ? '#0058be' : '#727785';
            document.getElementById('tabBuat').style.borderBottomColor  = isBuat ? '#0058be' : 'transparent';
            document.getElementById('tabDaftar').style.color      = isBuat ? '#727785' : '#0058be';
            document.getElementById('tabDaftar').style.borderBottomColor = isBuat ? 'transparent' : '#0058be';
        }

        /* ── Filter table ── */
        function dpFilterTable() {
            const q      = document.getElementById('dpSearch').value.toLowerCase();
            const status = document.getElementById('dpStatusFilter').value;
            const sifat  = document.getElementById('dpSifatFilter').value;
            const rows   = document.querySelectorAll('#dpTableBody tr[data-status]');
            let shown = 0;
            rows.forEach(row => {
                const text  = row.innerText.toLowerCase();
                const st    = row.dataset.status;
                const sf    = row.dataset.sifat;
                const ok = (!q || text.includes(q)) && (!status || st === status) && (!sifat || sf === sifat);
                row.style.display = ok ? '' : 'none';
                if (ok) shown++;
            });
            const el = document.getElementById('dpShownCount');
            if (el) el.textContent = shown;
        }

        /* ── Detail Panel ── */
        function openDetailPanel(data) {
            const statusColor = {
                'Pending':'#854d0e', 'Diproses':'#1e40af', 'Selesai':'#166534'
            }[data.status] || '#374151';
            const statusBg = {
                'Pending':'#fef9c3', 'Diproses':'#dbeafe', 'Selesai':'#dcfce7'
            }[data.status] || '#f3f4f6';

            document.getElementById('dpPanelBody').innerHTML = `
                <!-- Surat Info -->
                <div style="background:#f9f9ff;border:1px solid #e1e2ec;border-radius:12px;padding:18px;margin-bottom:20px;">
                    <p style="font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.07em;color:#727785;margin-bottom:12px;">Informasi Surat</p>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div>
                            <p style="font-size:10px;font-weight:700;text-transform:uppercase;color:#727785;margin-bottom:3px;">No. Surat</p>
                            <p style="font-size:13px;font-weight:600;color:#191b23;font-family:monospace;">${data.noSurat}</p>
                        </div>
                        <div>
                            <p style="font-size:10px;font-weight:700;text-transform:uppercase;color:#727785;margin-bottom:3px;">Asal Surat</p>
                            <p style="font-size:13px;font-weight:600;color:#191b23;">${data.asal}</p>
                        </div>
                        <div style="grid-column:1/-1;">
                            <p style="font-size:10px;font-weight:700;text-transform:uppercase;color:#727785;margin-bottom:3px;">Perihal</p>
                            <p style="font-size:13px;font-weight:700;color:#0058be;">${data.perihal}</p>
                        </div>
                    </div>
                </div>

                <!-- Disposisi Info -->
                <div style="background:#fff;border:1px solid #e1e2ec;border-radius:12px;padding:18px;margin-bottom:20px;">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                        <p style="font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.07em;color:#727785;">Detail Disposisi</p>
                        <span style="font-size:10px;font-weight:800;text-transform:uppercase;padding:3px 10px;border-radius:4px;background:${statusBg};color:${statusColor};border:1px solid ${statusColor}40;">${data.status}</span>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div>
                            <p style="font-size:10px;font-weight:700;text-transform:uppercase;color:#727785;margin-bottom:3px;">No. Disposisi</p>
                            <p style="font-size:12px;font-weight:600;color:#545f73;font-family:monospace;">${data.nomor}</p>
                        </div>
                        <div>
                            <p style="font-size:10px;font-weight:700;text-transform:uppercase;color:#727785;margin-bottom:3px;">Diteruskan Ke</p>
                            <p style="font-size:13px;font-weight:700;color:#191b23;">${data.diteruskan}</p>
                        </div>
                        <div>
                            <p style="font-size:10px;font-weight:700;text-transform:uppercase;color:#727785;margin-bottom:3px;">Sifat</p>
                            <p style="font-size:13px;font-weight:600;color:#191b23;">${data.sifat}</p>
                        </div>
                        <div>
                            <p style="font-size:10px;font-weight:700;text-transform:uppercase;color:#727785;margin-bottom:3px;">Tanggal Dibuat</p>
                            <p style="font-size:13px;color:#424754;">${data.tanggal}</p>
                        </div>
                    </div>
                    ${data.instruksi && data.instruksi !== '-' ? `
                    <div style="margin-top:14px;padding-top:14px;border-top:1px solid #ecedf7;">
                        <p style="font-size:10px;font-weight:700;text-transform:uppercase;color:#727785;margin-bottom:5px;">Instruksi</p>
                        <p style="font-size:13px;color:#424754;line-height:1.6;">${data.instruksi}</p>
                    </div>` : ''}
                </div>

                <!-- Tracking Timeline -->
                <div style="background:#fff;border:1px solid #e1e2ec;border-radius:12px;padding:18px;margin-bottom:20px;">
                    <p style="font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.07em;color:#727785;margin-bottom:16px;">Riwayat Tracking</p>
                    <div class="dp-timeline">
                        <div class="dp-tl-item">
                            <div class="dp-tl-dot">
                                <svg width="10" height="10" fill="white" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd"/></svg>
                            </div>
                            <p style="font-size:12.5px;font-weight:700;color:#191b23;">Disposisi Dibuat</p>
                            <p style="font-size:11.5px;color:#424754;margin-top:1px;">Admin Tata Usaha</p>
                            <p style="font-size:10.5px;color:#727785;font-style:italic;margin-top:2px;">${data.tanggal}</p>
                        </div>
                        <div class="dp-tl-item">
                            <div class="dp-tl-dot ${data.status === 'pending' ? 'pending' : ''}">
                                ${data.status !== 'pending' ? '<svg width="10" height="10" fill="white" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd"/></svg>' : ''}
                            </div>
                            <p style="font-size:12.5px;font-weight:700;color:${data.status === 'pending' ? '#0058be' : '#191b23'};">
                                Diteruskan ke ${data.diteruskan}
                            </p>
                            <p style="font-size:11.5px;color:#424754;margin-top:1px;">
                                Status: ${data.status === 'pending' ? 'Menunggu tindak lanjut' : data.status}
                            </p>
                        </div>
                        ${data.status === 'selesai' ? `
                        <div class="dp-tl-item">
                            <div class="dp-tl-dot">
                                <svg width="10" height="10" fill="white" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.739a.75.75 0 011.04-.208z" clip-rule="evenodd"/></svg>
                            </div>
                            <p style="font-size:12.5px;font-weight:700;color:#166534;">Disposisi Selesai</p>
                            <p style="font-size:11.5px;color:#424754;margin-top:1px;">Proses telah diselesaikan</p>
                        </div>` : ''}
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="display:flex;gap:10px;">
                    <button onclick="window.print()" style="flex:1;padding:10px;border:1px solid #dde0ef;background:#fff;border-radius:8px;font-size:12px;font-weight:700;color:#424754;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:6px;" onmouseover="this.style.background='#f2f3fd'" onmouseout="this.style.background='#fff'">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659"/></svg>
                        Cetak
                    </button>
                    <button onclick="closeDetailPanel()" style="flex:1;padding:10px;border:none;background:#0058be;border-radius:8px;font-size:12px;font-weight:700;color:#fff;cursor:pointer;" onmouseover="this.style.background='#0049a0'" onmouseout="this.style.background='#0058be'">
                        Tutup
                    </button>
                </div>
            `;

            document.getElementById('dpOverlay').style.display = 'block';
            document.getElementById('dpDetailPanel').classList.add('open');
            document.body.style.overflow = 'hidden';
        }

        function closeDetailPanel() {
            document.getElementById('dpOverlay').style.display = 'none';
            document.getElementById('dpDetailPanel').classList.remove('open');
            document.body.style.overflow = '';
        }

        // ESC to close
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDetailPanel(); });
    </script>

</x-filament-panels::page>
