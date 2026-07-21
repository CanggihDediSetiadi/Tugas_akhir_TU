{{-- SMAN 4 Surabaya – Buat Surat Keluar --}}
<x-filament-panels::page>
    {{ $this->content }}

    <style>
        /* ── Layout & Base ── */
        .tsk-wrap { display:grid; grid-template-columns:1fr; gap:28px; align-items:start; margin-top:-4px; }

        /* ── Hero Header ── */
        .tsk-hero-title { font-size:2rem;font-weight:800;line-height:1.15;letter-spacing:-0.02em;color:#191b23; }
        .tsk-hero-sub   { font-size:.93rem;color:#424754;margin-top:4px; }

        /* ── Breadcrumb ── */
        .tsk-bc { display:flex;align-items:center;gap:6px;margin-bottom:20px;font-size:12px;font-weight:600;color:#727785; }
        .tsk-bc a { color:#727785;text-decoration:none;transition:color .15s; }
        .tsk-bc a:hover { color:#0058be; }
        .tsk-bc svg { opacity:.55; }

        /* ── Section Cards ── */
        .tsk-card {
            background:#ffffff;border:1px solid #e1e2ec;border-radius:14px;
            padding:24px;margin-bottom:20px;box-shadow:0 1px 5px rgba(0,0,0,.06);
        }
        .tsk-card-head {
            display:flex;align-items:center;gap:10px;padding-bottom:16px;
            margin-bottom:20px;border-bottom:1px solid #ecedf7;
        }
        .tsk-card-head-icon { color:#0058be;display:flex; }
        .tsk-card-head h3 { font-size:1.05rem;font-weight:700;color:#191b23; }

        /* ── Form Fields ── */
        .tsk-field { display:flex;flex-direction:column;gap:6px; }
        .tsk-label { font-size:11px;font-weight:700;letter-spacing:.05em;text-transform:uppercase;color:#727785; }
        .tsk-input, .tsk-select {
            padding:10px 14px;border:1px solid #dde0ef;border-radius:8px;
            font-size:13.5px;color:#191b23;background:#fff;
            outline:none;transition:border-color .2s,box-shadow .2s;
            font-family:'Inter',sans-serif;
        }
        .tsk-input:focus, .tsk-select:focus {
            border-color:#0058be;box-shadow:0 0 0 3px rgba(0,88,190,.12);
        }
        .tsk-input:disabled {
            background:#f5f5fe;color:#727785;cursor:not-allowed;border-color:#e1e2ec;
        }
        .tsk-input.mono { font-family:monospace;font-size:13px; }
        .tsk-grid-2 { display:grid;grid-template-columns:1fr 1fr;gap:16px; }
        @media(max-width:600px){ .tsk-grid-2 { grid-template-columns:1fr; } }
        .tsk-col-2 { grid-column:span 2; }
        @media(max-width:600px){ .tsk-col-2 { grid-column:span 1; } }

        /* ── Error messages ── */
        .tsk-err { font-size:11.5px;color:#dc2626;margin-top:4px;font-weight:600; }

        /* ── Rich Text Editor ── */
        .tsk-toolbar {
            display:flex;flex-wrap:wrap;gap:2px;padding:8px 10px;
            background:#f5f5fe;border:1px solid #dde0ef;border-bottom:none;
            border-radius:8px 8px 0 0;
        }
        .tsk-toolbar-btn {
            padding:5px 7px;background:none;border:none;border-radius:5px;cursor:pointer;
            color:#424754;transition:background .15s,color .15s;display:inline-flex;
            align-items:center;justify-content:center;
        }
        .tsk-toolbar-btn:hover { background:#e6e7f2;color:#0058be; }
        .tsk-toolbar-sep { width:1px;background:#dde0ef;margin:4px 4px;align-self:stretch; }
        .tsk-editor-wrap { position:relative; }
        .tsk-editor {
            min-height:280px;padding:16px;border:1px solid #dde0ef;
            border-radius:0 0 8px 8px;font-size:14px;line-height:1.75;
            color:#191b23;background:#fff;outline:none;overflow-y:auto;
            transition:border-color .2s,box-shadow .2s;
        }
        .tsk-editor:focus {
            border-color:#0058be;box-shadow:0 0 0 3px rgba(0,88,190,.12);
        }
        .tsk-editor p { margin:0 0 8px; }
        .tsk-editor p:last-child { margin-bottom:0; }
        .tsk-editor-footer {
            display:flex;justify-content:flex-end;
            font-size:11px;color:#9ca3af;margin-top:5px;
        }

        /* ── Dropzone ── */
        .tsk-dropzone {
            border:2px dashed #dde0ef;border-radius:12px;padding:40px 20px;
            display:flex;flex-direction:column;align-items:center;justify-content:center;
            background:#f9f9ff;cursor:pointer;transition:border-color .2s,background .2s;
            text-align:center;
        }
        .tsk-dropzone:hover,.tsk-dropzone.drag-over { border-color:#0058be;background:#eff6ff; }
        .tsk-drop-icon {
            width:52px;height:52px;background:#dbeafe;border-radius:50%;
            display:flex;align-items:center;justify-content:center;
            margin-bottom:14px;transition:transform .2s;
        }
        .tsk-dropzone:hover .tsk-drop-icon { transform:scale(1.1); }
        .tsk-drop-title { font-size:13.5px;font-weight:700;color:#191b23; }
        .tsk-drop-hint  { font-size:11.5px;color:#727785;margin-top:4px; }
        .tsk-file-list  { margin-top:14px;display:flex;flex-direction:column;gap:8px; }
        .tsk-file-item  {
            display:flex;align-items:center;justify-content:space-between;
            padding:10px 14px;background:#f5f5fe;border:1px solid #dde0ef;border-radius:8px;
        }
        .tsk-file-info  { display:flex;align-items:center;gap:10px; }
        .tsk-file-icon  { color:#0058be;display:flex; }
        .tsk-file-name  { font-size:12.5px;font-weight:700;color:#191b23; }
        .tsk-file-size  { font-size:11px;color:#727785;margin-top:1px; }
        .tsk-file-del   {
            background:none;border:none;cursor:pointer;color:#9ca3af;
            padding:4px;border-radius:5px;transition:color .15s,background .15s;
            display:inline-flex;
        }
        .tsk-file-del:hover { color:#dc2626;background:#fee2e2; }

        /* ── Form Actions ── */
        .tsk-actions {
            display:flex;align-items:center;justify-content:flex-end;gap:12px;
            padding-top:20px;border-top:1px solid #ecedf7;margin-top:4px;
        }
        .tsk-btn-draft {
            padding:10px 22px;border:1px solid #dde0ef;background:#fff;border-radius:8px;
            font-size:12.5px;font-weight:700;color:#424754;cursor:pointer;
            transition:background .15s;box-shadow:0 1px 2px rgba(0,0,0,.05);
        }
        .tsk-btn-draft:hover { background:#f2f3fd; }
        .tsk-btn-submit {
            padding:10px 26px;background:#0058be;border:none;border-radius:8px;
            font-size:12.5px;font-weight:700;color:#fff;cursor:pointer;
            box-shadow:0 3px 10px rgba(0,88,190,.35);transition:background .15s,transform .1s;
            display:inline-flex;align-items:center;gap:7px;
        }
        .tsk-btn-submit:hover { background:#0049a0;transform:translateY(-1px); }

        /* ── Sidebar Cards ── */
        .tsk-guide-card {
            background:linear-gradient(135deg,#0058be 0%,#2170e4 100%);
            color:#fff;padding:22px;border-radius:14px;margin-bottom:16px;
            box-shadow:0 4px 16px rgba(0,88,190,.3);
        }
        .tsk-guide-head { display:flex;align-items:center;gap:10px;margin-bottom:16px; }
        .tsk-guide-head h4 { font-size:1rem;font-weight:800; }
        .tsk-guide-item { display:flex;gap:9px;margin-bottom:12px;font-size:13px;line-height:1.5;opacity:.93; }
        .tsk-guide-item:last-child { margin-bottom:0; }
        .tsk-guide-dot  { width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,.7);flex-shrink:0;margin-top:6px; }

        .tsk-side-card { background:#fff;border:1px solid #e1e2ec;border-radius:14px;overflow:hidden;margin-bottom:16px;box-shadow:0 1px 4px rgba(0,0,0,.06); }
        .tsk-side-head { padding:14px 18px;background:#f5f5fe;border-bottom:1px solid #ecedf7;font-size:10.5px;font-weight:800;letter-spacing:.07em;text-transform:uppercase;color:#727785; }
        .tsk-side-body { padding:18px; }

        /* ── Stepper ── */
        .tsk-stepper { display:flex;flex-direction:column;gap:0; }
        .tsk-step { display:flex;gap:14px;position:relative;padding-bottom:24px; }
        .tsk-step:last-child { padding-bottom:0; }
        .tsk-step-line {
            position:absolute;left:11px;top:28px;bottom:0;width:2px;
            background:#ecedf7;
        }
        .tsk-step.active .tsk-step-line { background:#0058be; }
        .tsk-step-dot {
            width:24px;height:24px;border-radius:50%;flex-shrink:0;
            display:flex;align-items:center;justify-content:center;
            border:2px solid #dde0ef;background:#fff;color:#9ca3af;z-index:1;
            font-size:13px;transition:all .2s;
        }
        .tsk-step.active .tsk-step-dot  { background:#0058be;border-color:#0058be;color:#fff;box-shadow:0 0 0 4px rgba(0,88,190,.15); }
        .tsk-step.done .tsk-step-dot    { background:#16a34a;border-color:#16a34a;color:#fff; }
        .tsk-step-label { font-size:13px;font-weight:700;color:#191b23;margin-top:2px; }
        .tsk-step.pending .tsk-step-label { color:#9ca3af; }
        .tsk-step-sub   { font-size:11px;color:#727785;margin-top:2px; }
        .tsk-step.active .tsk-step-sub  { color:#0058be;font-weight:600; }

        /* ── Templates ── */
        .tsk-tpl-btn {
            width:100%;display:flex;align-items:center;justify-content:space-between;
            padding:10px 14px;background:#f9f9ff;border:1px solid #dde0ef;border-radius:8px;
            font-size:13px;font-weight:600;color:#191b23;cursor:pointer;text-align:left;
            transition:background .15s,border-color .15s;margin-bottom:8px;
        }
        .tsk-tpl-btn:last-child { margin-bottom:0; }
        .tsk-tpl-btn:hover { background:#eff6ff;border-color:#0058be; }
        .tsk-tpl-btn svg { color:#9ca3af;transition:color .15s;flex-shrink:0; }
        .tsk-tpl-btn:hover svg { color:#0058be; }

        /* ── Validation Alert ── */
        .tsk-alert {
            display:none;align-items:center;gap:10px;padding:12px 16px;
            background:#fee2e2;border:1px solid #fca5a5;border-radius:8px;
            margin-bottom:16px;font-size:13px;font-weight:700;color:#991b1b;
        }
        .tsk-alert.show { display:flex; }
    </style>

    {{-- Breadcrumb --}}
    <nav class="tsk-bc">
        <a href="{{ \App\Filament\Pages\Dashboard::getUrl() }}">Dashboard</a>
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        <a href="{{ \App\Filament\Pages\SuratKeluar::getUrl() }}">Surat Keluar</a>
        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
        <span style="color:#191b23;font-weight:800;">Tambah</span>
    </nav>

    {{-- Page Header --}}
    <div style="margin-bottom:28px;">
        <h1 class="tsk-hero-title">Buat Surat Keluar</h1>
        <p class="tsk-hero-sub">Lengkapi formulir di bawah untuk membuat draf atau mengajukan persetujuan surat keluar baru.</p>
    </div>

    {{-- Validation Alert --}}
    <div class="tsk-alert" id="tskAlert">
        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/></svg>
        <span id="tskAlertMsg">Mohon lengkapi semua field yang wajib diisi.</span>
    </div>

    {{-- 2-column layout --}}
    <div class="tsk-wrap">

        {{-- ───────────── LEFT: Main Form ───────────── --}}
        <div class="tsk-main">

            {{-- Section 1: Informasi Dasar --}}
            <div class="tsk-card">
                <div class="tsk-card-head">
                    <div class="tsk-card-head-icon">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 01.67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 11-.671-1.34l.041-.022zM12 9a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/></svg>
                    </div>
                    <h3>Informasi Dasar</h3>
                </div>
                <div class="tsk-grid-2">
                    <div class="tsk-field">
                        <label class="tsk-label">No. Urut <span style="color:#dc2626;">*</span></label>
                        <input class="tsk-input mono" type="text" wire:model="nomor_surat" id="tskNoUrut"
                               placeholder="Contoh: 001/SK/TU/VII/2026"/>
                        @error('nomor_surat')<span class="tsk-err">{{ $message }}</span>@enderror
                    </div>
                    <div class="tsk-field">
                        <label class="tsk-label">No. Berkas</label>
                        <input class="tsk-input" type="text" wire:model="no_berkas" id="tskNoBerkas"
                               placeholder="Contoh: BRK/2026/001"/>
                        @error('no_berkas')<span class="tsk-err">{{ $message }}</span>@enderror
                    </div>
                    <div class="tsk-field">
                        <label class="tsk-label">Tanggal Surat <span style="color:#dc2626;">*</span></label>
                        <input class="tsk-input" type="date" wire:model="tanggal_surat" id="tskTanggal"/>
                        @error('tanggal_surat')<span class="tsk-err">{{ $message }}</span>@enderror
                    </div>
                    <div class="tsk-field">
                        <label class="tsk-label">Perihal <span style="color:#dc2626;">*</span></label>
                        <input class="tsk-input" type="text" wire:model="perihal" id="tskPerihal"
                               placeholder="Masukkan perihal surat secara singkat dan jelas"/>
                        @error('perihal')<span class="tsk-err">{{ $message }}</span>@enderror
                    </div>
                    <div class="tsk-field tsk-col-2">
                        <label class="tsk-label">Alamat Tujuan <span style="color:#dc2626;">*</span></label>
                        <input class="tsk-input" type="text" wire:model="alamat_tujuan" id="tskAlamatTujuan"
                               placeholder="Contoh: Kepala Dinas Pendidikan Provinsi Jawa Timur, Jl. ..."/>
                        @error('alamat_tujuan')<span class="tsk-err">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Section 2: Isi Surat --}}
            <div class="tsk-card">
                <div class="tsk-card-head">
                    <div class="tsk-card-head-icon">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/></svg>
                    </div>
                    <h3>Keterangan</h3>
                </div>

                @error('keterangan')<div class="tsk-alert show" style="margin-bottom:12px;">
                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/></svg>
                    <span>{{ $message }}</span>
                    </div>@enderror

                {{-- Toolbar --}}
                <div class="tsk-toolbar">
                    <button class="tsk-toolbar-btn" type="button" onclick="execCmd('bold')" title="Bold">
                        <svg width="17" height="17" fill="currentColor" viewBox="0 0 24 24"><path d="M6 4h8a4 4 0 010 8H6z"/><path d="M6 12h9a4 4 0 010 8H6z"/></svg>
                    </button>
                    <button class="tsk-toolbar-btn" type="button" onclick="execCmd('italic')" title="Italic">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M10 4h4M10 20h4M14 4l-4 16"/></svg>
                    </button>
                    <button class="tsk-toolbar-btn" type="button" onclick="execCmd('underline')" title="Underline">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M7 4v7a5 5 0 0010 0V4M5 20h14"/></svg>
                    </button>
                    <div class="tsk-toolbar-sep"></div>
                    <button class="tsk-toolbar-btn" type="button" onclick="execCmd('insertUnorderedList')" title="Bullet List">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
                    </button>
                    <button class="tsk-toolbar-btn" type="button" onclick="execCmd('insertOrderedList')" title="Numbered List">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M10 6h11M10 12h11M10 18h11M4 6h1v4M4 10H5M3 14.5h2l-2 3h2"/></svg>
                    </button>
                    <div class="tsk-toolbar-sep"></div>
                    <button class="tsk-toolbar-btn" type="button" onclick="execCmd('justifyLeft')" title="Align Left">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M3 6h18M3 10h12M3 14h18M3 18h12"/></svg>
                    </button>
                    <button class="tsk-toolbar-btn" type="button" onclick="execCmd('justifyCenter')" title="Center">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M3 6h18M6 10h12M3 14h18M6 18h12"/></svg>
                    </button>
                    <button class="tsk-toolbar-btn" type="button" onclick="execCmd('justifyRight')" title="Align Right">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M3 6h18M9 10h12M3 14h18M9 18h12"/></svg>
                    </button>
                    <div class="tsk-toolbar-sep"></div>
                    <button class="tsk-toolbar-btn" type="button" onclick="execCmd('justifyFull')" title="Justify">
                        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" d="M3 6h18M3 10h18M3 14h18M3 18h18"/></svg>
                    </button>
                </div>

                {{-- Editor --}}
                <div class="tsk-editor-wrap">
                    <div class="tsk-editor" id="tskEditor" contenteditable="true"
                         oninput="syncEditor()"
                         onblur="syncEditor()">
                    </div>
                    {{-- Hidden textarea for Livewire --}}
                    <textarea wire:model="keterangan" id="tskIsiSurat" style="display:none;"></textarea>
                </div>
                <div class="tsk-editor-footer">
                    <span id="tskWordCount">0 kata</span>
                </div>
            </div>

            {{-- Section 3: Lampiran --}}
            <div class="tsk-card">
                <div class="tsk-card-head">
                    <div class="tsk-card-head-icon">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"/></svg>
                    </div>
                    <h3>Lampiran &amp; Dokumen</h3>
                </div>

                {{-- Drop Zone --}}
                <div class="tsk-dropzone" id="tskDropzone" onclick="document.getElementById('tskFileInput').click()">
                    <div class="tsk-drop-icon">
                        <svg width="26" height="26" fill="none" stroke="#0058be" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                    </div>
                    <p class="tsk-drop-title">Klik atau seret file ke sini</p>
                    <p class="tsk-drop-hint">PDF, JPG, PNG, atau DOCX · Maks. 10 MB per file</p>
                    <input type="file" id="tskFileInput" wire:model="lampiranFiles" multiple accept=".pdf,.jpg,.jpeg,.png,.docx" style="display:none;" onchange="handleFiles(this.files)"/>
                </div>

                {{-- File List --}}
                <div class="tsk-file-list" id="tskFileList"></div>@error('lampiranFiles.*')<span class="tsk-err">{{ $message }}</span>@enderror

            </div>

            {{-- Form Actions --}}
            <div class="tsk-actions">
                <a href="{{ \App\Filament\Pages\SuratKeluar::getUrl() }}"
                   style="padding:10px 20px;border:1px solid #dde0ef;background:#fff;border-radius:8px;font-size:12.5px;font-weight:700;color:#424754;text-decoration:none;transition:background .15s;"
                   onmouseover="this.style.background='#f2f3fd'" onmouseout="this.style.background='#fff'">
                    Batal
                </a>
                <button type="button" class="tsk-btn-draft" wire:click="simpanDraft" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="simpanDraft">Simpan Draft</span>
                    <span wire:loading wire:target="simpanDraft">Menyimpan...</span>
                </button>
                <button type="button" class="tsk-btn-submit" wire:click="ajukanPersetujuan" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="ajukanPersetujuan">Ajukan Persetujuan</span>
                    <span wire:loading wire:target="ajukanPersetujuan">Memproses...</span>
                    <svg wire:loading.remove wire:target="ajukanPersetujuan" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                </button>
            </div>

        </div>


    </div>

    <script>
    // ── Rich Text Editor ──────────────────────────────────────
    function execCmd(cmd, value) {
        document.getElementById('tskEditor').focus();
        document.execCommand(cmd, false, value || null);
        syncEditor();
    }

    function syncEditor() {
        const html   = document.getElementById('tskEditor').innerHTML;
        const hidden = document.getElementById('tskIsiSurat');
        hidden.value = html;
        // Dispatch Livewire input event
        hidden.dispatchEvent(new Event('input', { bubbles: true }));
        updateWordCount();
    }

    function updateWordCount() {
        const text  = document.getElementById('tskEditor').innerText.trim();
        const words = text ? text.split(/\s+/).length : 0;
        const el    = document.getElementById('tskWordCount');
        if (el) el.textContent = words + ' kata';
    }

    // Init editor with Livewire value (on page load)
    document.addEventListener('DOMContentLoaded', function () {
        const editor = document.getElementById('tskEditor');
        // If wire model already has data, sync to editor
        const hidden = document.getElementById('tskIsiSurat');
        if (hidden && hidden.value && hidden.value.trim()) {
            editor.innerHTML = hidden.value;
        }
        updateWordCount();
    });

    // ── File Upload ───────────────────────────────────────────
    const dropzone  = document.getElementById('tskDropzone');
    const fileInput = document.getElementById('tskFileInput');
    const fileList  = document.getElementById('tskFileList');
    let   uploadedFiles = [];

    dropzone.addEventListener('dragover', e => {
        e.preventDefault();
        dropzone.classList.add('drag-over');
    });
    dropzone.addEventListener('dragleave', () => dropzone.classList.remove('drag-over'));
    dropzone.addEventListener('drop', e => {
        e.preventDefault();
        dropzone.classList.remove('drag-over');
        handleFiles(e.dataTransfer.files);
    });

    function handleFiles(files) {
        Array.from(files).forEach(file => {
            if (file.size > 10 * 1024 * 1024) {
                alert(`File "${file.name}" melebihi batas 10 MB.`);
                return;
            }
            uploadedFiles.push(file);
            renderFileItem(file, uploadedFiles.length - 1);
        });
    }

    function renderFileItem(file, idx) {
        const ext  = file.name.split('.').pop().toLowerCase();
        const icon = ['pdf'].includes(ext)
            ? `<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" style="color:#dc2626;"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 7V3.5L18.5 9H13z"/></svg>`
            : `<svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" style="color:#0058be;"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zm-1 7V3.5L18.5 9H13z"/></svg>`;
        const size = (file.size / 1024) > 1024
            ? (file.size / 1024 / 1024).toFixed(1) + ' MB'
            : (file.size / 1024).toFixed(0) + ' KB';

        const item = document.createElement('div');
        item.className = 'tsk-file-item';
        item.dataset.idx = idx;
        item.innerHTML = `
            <div class="tsk-file-info">
                <div class="tsk-file-icon">${icon}</div>
                <div>
                    <p class="tsk-file-name">${file.name}</p>
                    <p class="tsk-file-size">${size}</p>
                </div>
            </div>
            <button type="button" class="tsk-file-del" onclick="removeFile(${idx}, this)" title="Hapus">
                <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
            </button>`;
        fileList.appendChild(item);
    }

    function removeFile(idx, btn) {
        uploadedFiles[idx] = null;
        btn.closest('.tsk-file-item').remove();
    }

    // ── Templates ─────────────────────────────────────────────
    const templates = {
        undangan: `<p>Dengan hormat,</p>
<p>Bersama surat ini, kami mengundang Bapak/Ibu untuk hadir dalam <strong>Rapat Koordinasi</strong> yang akan diselenggarakan pada:</p>
<p>Hari/Tanggal : ___________________<br/>Pukul &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : ___________________<br/>Tempat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ___________________</p>
<p>Mengingat pentingnya acara tersebut, kami sangat mengharapkan kehadiran Bapak/Ibu tepat waktu.</p>
<p>Atas perhatian dan kehadiran Bapak/Ibu, kami mengucapkan terima kasih.</p>`,

        edaran: `<p>Yang terhormat,<br/>Seluruh Warga SMK</p>
<p>Dengan hormat,</p>
<p>Sehubungan dengan <strong>Hari Libur Nasional</strong>, kami beritahukan bahwa kegiatan belajar mengajar akan diliburkan pada tanggal ___________________.</p>
<p>Demikian surat edaran ini dibuat untuk diketahui dan diindahkan oleh semua pihak yang terkait.</p>
<p>Atas perhatiannya kami ucapkan terima kasih.</p>`,

        kerjasama: `<p>Kepada Yth.<br/>_________________, di tempat.</p>
<p>Dengan hormat,</p>
<p>Dalam rangka meningkatkan kualitas pendidikan dan pengembangan kompetensi siswa, kami dari pihak <strong>SMK</strong> bermaksud mengajukan permohonan kerja sama dalam bidang _________________.</p>
<p>Besar harapan kami agar permohonan ini dapat mendapat respon positif dari pihak Bapak/Ibu. Untuk informasi lebih lanjut, kami siap dihubungi melalui kontak yang tertera di bawah surat ini.</p>
<p>Atas perhatian dan pertimbangan Bapak/Ibu, kami mengucapkan terima kasih.</p>`,
    };

    function loadTemplate(key) {
        if (!templates[key]) return;
        const editor = document.getElementById('tskEditor');
        if (editor.innerText.trim() && !confirm('Isi editor akan diganti dengan template. Lanjutkan?')) return;
        editor.innerHTML = templates[key];
        syncEditor();
        editor.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    </script>

</x-filament-panels::page>
