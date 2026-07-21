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

        $suratMasukIds = SuratMasuk::query()->orderBy('id')->pluck('id')->map(fn ($id) => (int) $id)->all();
        $suratKeluarIds = SuratKeluar::query()->orderBy('id')->pluck('id')->map(fn ($id) => (int) $id)->all();

        $disposisiQuery = Disposisi::query();

        if (RoleAccess::isTeacher($user)) {
            $disposisiQuery->forRecipients(RoleAccess::teacherDisposisiRecipients($user));
        }

        $disposisiIds = $disposisiQuery->orderBy('id')->pluck('id')->map(fn ($id) => (int) $id)->all();

        return response()->json([
            'items' => [
                [
                    'key' => 'surat_masuk',
                    'label' => 'Surat masuk baru',
                    'ids' => $suratMasukIds,
                    'latest_id' => max($suratMasukIds ?: [0]),
                    'module' => 'Surat Masuk',
                ],
                [
                    'key' => 'disposisi',
                    'label' => 'Disposisi baru',
                    'ids' => $disposisiIds,
                    'latest_id' => max($disposisiIds ?: [0]),
                    'module' => 'Disposisi',
                ],
                [
                    'key' => 'surat_keluar',
                    'label' => 'Surat keluar baru',
                    'ids' => $suratKeluarIds,
                    'latest_id' => max($suratKeluarIds ?: [0]),
                    'module' => 'Surat Keluar',
                ],
            ],
        ])->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }
}
