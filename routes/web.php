<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/notifications', [\App\Http\Controllers\Api\NotificationController::class, 'index'])
    ->middleware('auth')
    ->name('api.notifications');

Route::get('/admin/cetak-rekap/download', function (\Illuminate\Http\Request $request) {
    abort_unless(\App\Support\RoleAccess::canPrintReports(), 403);

    $tipe = $request->query('tipe', 'surat_masuk');
    $mulai = $request->query('mulai');
    $selesai = $request->query('selesai');
    $klasifikasi = $request->query('klasifikasi');
    $format = 'pdf';

    $rows = [];
    $baseName = 'rekap-' . $tipe . '-' . now()->format('Ymd-His');

    if ($tipe === 'surat_keluar') {
        $query = \App\Models\SuratKeluar::query()->orderBy('tanggal_surat');
        if ($mulai) $query->whereDate('tanggal_surat', '>=', $mulai);
        if ($selesai) $query->whereDate('tanggal_surat', '<=', $selesai);
        if ($klasifikasi) $query->where('kategori', $klasifikasi);
        $rows[] = ['Nomor Surat', 'Tanggal', 'Tujuan', 'Perihal', 'Kategori', 'Status'];
        foreach ($query->get() as $item) {
            $rows[] = [$item->nomor_surat, optional($item->tanggal_surat)->format('Y-m-d'), $item->tujuan, $item->perihal, $item->kategori, $item->status_label];
        }
    } elseif ($tipe === 'disposisi') {
        $query = \App\Models\Disposisi::with('suratMasuk')->orderBy('created_at');
        if ($mulai) $query->whereDate('created_at', '>=', $mulai);
        if ($selesai) $query->whereDate('created_at', '<=', $selesai);
        $rows[] = ['Nomor Disposisi', 'Tanggal', 'Nomor Surat', 'Perihal', 'Diteruskan Ke', 'Sifat', 'Status'];
        foreach ($query->get() as $item) {
            $rows[] = [$item->nomor_disposisi, $item->created_at?->format('Y-m-d'), $item->suratMasuk?->nomor_surat, $item->suratMasuk?->perihal, $item->diteruskan_ke, $item->sifat_label, $item->status_label];
        }
    } else {
        $query = \App\Models\SuratMasuk::query()->orderBy('tanggal_terima');
        if ($mulai) $query->whereDate('tanggal_terima', '>=', $mulai);
        if ($selesai) $query->whereDate('tanggal_terima', '<=', $selesai);
        if ($klasifikasi) $query->where('klasifikasi', $klasifikasi);
        $rows[] = ['Nomor Surat', 'Tanggal Terima', 'Asal Surat', 'Perihal', 'Klasifikasi', 'Status'];
        foreach ($query->get() as $item) {
            $rows[] = [$item->nomor_surat, optional($item->tanggal_terima)->format('Y-m-d'), $item->asal_surat, $item->perihal, $item->klasifikasi, $item->status_label];
        }
    }

    $meta = ['mulai' => $mulai, 'selesai' => $selesai, 'klasifikasi' => $klasifikasi];
    return \App\Support\ReportExporter::download($rows, $baseName, $format, $meta);
})->middleware('auth')->name('rekap.download');
Route::get('/admin/arsip-digital/{arsip}/download', function (\App\Models\ArsipDigital $arsip) {
    abort_unless($arsip->path_file, 404);
    return \Illuminate\Support\Facades\Storage::disk('public')->download($arsip->path_file, $arsip->nama_dokumen . ($arsip->format ? '.' . $arsip->format : ''));
})->middleware('auth')->name('arsip.download');
