<?php

use App\Filament\Pages\Disposisi as DisposisiPage;
use App\Models\Disposisi;
use Livewire\Livewire;

it('kepala sekolah dapat membuat disposisi dan wakasek dapat menindaklanjutinya', function (): void {
    $kepalaSekolah = makeFeatureUser('Kepala Sekolah');
    $wakasek = makeFeatureUser('Wakasek', [
        'name' => 'Wakasek Kurikulum',
        'jabatan' => 'Wakil Kepala Sekolah',
    ]);
    $suratMasuk = makeIncomingLetter();

    $this->actingAs($kepalaSekolah);

    Livewire::test(DisposisiPage::class)
        ->set('surat_masuk_id', (string) $suratMasuk->id)
        ->set('nomor_agenda', 'AG-001/VII/2026')
        ->set('asal_surat', $suratMasuk->asal_surat)
        ->set('tanggal_surat', '2026-07-01')
        ->set('tanggal_terima', '2026-07-02')
        ->set('perihal', $suratMasuk->perihal)
        ->set('sifat', 'Penting')
        ->set('tanggal_disposisi', '2026-07-06')
        ->set('tanggal_penyelesaian', '2026-07-10')
        ->set('instruksi_pilihan', ['Tindak lanjuti'])
        ->set('penerima_pilihan', ['Wakasek'])
        ->call('simpanDisposisi')
        ->assertHasNoErrors();

    $disposisi = Disposisi::where('surat_masuk_id', $suratMasuk->id)->firstOrFail();

    expect($disposisi->status)->toBe('pending')
        ->and($suratMasuk->refresh()->status)->toBe('sudah_disposisi');

    $this->actingAs($wakasek);

    Livewire::test(DisposisiPage::class)
        ->call('tandaiDiproses', $disposisi->id)
        ->assertHasNoErrors();

    expect($disposisi->refresh()->status)->toBe('diproses');

    Livewire::test(DisposisiPage::class)
        ->call('tandaiSelesai', $disposisi->id)
        ->assertHasNoErrors();

    expect($disposisi->refresh()->status)->toBe('selesai')
        ->and($suratMasuk->refresh()->status)->toBe('selesai');
});
