<?php

use App\Filament\Pages\SuratMasuk as SuratMasukPage;
use Livewire\Livewire;

it('staff dapat menyimpan data surat masuk', function (): void {
    $staff = makeFeatureUser('Admin');

    $this->actingAs($staff);

    Livewire::test(SuratMasukPage::class)
        ->set('no_urut_masuk', '002')
        ->set('tanggal_surat', '2026-07-03')
        ->set('nomor_surat', 'SM/002/VII/2026')
        ->set('tanggal_terima', '2026-07-04')
        ->set('asal_surat', 'Cabang Dinas Pendidikan')
        ->set('perihal', 'Permintaan data tata usaha')
        ->set('klasifikasi', 'Penting')
        ->set('status', 'belum_disposisi')
        ->call('simpanSuratMasuk')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('surat_masuk', [
        'nomor_surat' => 'SM/002/VII/2026',
        'asal_surat' => 'Cabang Dinas Pendidikan',
        'diterima_oleh' => $staff->id,
    ]);
});
