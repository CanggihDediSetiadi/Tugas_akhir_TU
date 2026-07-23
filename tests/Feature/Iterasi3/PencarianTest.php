<?php

it('staff mendapatkan halaman surat masuk dengan fasilitas pencarian data', function (): void {
    $this->actingAs(makeFeatureUser('Admin'));

    makeIncomingLetter([
        'nomor_surat' => 'SM/CARI/VII/2026',
        'asal_surat' => 'Dinas Pendidikan Kota Surabaya',
        'perihal' => 'Permintaan data khusus',
    ]);

    makeIncomingLetter([
        'nomor_surat' => 'SM/LAIN/VII/2026',
        'asal_surat' => 'Komite Sekolah',
        'perihal' => 'Undangan rapat umum',
    ]);

    $this->get('/admin/surat-masuk')
        ->assertOk()
        ->assertSee('id="smSearch"', false)
        ->assertSee('smFilterTable()', false)
        ->assertSee('Permintaan data khusus')
        ->assertSee('Undangan rapat umum');
});
