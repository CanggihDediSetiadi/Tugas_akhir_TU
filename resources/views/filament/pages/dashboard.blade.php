{{-- SMAN 4 Surabaya – Custom Dashboard --}}
<x-filament-panels::page>
    {{ $this->content }}

    <style>
        .siatu-hero-title {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: -0.02em;
            color: #191b23;
        }
        .siatu-hero-sub { font-size: .95rem; color: #424754; margin-top: 4px; }
        html.dark .siatu-hero-title { color:#ffffff !important; }
        html.dark .siatu-hero-sub { color:#e5e7eb !important; }
        .siatu-stat-card {
            background: #ffffff;
            border: 1px solid #e1e2ec;
            border-radius: 14px;
            padding: 22px 24px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            transition: box-shadow .2s, transform .2s;
        }
        .siatu-stat-card:hover { box-shadow: 0 6px 16px rgba(0,0,0,0.1); transform: translateY(-2px); }
        .siatu-stat-bg-icon {
            position: absolute; top: 10px; right: 10px;
            opacity: .08; pointer-events: none; transition: opacity .3s;
        }
        .siatu-stat-card:hover .siatu-stat-bg-icon { opacity: .13; }
        .siatu-stat-label {
            font-size: 10.5px; font-weight: 700;
            letter-spacing: .07em; text-transform: uppercase; color: #727785;
        }
        .siatu-stat-value {
            font-size: 2.4rem; font-weight: 800;
            line-height: 1.1; color: #191b23; margin-top: 6px;
        }
        .siatu-stat-trend {
            display: flex; align-items: center; gap: 5px;
            margin-top: 8px; font-size: 11.5px; font-weight: 700;
        }
        .siatu-card {
            background: #ffffff;
            border: 1px solid #e1e2ec;
            border-radius: 14px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        .siatu-section-title { font-size: 1.05rem; font-weight: 700; color: #191b23; }
        .siatu-section-sub   { font-size: .82rem; color: #424754; margin-top: 2px; }
        .siatu-progress-track { height: 7px; background: #e6e7f2; border-radius: 99px; overflow: hidden; }
        .siatu-progress-fill  { height: 100%; background: #0058be; border-radius: 99px; transition: width 1.2s ease; }
        .siatu-badge {
            display: inline-flex; align-items: center;
            padding: 2px 9px; border-radius: 4px;
            font-size: 10px; font-weight: 800;
            text-transform: uppercase; letter-spacing: .04em;
        }
        .badge-red   { background:#fee2e2; color:#991b1b; border:1px solid #fca5a5; }
        .badge-blue  { background:#dbeafe; color:#1e40af; border:1px solid #93c5fd; }
        .badge-green { background:#dcfce7; color:#166534; border:1px solid #86efac; }
        .badge-yellow{ background:#fef9c3; color:#854d0e; border:1px solid #fde047; }
        .siatu-table { width:100%; border-collapse:collapse; }
        .siatu-table th {
            padding: 10px 16px; font-size: 10.5px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .05em;
            color: #727785; background: #f5f5fe;
            border-bottom: 1px solid #e1e2ec; white-space:nowrap;
        }
        .siatu-table td {
            padding: 13px 16px; font-size: 13.5px; color: #191b23;
            border-bottom: 1px solid #ecedf7; vertical-align: middle;
        }
        .siatu-table tr:last-child td { border-bottom: none; }
        .siatu-table tr:hover td { background: #f9f9ff; }
        .siatu-btn-out {
            display:inline-flex;align-items:center;gap:6px;
            padding:8px 16px; background:#fff; border:1px solid #dde0ef;
            border-radius:8px; font-size:12px; font-weight:700; color:#191b23;
            cursor:pointer; box-shadow:0 1px 2px rgba(0,0,0,.05); transition:background .15s;
        }
        .siatu-btn-out:hover { background:#f2f3fd; }
        .siatu-btn-pri {
            display:inline-flex;align-items:center;gap:6px;
            padding:8px 16px; background:#0058be; border:none;
            border-radius:8px; font-size:12px; font-weight:700; color:#fff;
            cursor:pointer; box-shadow:0 2px 7px rgba(0,88,190,.35); transition:background .15s;
        }
        .siatu-btn-pri:hover { background:#0049a0; }
        .trend-blue { color:#0058be; }
        .trend-red  { color:#dc2626; }
        .trend-green{ color:#166534; }
        .reminder-red {
            display:flex;gap:10px;align-items:flex-start;
            padding:11px 13px; background:#fef2f2;
            border:1px solid #fecaca; border-radius:10px;
        }
        .reminder-amber {
            display:flex;gap:10px;align-items:flex-start;
            padding:11px 13px; background:#fffbeb;
            border:1px solid #fde68a; border-radius:10px;
        }
        @media(max-width:860px){
            #siatu-mid-row { grid-template-columns:1fr !important; }
        }
    </style>

    <div style="margin-top:-4px;">
        @if(\App\Support\RoleAccess::isTeacher())
        @php
            $teacherDisposisi = \App\Models\Disposisi::with('suratMasuk')
                ->forRecipients(\App\Support\RoleAccess::teacherDisposisiRecipients())
                ->latest()
                ->get();
            $pendingGuru = $teacherDisposisi->where('status', 'pending')->count();
            $diprosesGuru = $teacherDisposisi->where('status', 'diproses')->count();
            $selesaiGuru = $teacherDisposisi->where('status', 'selesai')->count();
        @endphp

        <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:24px;">
            <div>
                <h1 class="siatu-hero-title">Dashboard Guru</h1>
                <p class="siatu-hero-sub">Ringkasan disposisi surat yang menjadi tanggung jawab Anda.</p>
            </div>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:24px;">
            <div class="siatu-stat-card"><p class="siatu-stat-label">Disposisi Saya</p><p class="siatu-stat-value">{{ $teacherDisposisi->count() }}</p><div class="siatu-stat-trend trend-blue">Total tugas</div></div>
            <div class="siatu-stat-card"><p class="siatu-stat-label">Menunggu</p><p class="siatu-stat-value" style="color:#924700;">{{ $pendingGuru }}</p><div class="siatu-stat-trend trend-red">Perlu ditindaklanjuti</div></div>
            <div class="siatu-stat-card"><p class="siatu-stat-label">Diproses</p><p class="siatu-stat-value" style="color:#1e40af;">{{ $diprosesGuru }}</p><div class="siatu-stat-trend trend-blue">Sedang berjalan</div></div>
            <div class="siatu-stat-card"><p class="siatu-stat-label">Selesai</p><p class="siatu-stat-value" style="color:#166534;">{{ $selesaiGuru }}</p><div class="siatu-stat-trend trend-green">Sudah selesai</div></div>
        </div>

        <div class="siatu-card" style="margin-bottom:8px;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;padding:20px 24px 16px;gap:12px;">
                <div>
                    <p class="siatu-section-title">Disposisi Terbaru</p>
                    <p class="siatu-section-sub">Surat yang diteruskan kepada Anda beserta instruksinya.</p>
                </div>
                <a href="{{ \App\Filament\Pages\Disposisi::getUrl() }}" style="font-size:12px;font-weight:700;color:#0058be;text-decoration:none;">Buka Disposisi</a>
            </div>
            <div style="overflow-x:auto;">
                <table class="siatu-table">
                    <thead><tr><th style="text-align:left;">Perihal</th><th style="text-align:left;">Instruksi</th><th style="text-align:center;">Status</th></tr></thead>
                    <tbody>
                        @forelse($teacherDisposisi->take(5) as $item)
                        <tr>
                            <td style="font-weight:700;">{{ \Illuminate\Support\Str::limit($item->suratMasuk?->perihal ?? '-', 45) }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->instruksi ?: '-', 70) }}</td>
                            <td style="text-align:center;"><span class="siatu-badge {{ $item->status === 'selesai' ? 'badge-green' : ($item->status === 'diproses' ? 'badge-blue' : 'badge-yellow') }}">{{ $item->status_label }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="3" style="text-align:center;color:#727785;padding:28px;">Belum ada disposisi untuk Anda.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @else

        {{-- ── Page Header ── --}}
        <div style="display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:16px;margin-bottom:24px;">
            <div>
                <h1 class="siatu-hero-title">Statistik Administrasi</h1>
                <p class="siatu-hero-sub">Pantau performa dan volume persuratan sekolah hari ini.</p>
            </div>
        </div>

        {{-- ── 4 Stat Cards ── --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px;margin-bottom:24px;">

            {{-- Surat Masuk --}}
            <div class="siatu-stat-card">
                <div class="siatu-stat-bg-icon">
                    <svg width="90" height="90" fill="none" stroke="#0058be" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859M2.25 9V6a2.25 2.25 0 012.25-2.25h15A2.25 2.25 0 0121.75 6v3M2.25 9h19.5"/></svg>
                </div>
                <p class="siatu-stat-label">Total Surat Masuk</p>
                <p class="siatu-stat-value">1,284</p>
                <div class="siatu-stat-trend trend-blue">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                    +12% bulan ini
                </div>
            </div>

            {{-- Surat Keluar --}}
            <div class="siatu-stat-card">
                <div class="siatu-stat-bg-icon">
                    <svg width="90" height="90" fill="none" stroke="#545f73" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>
                </div>
                <p class="siatu-stat-label">Total Surat Keluar</p>
                <p class="siatu-stat-value">856</p>
                <div class="siatu-stat-trend trend-blue">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path d="M7 17l9.2-9.2M17 17V7H7"/></svg>
                    +5% bulan ini
                </div>
            </div>

            {{-- Disposisi --}}
            <div class="siatu-stat-card">
                <div class="siatu-stat-bg-icon">
                    <svg width="90" height="90" fill="none" stroke="#d97706" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="siatu-stat-label">Disposisi Menunggu</p>
                <p class="siatu-stat-value" style="color:#924700;">24</p>
                <div class="siatu-stat-trend trend-red">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"/></svg>
                    Segera diproses
                </div>
            </div>

            {{-- Arsip --}}
            <div class="siatu-stat-card">
                <div class="siatu-stat-bg-icon">
                    <svg width="90" height="90" fill="none" stroke="#166534" stroke-width="1" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/></svg>
                </div>
                <p class="siatu-stat-label">Arsip Selesai</p>
                <p class="siatu-stat-value" style="color:#166534;">2,110</p>
                <div class="siatu-stat-trend trend-green">
                    <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
                    Tersinkronisasi Cloud
                </div>
            </div>

        </div>

        {{-- ── Chart + Storage ── --}}
        <div id="siatu-mid-row" style="display:grid;grid-template-columns:2fr 1fr;gap:16px;margin-bottom:24px;">

            {{-- Bar Chart --}}
            <div class="siatu-card">
                <div style="padding:20px 24px 16px;">
                    <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;">
                        <div>
                            <p class="siatu-section-title">Volume Persuratan 6 Bulan Terakhir</p>
                            <p class="siatu-section-sub">Statistik perbandingan surat masuk dan keluar.</p>
                        </div>
                        <div style="display:flex;align-items:center;gap:14px;flex-shrink:0;padding-top:2px;">
                            <span style="display:flex;align-items:center;gap:5px;font-size:11px;font-weight:600;color:#727785;">
                                <span style="width:10px;height:10px;border-radius:50%;background:#0058be;display:inline-block;"></span> Masuk
                            </span>
                            <span style="display:flex;align-items:center;gap:5px;font-size:11px;font-weight:600;color:#727785;">
                                <span style="width:10px;height:10px;border-radius:50%;background:#545f73;display:inline-block;"></span> Keluar
                            </span>
                        </div>
                    </div>
                </div>
                <div style="padding:0 24px 24px;">
                    <div style="position:relative;height:260px;">
                        <canvas id="siatuVolumeChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Pengingat & Info Administrasi --}}
            <div class="siatu-card" style="padding:24px;">
                <p class="siatu-section-title" style="margin-bottom:20px;">Agenda Administrasi</p>



                <div>
                    <p style="font-size:9.5px;font-weight:800;text-transform:uppercase;letter-spacing:.08em;color:#727785;margin-bottom:12px;">Ringkasan Hari Ini</p>
                    <div style="display:flex;flex-direction:column;gap:8px;">
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 12px;background:#f5f5fe;border-radius:8px;">
                            <span style="font-size:12px;font-weight:600;color:#424754;">Surat Masuk Hari Ini</span>
                            <span style="font-size:13px;font-weight:800;color:#0058be;">{{ \App\Models\SuratMasuk::whereDate('created_at', today())->count() }}</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 12px;background:#f5f5fe;border-radius:8px;">
                            <span style="font-size:12px;font-weight:600;color:#424754;">Surat Keluar Hari Ini</span>
                            <span style="font-size:13px;font-weight:800;color:#545f73;">{{ \App\Models\SuratKeluar::whereDate('created_at', today())->count() }}</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 12px;background:#fff7ed;border-radius:8px;border:1px solid #fed7aa;">
                            <span style="font-size:12px;font-weight:600;color:#92400e;">Disposisi Menunggu</span>
                            <span style="font-size:13px;font-weight:800;color:#924700;">{{ \App\Models\SuratMasuk::where('status','belum_disposisi')->count() }}</span>
                        </div>
                    </div>
                </div>

            </div>


        </div>

        {{-- ── Activity Table ── --}}
        <div class="siatu-card" style="margin-bottom:8px;">
            <div style="display:flex;align-items:flex-start;justify-content:space-between;padding:20px 24px 16px;">
                <div>
                    <p class="siatu-section-title">Aktivitas Surat Terkini</p>
                    <p class="siatu-section-sub">Daftar 5 surat masuk terakhir yang diterima sistem.</p>
                </div>
                <a href="#" style="font-size:12px;font-weight:700;color:#0058be;text-decoration:none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Lihat Semua</a>
            </div>
            <div style="overflow-x:auto;">
                <table class="siatu-table">
                    <thead>
                        <tr>
                            <th style="text-align:left;">No. Agenda</th>
                            <th style="text-align:left;">Pengirim</th>
                            <th style="text-align:left;">Perihal</th>
                            <th style="text-align:center;">Sifat</th>
                            <th style="text-align:center;">Status</th>
                            <th style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $letters = [
                            ['a'=>'SM/2024/05/128','p'=>'Dinas Pendidikan Prov','h'=>'Undangan Rapat Koordinasi Kurikulum','s'=>'Penting','st'=>'Disposisi'],
                            ['a'=>'SM/2024/05/127','p'=>'PT. Teknologi Maju','h'=>'Penawaran Kerja Sama Program Magang','s'=>'Biasa','st'=>'Selesai'],
                            ['a'=>'SM/2024/05/126','p'=>'Kementrian Pendidikan','h'=>'Petunjuk Teknis Dana BOS 2024','s'=>'Penting','st'=>'Disposisi'],
                            ['a'=>'SM/2024/05/125','p'=>'Yys. Pendidikan Abadi','h'=>'Mutasi Staff Pengajar Tahap II','s'=>'Biasa','st'=>'Draft'],
                            ['a'=>'SM/2024/05/124','p'=>'Kecamatan Kebayoran','h'=>'Laporan Data Siswa Baru Domisili','s'=>'Biasa','st'=>'Selesai'],
                        ];
                        $sc = ['Penting'=>'badge-red','Biasa'=>'badge-blue'];
                        $tc = ['Disposisi'=>'badge-blue','Selesai'=>'badge-green','Draft'=>'badge-yellow'];
                        @endphp
                        @foreach($letters as $r)
                        <tr>
                            <td><span style="font-family:monospace;font-size:12px;color:#545f73;">{{ $r['a'] }}</span></td>
                            <td style="font-weight:700;">{{ $r['p'] }}</td>
                            <td style="color:#424754;max-width:260px;">{{ $r['h'] }}</td>
                            <td style="text-align:center;"><span class="siatu-badge {{ $sc[$r['s']] }}">{{ $r['s'] }}</span></td>
                            <td style="text-align:center;"><span class="siatu-badge {{ $tc[$r['st']] }}">{{ $r['st'] }}</span></td>
                            <td style="text-align:right;padding-right:20px;">
                                <button style="background:none;border:none;cursor:pointer;color:#9ca3af;padding:2px;" onmouseover="this.style.color='#0058be'" onmouseout="this.style.color='#9ca3af'">
                                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @endif
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <script>
        (function tryInit() {
            if (typeof Chart === 'undefined') { return setTimeout(tryInit, 150); }
            var canvas = document.getElementById('siatuVolumeChart');
            if (!canvas) { return; }
            if (canvas._chartInited) return;
            canvas._chartInited = true;

            new Chart(canvas.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Des', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
                    datasets: [
                        {
                            label: 'Surat Masuk',
                            data: [40,60,55,85,70,95],
                            backgroundColor: 'rgba(0,88,190,0.88)',
                            borderRadius: 5,
                            borderSkipped: false,
                        },
                        {
                            label: 'Surat Keluar',
                            data: [30,45,50,60,65,75],
                            backgroundColor: 'rgba(84,95,115,0.72)',
                            borderRadius: 5,
                            borderSkipped: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#191b23',
                            bodyColor: '#424754',
                            borderColor: '#e1e2ec',
                            borderWidth: 1,
                            padding: 10,
                            cornerRadius: 8,
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { color: '#727785', font: { size: 11, weight: '600', family: 'Inter, sans-serif' }},
                            border: { display: false }
                        },
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(0,0,0,0.05)' },
                            ticks: { color: '#727785', font: { size: 11, family: 'Inter, sans-serif' }, maxTicksLimit: 6 },
                            border: { display: false }
                        }
                    },
                    barPercentage: 0.62,
                    categoryPercentage: 0.72,
                }
            });

            // Storage bar animation
            var bar = document.getElementById('siatuStorage');
            if (bar) setTimeout(function(){ bar.style.width = '78%'; }, 500);
        })();

        // Run on load and on Livewire navigation
        document.addEventListener('DOMContentLoaded', function(){ tryInit && tryInit(); });
        document.addEventListener('livewire:navigated', function(){ tryInit && tryInit(); });
    </script>

</x-filament-panels::page>

