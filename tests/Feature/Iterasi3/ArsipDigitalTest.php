<?php

use App\Filament\Pages\ArsipDigital;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function (): void {
    Storage::fake('public');
});

it('kepala sekolah dapat membuat folder arsip digital', function (): void {
    $this->actingAs(makeFeatureUser('Kepala Sekolah'));

    Livewire::test(ArsipDigital::class)
        ->set('nama_dokumen', 'Folder Surat Masuk 2026')
        ->set('kategori', 'Surat Masuk')
        ->set('klasifikasi', 'Biasa')
        ->set('keterangan', 'Arsip persuratan masuk tahun 2026')
        ->call('buatFolder')
        ->assertHasNoErrors();

    $this->assertDatabaseHas('arsip_digital', [
        'nama_dokumen' => 'Folder Surat Masuk 2026',
        'tipe' => 'folder',
        'status' => 'tervalidasi',
    ]);
});
