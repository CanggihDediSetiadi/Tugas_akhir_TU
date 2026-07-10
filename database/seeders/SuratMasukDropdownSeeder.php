<?php

namespace Database\Seeders;

use App\Models\SuratMasuk;
use Illuminate\Database\Seeder;

class SuratMasukDropdownSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'nomor_surat' => '421.3/001/SMAN4/VII/2026',
                'tanggal_surat' => '2026-07-01',
                'tanggal_terima' => '2026-07-02',
                'asal_surat' => 'Dinas Pendidikan Provinsi Jawa Timur',
                'perihal' => 'Undangan Rapat Koordinasi Kurikulum',
                'isi_surat' => 'Undangan rapat koordinasi kurikulum tingkat SMA.',
                'klasifikasi' => 'Penting',
                'status' => 'belum_disposisi',
                'keterangan' => 'Perlu disposisi kepada bidang kurikulum.',
            ],
            [
                'nomor_surat' => '005/142/Disdik/VII/2026',
                'tanggal_surat' => '2026-07-03',
                'tanggal_terima' => '2026-07-04',
                'asal_surat' => 'Cabang Dinas Pendidikan Wilayah Surabaya',
                'perihal' => 'Permintaan Data Peserta Didik Baru',
                'isi_surat' => 'Permintaan rekap data peserta didik baru tahun ajaran berjalan.',
                'klasifikasi' => 'Biasa',
                'status' => 'belum_disposisi',
                'keterangan' => 'Diteruskan untuk pengumpulan data.',
            ],
            [
                'nomor_surat' => '800/087/BKPSDM/VII/2026',
                'tanggal_surat' => '2026-07-05',
                'tanggal_terima' => '2026-07-06',
                'asal_surat' => 'BKPSDM Kota Surabaya',
                'perihal' => 'Sosialisasi Administrasi Kepegawaian',
                'isi_surat' => 'Pemberitahuan kegiatan sosialisasi administrasi kepegawaian.',
                'klasifikasi' => 'Penting',
                'status' => 'belum_disposisi',
                'keterangan' => 'Perlu tindak lanjut bagian tata usaha.',
            ],
            [
                'nomor_surat' => '421/221/Komite/VII/2026',
                'tanggal_surat' => '2026-07-06',
                'tanggal_terima' => '2026-07-07',
                'asal_surat' => 'Komite SMAN 4 Surabaya',
                'perihal' => 'Koordinasi Program Sekolah',
                'isi_surat' => 'Koordinasi program sekolah bersama komite.',
                'klasifikasi' => 'Biasa',
                'status' => 'belum_disposisi',
                'keterangan' => 'Untuk koordinasi internal.',
            ],
            [
                'nomor_surat' => '700/014/Inspektorat/VII/2026',
                'tanggal_surat' => '2026-07-07',
                'tanggal_terima' => '2026-07-07',
                'asal_surat' => 'Inspektorat Provinsi Jawa Timur',
                'perihal' => 'Pemberitahuan Monitoring Administrasi',
                'isi_surat' => 'Pemberitahuan monitoring administrasi sekolah.',
                'klasifikasi' => 'Rahasia',
                'status' => 'belum_disposisi',
                'keterangan' => 'Perlu perhatian Kepala Sekolah.',
            ],
        ];

        foreach ($items as $item) {
            SuratMasuk::firstOrCreate(
                ['nomor_surat' => $item['nomor_surat']],
                $item,
            );
        }
    }
}
