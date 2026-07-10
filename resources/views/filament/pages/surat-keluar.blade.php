{{-- SMAN 4 Surabaya – Halaman Daftar Surat Keluar --}}
<x-filament-panels::page>
    {{ $this->content }}

    <style>
        /* ── Base ── */
        .sk-hero-title { font-size:2rem; font-weight:800; line-height:1.15; letter-spacing:-0.02em; color:#191b23; }
        .sk-hero-sub   { font-size:.93rem; color:#424754; margin-top:4px; }

        html.dark .sk-hero-title { color:#ffffff !important; }
        html.dark .sk-hero-sub { color:#e5e7eb !important; }
        /* ── Buttons ── */
        .sk-btn-out {
            display:inline-flex;align-items:center;gap:6px;
            padding:8px 16px; background:#fff; border:1px solid #dde0ef;
            border-radius:8px; font-size:12px; font-weight:700; color:#191b23;
            cursor:pointer; box-shadow:0 1px 2px rgba(0,0,0,.05); transition:background .15s;
            text-decoration:none;
        }
        .sk-btn-out:hover { background:#f2f3fd; }
        .sk-btn-pri {
            display:inline-flex;align-items:center;gap:7px;
            padding:9px 18px; background:#0058be; border:none;
            border-radius:8px; font-size:12px; font-weight:700; color:#fff;
            cursor:pointer; box-shadow:0 2px 8px rgba(0,88,190,.35); transition:background .15s, transform .1s;
            text-decoration:none;
        }
        .sk-btn-pri:hover { background:#0049a0; transform:translateY(-1px); }

        /* ── Cards ── */
        .sk-stat-card {
            background:#ffffff; border:1px solid #e1e2ec; border-radius:14px;
            padding:20px 22px; position:relative; overflow:hidden;
            box-shadow:0 1px 4px rgba(0,0,0,.06); transition:box-shadow .2s, transform .2s;
        }
        .sk-stat-card:hover { box-shadow:0 6px 18px rgba(0,0,0,.1); transform:translateY(-2px); }
        .sk-stat-bg { position:absolute;top:10px;right:10px;opacity:.08;pointer-events:none; transition:opacity .3s; }
        .sk-stat-card:hover .sk-stat-bg { opacity:.14; }
        .sk-stat-lbl { font-size:10.5px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:#727785; }
        .sk-stat-val { font-size:2.3rem;font-weight:800;line-height:1.1;color:#191b23;margin-top:6px; }
        .sk-stat-trend { display:flex;align-items:center;gap:5px;margin-top:8px;font-size:11.5px;font-weight:700; }
        .tr-blue  { color:#0058be; }
        .tr-green { color:#166534; }
        .tr-red   { color:#dc2626; }

        /* ── Table Card ── */
        .sk-card {
            background:#fff; border:1px solid #e1e2ec; border-radius:14px;
            box-shadow:0 1px 4px rgba(0,0,0,.06); overflow:hidden;
        }
        .sk-card-head { padding:20px 24px 14px; display:flex; align-items:flex-end; justify-content:space-between; gap:12px; flex-wrap:wrap; border-bottom:1px solid #ecedf7; }
        .sk-section-title { font-size:1.05rem; font-weight:700; color:#191b23; }
        .sk-section-sub   { font-size:.82rem; color:#424754; margin-top:2px; }

        /* Filter/Search Bar */
        .sk-filter-bar { display:flex; gap:10px; align-items:center; flex-wrap:wrap; padding:14px 24px; background:#f9f9ff; border-bottom:1px solid #ecedf7; }
        .sk-search-wrap { position:relative; flex:1; min-width:200px; }
        .sk-search-wrap svg { position:absolute;left:11px;top:50%;transform:translateY(-50%);color:#727785;pointer-events:none; }
        .sk-search { width:100%;padding:8px 12px 8px 35px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;background:#fff;outline:none;color:#191b23;transition:border-color .2s; }
        .sk-search:focus { border-color:#0058be; box-shadow:0 0 0 3px rgba(0,88,190,.1); }
        .sk-select { padding:8px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:12px;font-weight:600;color:#424754;background:#fff;outline:none;cursor:pointer;transition:border-color .2s; }
        .sk-select:focus { border-color:#0058be; }

        /* Table */
        .sk-table { width:100%;border-collapse:collapse; }
        .sk-table th {
            padding:10px 16px;font-size:10.5px;font-weight:700;text-transform:uppercase;
            letter-spacing:.05em;color:#727785;background:#f5f5fe;
            border-bottom:1px solid #e1e2ec;white-space:nowrap;text-align:left;
        }
        .sk-table td { padding:13px 16px;font-size:13.5px;color:#191b23;border-bottom:1px solid #ecedf7;vertical-align:middle; }
        .sk-table tr:last-child td { border-bottom:none; }
        .sk-table tr:hover td { background:#f9f9ff; }
        .sk-table .center { text-align:center; }
        .sk-table .right  { text-align:right; }

        /* Badges */
        .sk-badge { display:inline-flex;align-items:center;padding:3px 10px;border-radius:4px;font-size:10px;font-weight:800;text-transform:uppercase;letter-spacing:.04em; }
        .badge-draft    { background:#fef9c3;color:#854d0e;border:1px solid #fde047; }
        .badge-tunggu   { background:#dbeafe;color:#1e40af;border:1px solid #93c5fd; }
        .badge-setuju   { background:#dcfce7;color:#166534;border:1px solid #86efac; }
        .badge-kirim    { background:#e0f2fe;color:#075985;border:1px solid #7dd3fc; }
        .badge-penting  { background:#fee2e2;color:#991b1b;border:1px solid #fca5a5; }
        .badge-biasa    { background:#eff6ff;color:#1e40af;border:1px solid #bfdbfe; }
        .badge-sangat   { background:#fef3c7;color:#92400e;border:1px solid #fcd34d; }

        /* Action buttons */
        .sk-act-btn { background:none;border:none;cursor:pointer;color:#9ca3af;padding:5px;border-radius:6px;transition:color .15s, background .15s;display:inline-flex;align-items:center;justify-content:center; }
        .sk-act-btn:hover { color:#0058be;background:#eff6ff; }
        .sk-act-btn.danger:hover { color:#dc2626;background:#fee2e2; }

        /* Pagination */
        .sk-pagination { display:flex;align-items:center;justify-content:space-between;padding:14px 24px;border-top:1px solid #ecedf7;flex-wrap:wrap;gap:10px; }
        .sk-page-info  { font-size:12px;color:#727785; }
        .sk-page-btns  { display:flex;gap:6px; }
        .sk-page-btn   { padding:5px 11px;border:1px solid #dde0ef;background:#fff;border-radius:6px;font-size:12px;font-weight:600;color:#424754;cursor:pointer;transition:background .15s; }
        .sk-page-btn:hover   { background:#f2f3fd; }
        .sk-page-btn.active  { background:#0058be;border-color:#0058be;color:#fff; }
        .sk-page-btn:disabled { opacity:.45;cursor:default; }

        /* Empty state */
        .sk-empty { padding:60px 24px;text-align:center;color:#727785; }
        .sk-empty svg { margin:0 auto 16px;opacity:.35; }
        .sk-empty p  { font-size:.95rem;font-weight:600; }
        .sk-empty small { font-size:.82rem; }

        /* Flash alert */
        .sk-flash { display:flex;align-items:center;gap:10px;padding:12px 18px;background:#dcfce7;border:1px solid #86efac;border-radius:10px;margin-bottom:20px;font-size:13px;font-weight:700;color:#166534; }

        /* Responsive */
        @media(max-width:768px){
            .sk-stat-grid { grid-template-columns:repeat(2,1fr) !important; }
            .sk-filter-bar { flex-direction:column;align-items:stretch; }
        }
        @media(max-width:480px){
            .sk-stat-grid { grid-template-columns:1fr !important; }
        }
    </style>

    <div style="margin-top:-4px;">

        {{-- ── Flash Message ── --}}
        @if(session('sukses'))
        <div class="sk-flash">
            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
            {{ session('sukses') }}
        </div>
        @endif

        {{-- ── Page Header ── --}}
        <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:24px;">
            <div>
                <h1 class="sk-hero-title">Daftar Surat Keluar</h1>
                <p class="sk-hero-sub">Kelola dan pantau semua surat keluar sekolah di satu tempat.</p>
            </div>
            <div style="display:flex;gap:10px;flex-shrink:0;">
                @if(\App\Support\RoleAccess::canManageOutgoing())
                <a href="{{ \App\Filament\Pages\TambahSuratKeluar::getUrl() }}" class="sk-btn-pri">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    Buat Surat Keluar
                </a>
                @endif
            </div>
        </div>

        {{-- ── Stat Cards ── --}}
        @php
            $suratList = \App\Models\SuratKeluar::orderBy('created_at', 'desc')->get();
            $total     = $suratList->count();
            $draft     = $suratList->where('status','draft')->count();
            $tunggu    = $suratList->where('status','menunggu_persetujuan')->count();
            $terkirim  = $suratList->whereIn('status',['disetujui','dikirim'])->count();
        @endphp

        <div class="sk-stat-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">

            <div class="sk-stat-card">
                <div class="sk-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#0058be" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                </div>
                <p class="sk-stat-lbl">Total Surat Keluar</p>
                <p class="sk-stat-val">{{ number_format($total) }}</p>
                <div class="sk-stat-trend tr-blue">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                    Semua waktu
                </div>
            </div>

            <div class="sk-stat-card">
                <div class="sk-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#d97706" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                </div>
                <p class="sk-stat-lbl">Draft</p>
                <p class="sk-stat-val" style="color:#924700;">{{ $draft }}</p>
                <div class="sk-stat-trend tr-red">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/></svg>
                    Belum diajukan
                </div>
            </div>

            <div class="sk-stat-card">
                <div class="sk-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#1e40af" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="sk-stat-lbl">Menunggu Persetujuan</p>
                <p class="sk-stat-val" style="color:#1e40af;">{{ $tunggu }}</p>
                <div class="sk-stat-trend tr-blue">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 6a.75.75 0 00-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 000-1.5h-3.75V6z" clip-rule="evenodd"/></svg>
                    Perlu ditindaklanjuti
                </div>
            </div>

            <div class="sk-stat-card">
                <div class="sk-stat-bg">
                    <svg width="90" height="90" fill="none" stroke="#166534" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="sk-stat-lbl">Disetujui / Terkirim</p>
                <p class="sk-stat-val" style="color:#166534;">{{ $terkirim }}</p>
                <div class="sk-stat-trend tr-green">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
                    Proses selesai
                </div>
            </div>

        </div>

        {{-- ── Table Card ── --}}
        <div class="sk-card">

            {{-- Header --}}
            <div class="sk-card-head">
                <div>
                    <p class="sk-section-title">Semua Surat Keluar</p>
                    <p class="sk-section-sub">Menampilkan seluruh arsip surat keluar yang tersimpan di sistem.</p>
                </div>
                <span style="font-size:11px;font-weight:700;background:#eff6ff;color:#1e40af;padding:4px 12px;border-radius:20px;border:1px solid #bfdbfe;">
                    {{ $total }} surat
                </span>
            </div>

            {{-- Filter Bar --}}
            <div class="sk-filter-bar">
                <div class="sk-search-wrap">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    <input class="sk-search" id="skSearch" placeholder="Cari nomor surat, tujuan, perihal..." type="search" onkeyup="filterTable()"/>
                </div>
                <select class="sk-select" id="skStatusFilter" onchange="filterTable()">
                    <option value="">Semua Status</option>
                    <option value="draft">Draft</option>
                    <option value="menunggu_persetujuan">Menunggu Persetujuan</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="dikirim">Dikirim</option>
                </select>
                <select class="sk-select" id="skKategoriFilter" onchange="filterTable()">
                    <option value="">Semua Kategori</option>
                    <option value="Biasa">Biasa</option>
                    <option value="Penting">Penting</option>
                    <option value="Sangat Penting">Sangat Penting</option>
                </select>
            </div>

            {{-- Table --}}
            <div style="overflow-x:auto;">
                <table class="sk-table" id="skTable">
                    <thead>
                        <tr>
                            <th>No. Surat</th>
                            <th>Tanggal</th>
                            <th>Tujuan</th>
                            <th>Perihal</th>
                            <th class="center">Kategori</th>
                            <th class="center">Status</th>
                            <th class="right" style="padding-right:20px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="skTableBody">
                        @forelse($suratList as $surat)
                        @php
                            $statusClass = match($surat->status) {
                                'draft'                => 'badge-draft',
                                'menunggu_persetujuan' => 'badge-tunggu',
                                'disetujui'            => 'badge-setuju',
                                'dikirim'              => 'badge-kirim',
                                default                => 'badge-draft',
                            };
                            $statusLabel = match($surat->status) {
                                'draft'                => 'Draft',
                                'menunggu_persetujuan' => 'Menunggu',
                                'disetujui'            => 'Disetujui',
                                'dikirim'              => 'Dikirim',
                                default                => $surat->status,
                            };
                            $katClass = match($surat->kategori) {
                                'Penting'        => 'badge-penting',
                                'Sangat Penting' => 'badge-sangat',
                                default          => 'badge-biasa',
                            };
                        @endphp
                        <tr data-status="{{ $surat->status }}" data-kategori="{{ $surat->kategori }}">
                            <td>
                                <span style="font-family:monospace;font-size:12px;color:#545f73;white-space:nowrap;">
                                    {{ $surat->nomor_surat }}
                                </span>
                            </td>
                            <td style="white-space:nowrap;color:#424754;font-size:13px;">
                                {{ $surat->tanggal_surat->format('d M Y') }}
                            </td>
                            <td style="font-weight:700;max-width:180px;">{{ Str::limit($surat->tujuan, 35) }}</td>
                            <td style="color:#424754;max-width:240px;">{{ Str::limit($surat->perihal, 45) }}</td>
                            <td class="center"><span class="sk-badge {{ $katClass }}">{{ $surat->kategori }}</span></td>
                            <td class="center"><span class="sk-badge {{ $statusClass }}">{{ $statusLabel }}</span></td>
                            <td class="right" style="padding-right:16px;">
                                <div style="display:inline-flex;gap:4px;">
                                    <button class="sk-act-btn" title="Lihat Detail" wire:click="lihatDetail({{ $surat->id }})">
                                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </button>
                                    @if(\App\Support\RoleAccess::canApproveOutgoing() && $surat->status === 'menunggu_persetujuan')
                                    <button class="sk-act-btn" title="Setujui" wire:click="setujuiSurat({{ $surat->id }})">
                                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    </button>
                                    @endif
                                    @if(\App\Support\RoleAccess::canManageOutgoing() && $surat->status === 'disetujui')
                                    <button class="sk-act-btn" title="Tandai Dikirim" wire:click="tandaiDikirim({{ $surat->id }})">
                                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.126A59.768 59.768 0 0 1 21.485 12 59.77 59.77 0 0 1 3.27 20.876L5.999 12Zm0 0h7.5"/></svg>
                                    </button>
                                    @endif
                                    @if(\App\Support\RoleAccess::canManageOutgoing())
                                    <button class="sk-act-btn" title="Edit" wire:click="editSuratKeluar({{ $surat->id }})">
                                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                                    </button>
                                    <button class="sk-act-btn danger" title="Hapus" wire:click="konfirmasiHapus({{ $surat->id }})">
                                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="sk-empty">
                                    <svg width="60" height="60" fill="none" stroke="#9ca3af" stroke-width="1.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                                    <p>Belum ada surat keluar</p>
                                    <small>Klik "Buat Surat Keluar" untuk membuat surat pertama Anda.</small>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Info --}}
            <div class="sk-pagination">
                <span class="sk-page-info">Menampilkan <strong id="skShownCount">{{ $total }}</strong> dari <strong>{{ $total }}</strong> surat</span>
                <div class="sk-page-btns">
                    <button class="sk-page-btn" disabled>&#8592; Sebelumnya</button>
                    <button class="sk-page-btn active">1</button>
                    <button class="sk-page-btn" disabled>Berikutnya &#8594;</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        function filterTable() {
            const query   = document.getElementById('skSearch').value.toLowerCase();
            const status  = document.getElementById('skStatusFilter').value;
            const kat     = document.getElementById('skKategoriFilter').value;
            const rows    = document.querySelectorAll('#skTableBody tr[data-status]');
            let shown     = 0;

            rows.forEach(row => {
                const text  = row.innerText.toLowerCase();
                const st    = row.dataset.status;
                const kt    = row.dataset.kategori;

                const matchQ  = !query  || text.includes(query);
                const matchSt = !status || st === status;
                const matchKt = !kat    || kt === kat;

                if (matchQ && matchSt && matchKt) {
                    row.style.display = '';
                    shown++;
                } else {
                    row.style.display = 'none';
                }
            });

            const el = document.getElementById('skShownCount');
            if (el) el.textContent = shown;
        }
    </script>


    @if($showModalDetail && $detailData)
    <div style="display:flex;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;align-items:center;justify-content:center;padding:20px;" wire:click.self="$set('showModalDetail', false)">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:560px;box-shadow:0 20px 60px rgba(0,0,0,.25);overflow:hidden;" wire:click.stop>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:18px 22px;border-bottom:1px solid #ecedf7;">
                <p style="font-size:1.05rem;font-weight:800;color:#191b23;">Detail Surat Keluar</p>
                <button wire:click="$set('showModalDetail', false)" style="background:none;border:none;cursor:pointer;color:#9ca3af;">x</button>
            </div>
            <div style="padding:22px;display:grid;gap:12px;">
                @foreach($detailData as $label => $value)
                <div style="display:flex;justify-content:space-between;gap:16px;border-bottom:1px solid #f1f5f9;padding-bottom:8px;">
                    <span style="font-size:12px;color:#727785;text-transform:uppercase;font-weight:700;">{{ str_replace('_', ' ', $label) }}</span>
                    <span style="font-size:13px;color:#191b23;font-weight:600;text-align:right;max-width:320px;">{{ $value }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    @if($showModalEdit)
    <div style="display:flex;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;align-items:center;justify-content:center;padding:20px;" wire:click.self="$set('showModalEdit', false)">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:620px;box-shadow:0 20px 60px rgba(0,0,0,.25);overflow:hidden;" wire:click.stop>
            <div style="padding:18px 22px;border-bottom:1px solid #ecedf7;"><p style="font-size:1.05rem;font-weight:800;color:#191b23;">Edit Surat Keluar</p></div>
            <form wire:submit.prevent="updateSuratKeluar" style="padding:22px;display:grid;gap:14px;">
                <input wire:model="nomor_surat" placeholder="Nomor surat" style="padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;">
                <input wire:model="tanggal_surat" type="date" style="padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;">
                <input wire:model="tujuan" placeholder="Tujuan" style="padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;">
                <input wire:model="perihal" placeholder="Perihal" style="padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;">
                <select wire:model="kategori" style="padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;background:#fff;">
                    <option>Biasa</option><option>Penting</option><option>Sangat Penting</option>
                </select>
                <select wire:model="status" style="padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;background:#fff;">
                    <option value="draft">Draft</option><option value="menunggu_persetujuan">Menunggu Persetujuan</option><option value="disetujui">Disetujui</option><option value="dikirim">Dikirim</option>
                </select>
                <textarea wire:model="isi_surat" rows="5" placeholder="Isi surat" style="padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;"></textarea>
                <div style="display:flex;justify-content:flex-end;gap:10px;"><button type="button" wire:click="$set('showModalEdit', false)" class="sk-btn-out">Batal</button><button type="submit" class="sk-btn-pri">Simpan</button></div>
            </form>
        </div>
    </div>
    @endif

    @if($showModalHapus)
    <div style="display:flex;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;align-items:center;justify-content:center;padding:20px;">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:420px;box-shadow:0 20px 60px rgba(0,0,0,.25);padding:28px;text-align:center;">
            <p style="font-size:1.1rem;font-weight:800;color:#191b23;margin-bottom:8px;">Hapus Surat Keluar?</p>
            <p style="font-size:13px;color:#424754;margin-bottom:22px;">Data surat keluar ini akan dihapus permanen.</p>
            <div style="display:flex;gap:10px;justify-content:center;"><button wire:click="$set('showModalHapus', false)" class="sk-btn-out">Batal</button><button wire:click="hapusSuratKeluar" style="padding:9px 20px;background:#dc2626;border:none;border-radius:8px;font-size:12px;font-weight:700;color:#fff;cursor:pointer;">Hapus</button></div>
        </div>
    </div>
    @endif
</x-filament-panels::page>

