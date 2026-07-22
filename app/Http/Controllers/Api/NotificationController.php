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

        $isRecipient = RoleAccess::isDisposisiRecipient($user);
        $suratMasukIds = $isRecipient ? [] : SuratMasuk::query()->orderBy('id')->pluck('id')->map(fn ($id) => (int) $id)->all();
        $suratKeluarIds = $isRecipient ? [] : SuratKeluar::query()->orderBy('id')->pluck('id')->map(fn ($id) => (int) $id)->all();

        $disposisiQuery = Disposisi::query();

        if ($isRecipient) {
            $disposisiQuery->forRecipients(RoleAccess::disposisiRecipients($user));
        }

        $disposisiIds = $disposisiQuery->orderBy('id')->pluck('id')->map(fn ($id) => (int) $id)->all();

        $items = [
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
        ];

        if ($isRecipient) {
            $items = array_values(array_filter($items, fn (array $item) => $item['key'] === 'disposisi'));
        }

        return response()->json(['items' => $items])
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate');
    }
}
