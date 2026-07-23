<?php

it('admin dapat mencetak rekap surat masuk dalam format pdf', function (): void {
    $this->actingAs(makeFeatureUser('Admin'));

    makeIncomingLetter([
        'no_urut_masuk' => '004',
        'nomor_surat' => 'SM/004/VII/2026',
        'tanggal_terima' => '2026-07-07',
    ]);

    $response = $this->get('/admin/cetak-rekap/download?tipe=surat_masuk&mulai=2026-07-01&selesai=2026-07-31&klasifikasi=Biasa');

    $response->assertOk();

    expect($response->headers->get('content-type'))->toContain('application/pdf')
        ->and($response->headers->get('content-disposition'))->toContain('.pdf');
});
