<?php

namespace Database\Seeders;

use App\Models\SuratKeluar;
use Illuminate\Database\Seeder;

class SuratKeluarSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nomor_surat'   => 'SMK/TU/2024/X/0001',
                'tanggal_surat' => '2024-10-01',
                'tujuan'        => 'Kepala Dinas Pendidikan Provinsi Jawa Barat',
                'perihal'       => 'Permohonan Dana BOS Triwulan IV Tahun 2024',
                'isi_surat'     => '<p>Dengan hormat,</p><p>Melalui surat ini kami bermaksud mengajukan permohonan pencairan dana BOS...</p>',
                'status'        => 'dikirim',
                'kategori'      => 'Penting',
            ],
            [
                'nomor_surat'   => 'SMK/TU/2024/X/0002',
                'tanggal_surat' => '2024-10-05',
                'tujuan'        => 'PT. Teknologi Industri Nusantara',
                'perihal'       => 'Permohonan Kerja Sama Program Magang Siswa',
                'isi_surat'     => '<p>Dengan hormat,</p><p>Kami bermaksud mengajukan kerja sama program magang...</p>',
                'status'        => 'disetujui',
                'kategori'      => 'Biasa',
            ],
            [
                'nomor_surat'   => 'SMK/TU/2024/X/0003',
                'tanggal_surat' => '2024-10-10',
                'tujuan'        => 'Orang Tua / Wali Murid Kelas XII',
                'perihal'       => 'Undangan Pertemuan Wali Murid dan Rencana PKL',
                'isi_surat'     => '<p>Dengan hormat,</p><p>Kami mengundang Bapak/Ibu wali murid untuk hadir dalam pertemuan...</p>',
                'status'        => 'menunggu_persetujuan',
                'kategori'      => 'Penting',
            ],
            [
                'nomor_surat'   => 'SMK/TU/2024/X/0004',
                'tanggal_surat' => '2024-10-15',
                'tujuan'        => 'Kecamatan Kebayoran Baru',
                'perihal'       => 'Laporan Data Siswa Baru Domisili Semester Ganjil',
                'isi_surat'     => '<p>Dengan hormat,</p><p>Bersama ini kami sampaikan laporan data siswa baru...</p>',
                'status'        => 'dikirim',
                'kategori'      => 'Biasa',
            ],
            [
                'nomor_surat'   => 'SMK/TU/2024/X/0005',
                'tanggal_surat' => '2024-10-20',
                'tujuan'        => 'Kepala Sekolah SMK Mitra Bangsa',
                'perihal'       => 'Undangan Lomba Kompetensi Siswa Tingkat Kota',
                'isi_surat'     => '<p>Dengan hormat,</p><p>Kami dengan hormat mengundang siswa berprestasi...</p>',
                'status'        => 'draft',
                'kategori'      => 'Biasa',
            ],
            [
                'nomor_surat'   => 'SMK/TU/2024/X/0006',
                'tanggal_surat' => '2024-10-22',
                'tujuan'        => 'Yayasan Pendidikan Abadi Sejahtera',
                'perihal'       => 'Laporan Keuangan Operasional Bulan Oktober 2024',
                'isi_surat'     => '<p>Dengan hormat,</p><p>Bersama ini kami sampaikan laporan keuangan operasional...</p>',
                'status'        => 'menunggu_persetujuan',
                'kategori'      => 'Sangat Penting',
            ],
        ];

        foreach ($data as $item) {
            SuratKeluar::create($item);
        }
    }
}
