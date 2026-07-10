<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">Aktivitas Surat Terkini</x-slot>
        <x-slot name="description">Daftar 5 surat masuk terakhir yang diterima sistem.</x-slot>
        <x-slot name="headerEnd">
            <x-filament::link href="#" color="primary" size="sm">
                Lihat Semua
            </x-filament::link>
        </x-slot>

        <div class="overflow-x-auto -mx-4 sm:-mx-6">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                        <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">No. Agenda</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">Pengirim</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 hidden md:table-cell">Perihal</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 text-center">Sifat</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 text-center">Status</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @php
                        $letters = [
                            [
                                'agenda'   => 'SM/2024/05/128',
                                'pengirim' => 'Dinas Pendidikan Prov',
                                'perihal'  => 'Undangan Rapat Koordinasi Kurikulum',
                                'sifat'    => 'Penting',
                                'status'   => 'Disposisi',
                            ],
                            [
                                'agenda'   => 'SM/2024/05/127',
                                'pengirim' => 'PT. Teknologi Maju',
                                'perihal'  => 'Penawaran Kerja Sama Program Magang',
                                'sifat'    => 'Biasa',
                                'status'   => 'Selesai',
                            ],
                            [
                                'agenda'   => 'SM/2024/05/126',
                                'pengirim' => 'Kementrian Pendidikan',
                                'perihal'  => 'Petunjuk Teknis Dana BOS 2024',
                                'sifat'    => 'Penting',
                                'status'   => 'Disposisi',
                            ],
                            [
                                'agenda'   => 'SM/2024/05/125',
                                'pengirim' => 'Yys. Pendidikan Abadi',
                                'perihal'  => 'Mutasi Staff Pengajar Tahap II',
                                'sifat'    => 'Biasa',
                                'status'   => 'Draft',
                            ],
                            [
                                'agenda'   => 'SM/2024/05/124',
                                'pengirim' => 'Kecamatan Kebayoran',
                                'perihal'  => 'Laporan Data Siswa Baru Domisili',
                                'sifat'    => 'Biasa',
                                'status'   => 'Selesai',
                            ],
                        ];

                        $sifatColor = [
                            'Penting' => 'bg-red-100 text-red-800 border border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800',
                            'Biasa'   => 'bg-blue-100 text-blue-800 border border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800',
                        ];

                        $statusColor = [
                            'Disposisi' => 'bg-blue-100 text-blue-800 border border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800',
                            'Selesai'   => 'bg-green-100 text-green-800 border border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800',
                            'Draft'     => 'bg-yellow-100 text-yellow-800 border border-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300 dark:border-yellow-800',
                        ];
                    @endphp

                    @foreach ($letters as $letter)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/40 transition-colors duration-150">
                            <td class="px-4 py-4 text-sm font-mono text-gray-700 dark:text-gray-300 whitespace-nowrap">
                                {{ $letter['agenda'] }}
                            </td>
                            <td class="px-4 py-4 text-sm font-semibold text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $letter['pengirim'] }}
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-400 hidden md:table-cell max-w-xs truncate">
                                {{ $letter['perihal'] }}
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold uppercase {{ $sifatColor[$letter['sifat']] }}">
                                    {{ $letter['sifat'] }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-center">
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold uppercase {{ $statusColor[$letter['status']] }}">
                                    {{ $letter['status'] }}
                                </span>
                            </td>
                            <td class="px-4 py-4 text-right">
                                <button
                                    type="button"
                                    class="text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-150"
                                    title="Lihat Detail"
                                >
                                    <x-heroicon-o-eye class="w-5 h-5" />
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
