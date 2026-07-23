<?php

use App\Filament\Pages\SuratKeluar;
use App\Filament\Pages\TambahSuratKeluar;
use App\Models\SuratKeluar as SuratKeluarModel;
use Livewire\Livewire;

it('staff dapat membuat surat keluar dan menjalankan alur persetujuan sampai dikirim', function (): void {
    $this->actingAs(makeFeatureUser('Admin'));

    Livewire::test(TambahSuratKeluar::class)
        ->set('nomor_surat', 'SK/001/VII/2026')
        ->set('tanggal_surat', '2026-07-05')
        ->set('alamat_tujuan', 'Komite Sekolah')
        ->set('perihal', 'Pemberitahuan rapat koordinasi')
        ->set('keterangan', 'Mohon menghadiri rapat koordinasi sekolah.')
        ->call('ajukanPersetujuan')
        ->assertHasNoErrors();

    $suratKeluar = SuratKeluarModel::where('nomor_surat', 'SK/001/VII/2026')->firstOrFail();

    expect($suratKeluar->status)->toBe('menunggu_persetujuan');

    Livewire::test(SuratKeluar::class)
        ->call('setujuiSurat', $suratKeluar->id)
        ->assertHasNoErrors();

    expect($suratKeluar->refresh()->status)->toBe('disetujui');

    Livewire::test(SuratKeluar::class)
        ->call('tandaiDikirim', $suratKeluar->id)
        ->assertHasNoErrors();

    expect($suratKeluar->refresh()->status)->toBe('dikirim');
});
