<?php

namespace App\Filament\Pages;

use App\Models\Disposisi as DisposisiModel;
use App\Models\SuratMasuk;
use App\Support\RoleAccess;
use Filament\Pages\Page;

class Disposisi extends Page
{
    public static function canAccess(): bool
    {
        return RoleAccess::canUseDisposisi();
    }

    protected string $view = 'filament.pages.disposisi';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Disposisi';
    protected static ?int $navigationSort = 4;
    protected static ?string $title = 'Disposisi';
    protected static bool $shouldRegisterNavigation = false;

    public string $surat_masuk_id = '';
    public string $diteruskan_ke = '';
    public string $sifat = 'segera';
    public string $instruksi = '';

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }
    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }

    public function simpanDisposisi(): void
    {
        abort_unless(RoleAccess::canCreateDisposisi(), 403);

        $this->validate([
            'surat_masuk_id' => 'required|exists:surat_masuk,id',
            'diteruskan_ke' => 'required|string|max:255',
            'sifat' => 'required|in:segera,sangat_segera',
            'instruksi' => 'nullable|string|max:2000',
        ], [
            'surat_masuk_id.required' => 'Pilih surat masuk terlebih dahulu.',
            'diteruskan_ke.required' => 'Pilih tujuan disposisi terlebih dahulu.',
        ]);

        DisposisiModel::create([
            'surat_masuk_id' => $this->surat_masuk_id,
            'nomor_disposisi' => DisposisiModel::generateNomor(),
            'diteruskan_ke' => $this->diteruskan_ke,
            'sifat' => $this->sifat,
            'instruksi' => $this->instruksi,
            'status' => 'pending',
            'dibuat_oleh' => auth()->id(),
            'dikirim_at' => now(),
        ]);

        SuratMasuk::whereKey($this->surat_masuk_id)->update(['status' => 'sudah_disposisi']);

        $this->resetForm();
        session()->flash('sukses', 'Disposisi berhasil dibuat.');
        $this->js("setTimeout(() => window.location.reload(), 300)");
    }

    public function tandaiDiproses(int $id): void
    {
        $disposisi = DisposisiModel::findOrFail($id);
        $this->authorizeFollowUp($disposisi);

        $disposisi->update(['status' => 'diproses']);
        session()->flash('sukses', 'Disposisi ditandai sedang diproses.');
        $this->js('window.location.reload()');
    }

    public function tandaiSelesai(int $id): void
    {
        $disposisi = DisposisiModel::findOrFail($id);
        $this->authorizeFollowUp($disposisi);

        $disposisi->update(['status' => 'selesai', 'selesai_at' => now()]);
        if ($disposisi->surat_masuk_id) {
            SuratMasuk::whereKey($disposisi->surat_masuk_id)->update(['status' => 'selesai']);
        }
        session()->flash('sukses', 'Disposisi berhasil diselesaikan.');
        $this->js('window.location.reload()');
    }

    public function hapusDisposisi(int $id): void
    {
        abort_unless(RoleAccess::canManageDisposisi(), 403);

        DisposisiModel::findOrFail($id)->delete();
        session()->flash('sukses', 'Disposisi berhasil dihapus.');
        $this->js('window.location.reload()');
    }

    private function authorizeFollowUp(DisposisiModel $disposisi): void
    {
        abort_unless(RoleAccess::canFollowUpDisposisi(), 403);

        if (RoleAccess::isTeacher()) {
            abort_unless(in_array($disposisi->diteruskan_ke, RoleAccess::teacherDisposisiRecipients(), true), 403);
        }
    }

    private function resetForm(): void
    {
        $this->surat_masuk_id = '';
        $this->diteruskan_ke = '';
        $this->sifat = 'segera';
        $this->instruksi = '';
    }
}
