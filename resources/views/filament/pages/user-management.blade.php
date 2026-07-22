{{-- SMAN 4 Surabaya – Halaman User Management --}}
<x-filament-panels::page>
    {{ $this->content }}

    <style>
        .um-hero-title { font-size:2rem; font-weight:800; line-height:1.15; letter-spacing:-0.02em; color:#191b23; }
        .um-hero-sub   { font-size:.93rem; color:#424754; margin-top:4px; }

        html.dark .um-hero-title { color:#ffffff !important; }
        html.dark .um-hero-sub { color:#e5e7eb !important; }
        /* Buttons */
        .um-btn-out {
            display:inline-flex;align-items:center;gap:6px;
            padding:8px 16px; background:#fff; border:1px solid #dde0ef;
            border-radius:8px; font-size:12px; font-weight:700; color:#191b23;
            cursor:pointer; box-shadow:0 1px 2px rgba(0,0,0,.05); transition:background .15s;
        }
        .um-btn-out:hover { background:#f2f3fd; }
        .um-btn-pri {
            display:inline-flex;align-items:center;gap:7px;
            padding:9px 18px; background:#0058be; border:none;
            border-radius:8px; font-size:12px; font-weight:700; color:#fff;
            cursor:pointer; box-shadow:0 2px 8px rgba(0,88,190,.35); transition:background .15s, transform .1s;
        }
        .um-btn-pri:hover { background:#0049a0; transform:translateY(-1px); }

        /* Stat Cards */
        .um-stat-card {
            background:#fff; border:1px solid #e1e2ec; border-radius:14px;
            padding:18px 20px; display:flex; align-items:center; justify-content:space-between;
            box-shadow:0 1px 4px rgba(0,0,0,.06); transition:box-shadow .2s, transform .2s;
        }
        .um-stat-card:hover { box-shadow:0 6px 18px rgba(0,0,0,.1); transform:translateY(-2px); }
        .um-stat-lbl { font-size:10px;font-weight:700;letter-spacing:.07em;text-transform:uppercase;color:#727785; }
        .um-stat-val { font-size:2rem;font-weight:800;line-height:1.1;color:#191b23;margin-top:4px; }
        .um-stat-icon { width:44px;height:44px;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0; }

        /* Table Card */
        .um-card { background:#fff; border:1px solid #e1e2ec; border-radius:14px; box-shadow:0 1px 4px rgba(0,0,0,.06); overflow:hidden; }
        .um-card-head { padding:16px 24px; display:flex; align-items:center; justify-content:space-between; border-bottom:1px solid #ecedf7; }

        /* Filter bar */
        .um-filter-bar { display:flex;gap:10px;align-items:center;flex-wrap:wrap;padding:12px 24px;background:#f9f9ff;border-bottom:1px solid #ecedf7; }
        .um-search-wrap { position:relative;flex:1;min-width:220px; }
        .um-search-wrap svg { position:absolute;left:11px;top:50%;transform:translateY(-50%);color:#727785;pointer-events:none; }
        .um-search { width:100%;padding:8px 12px 8px 35px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;background:#fff;outline:none;color:#191b23;transition:border-color .2s; }
        .um-search:focus { border-color:#0058be;box-shadow:0 0 0 3px rgba(0,88,190,.1); }
        .um-select { padding:8px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:12px;font-weight:600;color:#424754;background:#fff;outline:none;cursor:pointer; }
        .um-select:focus { border-color:#0058be; }

        /* Table */
        .um-table { width:100%;border-collapse:collapse; }
        .um-table th { padding:11px 16px;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#727785;background:#f5f5fe;border-bottom:1px solid #e1e2ec;white-space:nowrap;text-align:left; }
        .um-table td { padding:14px 16px;font-size:13.5px;color:#191b23;border-bottom:1px solid #ecedf7;vertical-align:middle; }
        .um-table tr:last-child td { border-bottom:none; }
        .um-table tr:hover td { background:#f9f9ff; }
        .um-table .right { text-align:right; }

        /* Avatar */
        .um-avatar { width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;flex-shrink:0; }

        /* Status badge */
        .um-status { display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:99px;font-size:10.5px;font-weight:700; }
        .status-active   { background:#dcfce7;color:#166534;border:1px solid #86efac; }
        .status-inactive { background:#f1f5f9;color:#475569;border:1px solid #e2e8f0; }
        .status-pending  { background:#fef9c3;color:#854d0e;border:1px solid #fde047; }

        /* Action buttons */
        .um-act-btn { background:none;border:none;cursor:pointer;color:#9ca3af;padding:5px;border-radius:6px;transition:color .15s,background .15s;display:inline-flex;align-items:center; }
        .um-act-btn.edit:hover    { color:#0058be;background:#eff6ff; }
        .um-act-btn.reset:hover   { color:#d97706;background:#fef3c7; }
        .um-act-btn.danger:hover  { color:#dc2626;background:#fee2e2; }

        /* Pagination */
        .um-pagination { display:flex;align-items:center;justify-content:space-between;padding:14px 24px;border-top:1px solid #ecedf7;flex-wrap:wrap;gap:10px; }
        .um-page-info  { font-size:12px;color:#727785; }
        .um-page-btns  { display:flex;gap:6px; }
        .um-page-btn   { padding:5px 11px;border:1px solid #dde0ef;background:#fff;border-radius:6px;font-size:12px;font-weight:600;color:#424754;cursor:pointer;transition:background .15s; }
        .um-page-btn:hover   { background:#f2f3fd; }
        .um-page-btn.active  { background:#0058be;border-color:#0058be;color:#fff; }
        .um-page-btn:disabled { opacity:.45;cursor:default; }

        /* Modal overlay */
        .um-overlay { display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9998;align-items:center;justify-content:center;padding:20px; }
        .um-modal { background:#fff;border-radius:16px;width:100%;max-width:520px;box-shadow:0 20px 60px rgba(0,0,0,.25);overflow:hidden; }
        .um-modal-head { display:flex;align-items:center;justify-content:space-between;padding:20px 24px;border-bottom:1px solid #ecedf7; }
        .um-modal-body { padding:24px;display:flex;flex-direction:column;gap:16px; }
        .um-form-label { font-size:11px;font-weight:700;color:#424754;text-transform:uppercase;letter-spacing:.05em;display:block;margin-bottom:5px; }
        .um-form-input { width:100%;padding:9px 12px;border:1px solid #dde0ef;border-radius:8px;font-size:13px;color:#191b23;outline:none;background:#fff;transition:border-color .2s;font-family:inherit; }
        .um-form-input:focus { border-color:#0058be;box-shadow:0 0 0 3px rgba(0,88,190,.1); }

        /* Info cards bottom */
        .um-info-card { border-radius:12px;padding:20px 22px;display:flex;gap:14px;align-items:flex-start; }

        /* Empty */
        .um-empty { padding:60px 24px;text-align:center;color:#727785; }
        .um-empty p { font-size:.95rem;font-weight:600; }
        .um-empty small { font-size:.82rem; }

        @media(max-width:640px){
            .um-stat-grid { grid-template-columns:repeat(2,1fr) !important; }
        }
    </style>

    {{-- Modal Tambah/Edit User (Livewire) --}}
    @if($showModalUser)
    <div style="display:flex;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9998;align-items:center;justify-content:center;padding:20px;" wire:click.self="$set('showModalUser', false)">
        <div class="um-modal" wire:click.stop>
            <div class="um-modal-head">
                <div>
                    <p style="font-size:1.05rem;font-weight:800;color:#191b23;">{{ $isEdit ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}</p>
                    <p style="font-size:.82rem;color:#424754;margin-top:2px;">SMAN 4 Surabaya – Sistem Tata Usaha</p>
                </div>
                <button wire:click="$set('showModalUser', false)" style="background:none;border:none;cursor:pointer;color:#9ca3af;padding:4px;border-radius:6px;">
                    <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form wire:submit.prevent="simpanUser" class="um-modal-body">
                @if($errors->any())
                <div style="background:#fee2e2;border:1px solid #fca5a5;border-radius:8px;padding:10px 14px;font-size:12px;color:#991b1b;">
                    <ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div style="grid-column:1/-1;">
                        <label class="um-form-label">Nama Lengkap <span style="color:#dc2626">*</span></label>
                        <input class="um-form-input" wire:model="name" placeholder="cth. Budi Santoso, S.Pd." type="text"/>
                    </div>
                    <div style="grid-column:1/-1;">
                        <label class="um-form-label">Email <span style="color:#dc2626">*</span></label>
                        <input class="um-form-input" wire:model="email" placeholder="nama@sman4sby.sch.id" type="email"/>
                    </div>
                    <div>
                        <label class="um-form-label">NIP</label>
                        <input class="um-form-input" wire:model="nip" placeholder="19XXXXXXXXXXXXXX" type="text"/>
                    </div>
                    <div>
                        <label class="um-form-label">Jabatan</label>
                        <input class="um-form-input" wire:model="jabatan" placeholder="cth. Wali Kelas XII IPA 1" type="text"/>
                    </div>
                    <div>
                        <label class="um-form-label">Role <span style="color:#dc2626">*</span></label>
                        <select class="um-form-input" wire:model="role" style="cursor:pointer;">
                            <option value="">— Pilih role —</option>
                            <option value="Admin">Admin</option>
                            <option value="Kepala Sekolah">Kepala Sekolah</option>
                            <option value="Wakasek">Wakasek</option>
                            <option value="Staf Tata Usaha">Staf Tata Usaha</option>
                            <option value="Guru">Guru</option>
                            <option value="Bendahara">Bendahara</option>
                        </select>
                    </div>
                    <div>
                        <label class="um-form-label">Status</label>
                        <select class="um-form-input" wire:model="status" style="cursor:pointer;">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending</option>
                        </select>
                    </div>
                    @if(!$isEdit)
                    <div style="grid-column:1/-1;">
                        <label class="um-form-label">Password <span style="color:#dc2626">*</span></label>
                        <input class="um-form-input" wire:model="password" placeholder="Minimal 8 karakter" type="password"/>
                    </div>
                    @endif
                </div>
                <div style="display:flex;gap:10px;justify-content:flex-end;padding-top:4px;">
                    <button type="button" wire:click="$set('showModalUser', false)" class="um-btn-out">Batal</button>
                    <button type="submit" class="um-btn-pri">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        <span wire:loading.remove wire:target="simpanUser">{{ $isEdit ? 'Perbarui Pengguna' : 'Simpan Pengguna' }}</span>
                        <span wire:loading wire:target="simpanUser">Menyimpan...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <div style="margin-top:-4px;">

        {{-- Page Header --}}
        <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:24px;">
            <div>
                <h1 class="um-hero-title">User Management</h1>
                <p class="um-hero-sub">Kelola akun dan hak akses seluruh personel SMAN 4 Surabaya.</p>
            </div>
            <button class="um-btn-pri" wire:click="openModalTambah">
                <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                Tambah User
            </button>
        </div>

        {{-- Stat Cards --}}
        @php
            $users    = \App\Models\User::orderBy('created_at','desc')->get();
            $total    = $users->count();
            $active   = $users->where('status','active')->count();
            $inactive = $users->where('status','inactive')->count();
            $pending  = $users->where('status','pending')->count();
        @endphp

        <div class="um-stat-grid" style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">

            <div class="um-stat-card">
                <div>
                    <p class="um-stat-lbl">Total Pengguna</p>
                    <p class="um-stat-val">{{ $total }}</p>
                </div>
                <div class="um-stat-icon" style="background:#dbeafe;">
                    <svg width="22" height="22" fill="none" stroke="#1e40af" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                </div>
            </div>

            <div class="um-stat-card">
                <div>
                    <p class="um-stat-lbl">Aktif</p>
                    <p class="um-stat-val" style="color:#166534;">{{ $active }}</p>
                </div>
                <div class="um-stat-icon" style="background:#dcfce7;">
                    <svg width="22" height="22" fill="none" stroke="#166534" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>

            <div class="um-stat-card">
                <div>
                    <p class="um-stat-lbl">Tidak Aktif</p>
                    <p class="um-stat-val" style="color:#dc2626;">{{ $inactive }}</p>
                </div>
                <div class="um-stat-icon" style="background:#fee2e2;">
                    <svg width="22" height="22" fill="none" stroke="#dc2626" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>

            <div class="um-stat-card">
                <div>
                    <p class="um-stat-lbl">Pending</p>
                    <p class="um-stat-val" style="color:#d97706;">{{ $pending }}</p>
                </div>
                <div class="um-stat-icon" style="background:#fef9c3;">
                    <svg width="22" height="22" fill="none" stroke="#d97706" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>

        </div>

        {{-- Table Card --}}
        <div class="um-card">

            <div class="um-card-head">
                <div>
                    <p style="font-size:1.05rem;font-weight:800;color:#191b23;">Daftar Pengguna</p>
                    <p style="font-size:.82rem;color:#424754;margin-top:2px;">Seluruh akun yang terdaftar di sistem SMAN 4 Surabaya.</p>
                </div>
                <div style="display:flex;gap:8px;">
                    <button class="um-btn-out" style="padding:7px 12px;" title="Filter">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z"/></svg>
                    </button>
                    <button class="um-btn-out" style="padding:7px 12px;" title="Export" onclick="window.print()">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                    </button>
                </div>
            </div>

            <div class="um-filter-bar">
                <div class="um-search-wrap">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/></svg>
                    <input class="um-search" id="umSearch" placeholder="Cari nama, email, NIP, jabatan..." type="search" onkeyup="umFilter()"/>
                </div>
                <select class="um-select" id="umRoleFilter" onchange="umFilter()">
                    <option value="">Semua Role</option>
                    <option value="Admin">Admin</option>
                    <option value="Kepala Sekolah">Kepala Sekolah</option>
                    <option value="Wakasek">Wakasek</option>
                    <option value="Staf Tata Usaha">Staf Tata Usaha</option>
                    <option value="Guru">Guru</option>
                    <option value="Bendahara">Bendahara</option>
                </select>
                <select class="um-select" id="umStatusFilter" onchange="umFilter()">
                    <option value="">Semua Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <div style="overflow-x:auto;">
                <table class="um-table" id="umTable">
                    <thead>
                        <tr>
                            <th>Pengguna</th>
                            <th>Email</th>
                            <th>NIP / Jabatan</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Login Terakhir</th>
                            <th class="right" style="padding-right:20px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="umTableBody">
                        @forelse($users as $user)
                        @php
                            $statusClass = match($user->status ?? 'active') {
                                'active'   => 'status-active',
                                'inactive' => 'status-inactive',
                                'pending'  => 'status-pending',
                                default    => 'status-active',
                            };
                            $statusLabel = match($user->status ?? 'active') {
                                'active'   => 'Aktif',
                                'inactive' => 'Tidak Aktif',
                                'pending'  => 'Pending',
                                default    => ucfirst($user->status ?? 'active'),
                            };
                            $statusDot = match($user->status ?? 'active') {
                                'active'   => '#166534',
                                'inactive' => '#94a3b8',
                                'pending'  => '#d97706',
                                default    => '#166534',
                            };
                        @endphp
                        <tr data-role="{{ $user->role ?? 'Staf TU' }}" data-status="{{ $user->status ?? 'active' }}"
                            style="{{ ($user->status ?? 'active') === 'inactive' ? 'opacity:.7' : '' }}">
                            <td>
                                <div style="display:flex;align-items:center;gap:10px;">
                                    <div class="um-avatar" style="{{ $user->avatar_color }};">
                                        {{ $user->initials }}
                                    </div>
                                    <div>
                                        <p style="font-weight:700;font-size:13.5px;color:#191b23;">{{ $user->name }}</p>
                                        <p style="font-size:10.5px;color:#727785;">UID: {{ str_pad($user->id, 7, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td style="color:#424754;font-size:13px;">{{ $user->email }}</td>
                            <td>
                                <p style="font-size:12.5px;font-weight:600;color:#191b23;">{{ $user->nip ?? '—' }}</p>
                                <p style="font-size:11px;color:#727785;">{{ $user->jabatan ?? '—' }}</p>
                            </td>
                            <td>
                                <span style="font-size:10.5px;font-weight:800;text-transform:uppercase;padding:3px 10px;border-radius:4px;{{ $user->role_badge ?? 'background:#f1f5f9;color:#475569;border:1px solid #e2e8f0' }}">
                                    {{ $user->role ?? 'Staf TU' }}
                                </span>
                            </td>
                            <td>
                                <span class="um-status {{ $statusClass }}">
                                    <span style="width:6px;height:6px;border-radius:50%;background:{{ $statusDot }};display:inline-block;"></span>
                                    {{ $statusLabel }}
                                </span>
                            </td>
                            <td style="font-size:12px;color:#727785;white-space:nowrap;">
                                {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Belum pernah' }}
                            </td>
                            <td class="right" style="padding-right:16px;">
                                <div style="display:inline-flex;gap:2px;">
                                    <button class="um-act-btn edit" title="Edit Pengguna"
                                        wire:click="editUser({{ $user->id }})">
                                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125"/></svg>
                                    </button>
                                    <button class="um-act-btn reset" title="Reset Password" wire:click="konfirmasiReset({{ $user->id }})">
                                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
                                    </button>
                                    <button class="um-act-btn danger" title="Hapus" wire:click="konfirmasiHapus({{ $user->id }})">
                                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7">
                            <div class="um-empty">
                                <svg width="60" height="60" fill="none" stroke="#9ca3af" stroke-width="1.2" viewBox="0 0 24 24" style="margin:0 auto 16px;opacity:.35;"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                                <p>Belum ada pengguna terdaftar</p>
                                <small>Klik "Tambah User" untuk menambahkan pengguna pertama.</small>
                            </div>
                        </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="um-pagination">
                <span class="um-page-info">Menampilkan <strong id="umShownCount">{{ $total }}</strong> dari <strong>{{ $total }}</strong> pengguna</span>
                <div class="um-page-btns">
                    <button class="um-page-btn" disabled>&#8592; Sebelumnya</button>
                    <button class="um-page-btn active">1</button>
                    <button class="um-page-btn" disabled>Berikutnya &#8594;</button>
                </div>
            </div>
        </div>

        {{-- Bottom Info Cards --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:20px;">

            <div class="um-info-card" style="background:#eff6ff;border:1px solid #bfdbfe;">
                <svg width="28" height="28" fill="none" stroke="#1e40af" stroke-width="1.6" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:2px;"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                <div>
                    <p style="font-size:14px;font-weight:800;color:#1e40af;margin-bottom:6px;">Tips Manajemen Role</p>
                    <p style="font-size:12.5px;color:#1e3a8a;line-height:1.65;">Role <strong>Staf Tata Usaha</strong> memiliki akses penuh untuk administrasi persuratan. Role <strong>Kepala Sekolah</strong> berfokus pada disposisi dan monitoring. Role <strong>Wakasek</strong> dan <strong>Guru</strong> hanya melihat dashboard serta menindaklanjuti disposisi yang ditugaskan. Tinjau ulang hak akses setiap semester.</p>
                </div>
            </div>

            <div class="um-info-card" style="background:#f8fafc;border:1px solid #e2e8f0;">
                <svg width="28" height="28" fill="none" stroke="#374151" stroke-width="1.6" viewBox="0 0 24 24" style="flex-shrink:0;margin-top:2px;"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                <div>
                    <p style="font-size:14px;font-weight:800;color:#191b23;margin-bottom:6px;">Keamanan & Audit Log</p>
                    <p style="font-size:12.5px;color:#424754;line-height:1.65;">Setiap reset password dan perubahan role dicatat di audit trail sistem. Akun yang tidak aktif selama <strong>90 hari</strong> akan diarsipkan secara otomatis.</p>
                </div>
            </div>

        </div>

    </div>

    {{-- Modal Konfirmasi Hapus User --}}
    @if($showModalHapus)
    <div style="display:flex;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center;padding:20px;">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:420px;box-shadow:0 20px 60px rgba(0,0,0,.25);padding:28px;text-align:center;">
            <div style="width:56px;height:56px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <svg width="28" height="28" fill="none" stroke="#dc2626" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
            </div>
            <p style="font-size:1.1rem;font-weight:800;color:#191b23;margin-bottom:8px;">Hapus Pengguna?</p>
            <p style="font-size:13px;color:#424754;margin-bottom:24px;">Akun pengguna ini akan dihapus secara permanen dari sistem.</p>
            <div style="display:flex;gap:10px;justify-content:center;">
                <button wire:click="$set('showModalHapus', false)" class="um-btn-out">Batal</button>
                <button wire:click="hapusUser" style="display:inline-flex;align-items:center;gap:6px;padding:9px 20px;background:#dc2626;border:none;border-radius:8px;font-size:12px;font-weight:700;color:#fff;cursor:pointer;">
                    <span wire:loading.remove wire:target="hapusUser">Ya, Hapus</span>
                    <span wire:loading wire:target="hapusUser">Menghapus...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal Konfirmasi Reset Password --}}
    @if($showModalReset)
    <div style="display:flex;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;align-items:center;justify-content:center;padding:20px;">
        <div style="background:#fff;border-radius:16px;width:100%;max-width:420px;box-shadow:0 20px 60px rgba(0,0,0,.25);padding:28px;text-align:center;">
            <div style="width:56px;height:56px;background:#fef9c3;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
                <svg width="28" height="28" fill="none" stroke="#d97706" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
            </div>
            <p style="font-size:1.1rem;font-weight:800;color:#191b23;margin-bottom:8px;">Reset Password?</p>
            <p style="font-size:13px;color:#424754;margin-bottom:4px;">Password akan direset ke default:</p>
            <p style="font-size:15px;font-weight:800;color:#0058be;font-family:monospace;margin-bottom:20px;">sman4sby2024</p>
            <div style="display:flex;gap:10px;justify-content:center;">
                <button wire:click="$set('showModalReset', false)" class="um-btn-out">Batal</button>
                <button wire:click="resetPassword" style="display:inline-flex;align-items:center;gap:6px;padding:9px 20px;background:#d97706;border:none;border-radius:8px;font-size:12px;font-weight:700;color:#fff;cursor:pointer;">
                    <span wire:loading.remove wire:target="resetPassword">Ya, Reset</span>
                    <span wire:loading wire:target="resetPassword">Memproses...</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <script>
        function umFilter() {
            const q      = document.getElementById('umSearch').value.toLowerCase();
            const role   = document.getElementById('umRoleFilter').value;
            const status = document.getElementById('umStatusFilter').value;
            const rows   = document.querySelectorAll('#umTableBody tr[data-role]');
            let shown = 0;
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const r    = row.dataset.role;
                const s    = row.dataset.status;
                const ok   = (!q || text.includes(q)) && (!role || r === role) && (!status || s === status);
                row.style.display = ok ? '' : 'none';
                if (ok) shown++;
            });
            const el = document.getElementById('umShownCount');
            if (el) el.textContent = shown;
        }
    </script>

</x-filament-panels::page>
