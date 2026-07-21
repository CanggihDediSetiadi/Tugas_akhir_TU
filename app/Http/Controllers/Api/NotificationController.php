<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Disposisi;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Support\RoleAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $suratMasukBelum = SuratMasuk::where('status', 'belum_disposisi')->count();
        $suratKeluarMenunggu = SuratKeluar::where('status', 'menunggu_persetujuan')->count();

        $disposisiQuery = Disposisi::query()->whereIn('status', ['pending', 'diproses']);

        if (RoleAccess::isTeacher($user)) {
            $disposisiQuery->whereIn('diteruskan_ke', RoleAccess::teacherDisposisiRecipients($user));
        }

        $disposisiAktif = $disposisiQuery->count();
        $total = $suratMasukBelum + $disposisiAktif + $suratKeluarMenunggu;

        return response()->json([
            'total' => $total,
            'items' => [
                [
                    'key' => 'surat_masuk',
                    'label' => 'Surat masuk perlu disposisi',
                    'count' => $suratMasukBelum,
                    'description' => "{$suratMasukBelum} surat masuk belum dibuatkan disposisi.",
                    'module' => 'Surat Masuk',
                    'active' => $suratMasukBelum > 0,
                ],
                [
                    'key' => 'disposisi',
                    'label' => 'Disposisi masih aktif',
                    'count' => $disposisiAktif,
                    'description' => "{$disposisiAktif} disposisi masih pending atau sedang diproses.",
                    'module' => 'Disposisi',
                    'active' => $disposisiAktif > 0,
                ],
                [
                    'key' => 'surat_keluar',
                    'label' => 'Surat keluar menunggu persetujuan',
                    'count' => $suratKeluarMenunggu,
                    'description' => "{$suratKeluarMenunggu} surat keluar perlu dicek sebelum dikirim.",
                    'module' => 'Surat Keluar',
                    'active' => $suratKeluarMenunggu > 0,
                ],
            ],
        ]);
    }
}
