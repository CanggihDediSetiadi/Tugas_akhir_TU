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
    public string $nomor_agenda = '';
    public string $asal_surat = '';
    public string $tanggal_surat = '';
    public string $tanggal_terima = '';
    public string $perihal = '';
    public string $sifat = 'Biasa';
    public string $tanggal_disposisi = '';
    public string $tanggal_penyelesaian = '';
    public array $instruksi_pilihan = [];
    public string $instruksi_lainnya = '';
    public array $penerima_pilihan = [];
    public string $penerima_lainnya = '';
    public string $paraf = '';
    public string $memo = '';
    public bool $showModalHapus = false;
    public ?int $hapusId = null;
    public string $hapusNomor = '';

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }
    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }

    public function mount(): void
    {
        $this->tanggal_disposisi = now()->format('Y-m-d');
    }

    public function simpanDisposisi(): void
    {
        abort_unless(RoleAccess::canCreateDisposisi(), 403);

        $this->validate([
            'surat_masuk_id' => 'required|exists:surat_masuk,id',
            'nomor_agenda' => 'required|string|max:100',
            'asal_surat' => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'tanggal_terima' => 'required|date',
            'perihal' => 'required|string|max:255',
            'sifat' => 'required|in:Biasa,Penting,Segera,Rahasia,Lain-lain',
            'tanggal_disposisi' => 'required|date',
            'tanggal_penyelesaian' => 'nullable|date|after_or_equal:tanggal_disposisi',
            'instruksi_pilihan' => 'array',
            'instruksi_pilihan.*' => 'string|max:100',
            'instruksi_lainnya' => 'nullable|string|max:500',
            'penerima_pilihan' => 'required_without:penerima_lainnya|array',
            'penerima_pilihan.*' => 'string|max:100',
            'penerima_lainnya' => 'nullable|string|max:255',
            'paraf' => 'nullable|string|max:1000',
            'memo' => 'nullable|string|max:3000',
        ], [
            'surat_masuk_id.required' => 'Pilih surat masuk terlebih dahulu.',
            'nomor_agenda.required' => 'No. agenda wajib diisi.',
            'asal_surat.required' => 'Asal surat wajib diisi.',
            'tanggal_surat.required' => 'Tanggal surat wajib diisi.',
            'tanggal_terima.required' => 'Tanggal terima wajib diisi.',
            'perihal.required' => 'Perihal wajib diisi.',
            'penerima_pilihan.required_without' => 'Pilih minimal satu penerima disposisi atau isi penerima lainnya.',
            'tanggal_disposisi.required' => 'Tanggal disposisi wajib diisi.',
            'tanggal_penyelesaian.after_or_equal' => 'Tanggal penyelesaian tidak boleh sebelum tanggal disposisi.',
        ]);

        $penerima = array_values(array_filter($this->penerima_pilihan));
        if (filled($this->penerima_lainnya)) $penerima[] = trim($this->penerima_lainnya);

        $instruksi = array_values(array_filter($this->instruksi_pilihan));
        if (filled($this->instruksi_lainnya)) $instruksi[] = trim($this->instruksi_lainnya);

        $diteruskanKe = implode(', ', $penerima);

        DisposisiModel::create([
            'surat_masuk_id' => $this->surat_masuk_id,
            'nomor_disposisi' => DisposisiModel::generateNomor(),
            'nomor_agenda' => $this->nomor_agenda,
            'asal_surat' => $this->asal_surat,
            'tanggal_surat' => $this->tanggal_surat,
            'tanggal_terima' => $this->tanggal_terima,
            'perihal' => $this->perihal,
            'diteruskan_ke' => $diteruskanKe,
            'sifat' => $this->sifat,
            'instruksi' => implode(', ', $instruksi),
            'tanggal_disposisi' => $this->tanggal_disposisi,
            'tanggal_penyelesaian' => $this->tanggal_penyelesaian ?: null,
            'instruksi_pilihan' => $instruksi,
            'penerima_pilihan' => $penerima,
            'paraf' => $this->paraf ?: null,
            'memo' => $this->memo ?: null,
            'status' => 'pending',
            'dibuat_oleh' => auth()->id(),
            'dikirim_at' => now(),
        ]);

        SuratMasuk::whereKey($this->surat_masuk_id)->update([
            'status' => 'sudah_disposisi',
            'tanggal_disposisi' => $this->tanggal_disposisi,
            'diteruskan_ke' => $diteruskanKe,
        ]);

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

    public function konfirmasiHapus(int $id): void
    {
        abort_unless(RoleAccess::canManageDisposisi(), 403);

        $disposisi = DisposisiModel::findOrFail($id);
        $this->hapusId = $disposisi->id;
        $this->hapusNomor = $disposisi->nomor_disposisi;
        $this->showModalHapus = true;
    }

    public function batalHapus(): void
    {
        $this->showModalHapus = false;
        $this->hapusId = null;
        $this->hapusNomor = '';
    }

    public function hapusDisposisi(): void
    {
        abort_unless(RoleAccess::canManageDisposisi(), 403);

        abort_if($this->hapusId === null, 404);

        DisposisiModel::findOrFail($this->hapusId)->delete();
        $this->batalHapus();
        session()->flash('sukses', 'Disposisi berhasil dihapus.');
        $this->js('window.location.reload()');
    }

    private function authorizeFollowUp(DisposisiModel $disposisi): void
    {
        abort_unless(RoleAccess::canFollowUpDisposisi(), 403);

        if (RoleAccess::isTeacher()) {
            $penerima = $disposisi->penerima_pilihan ?: [$disposisi->diteruskan_ke];
            abort_unless(array_intersect($penerima, RoleAccess::teacherDisposisiRecipients()), 403);
        }
    }

    public function resetForm(): void
    {
        $this->surat_masuk_id = '';
        $this->nomor_agenda = '';
        $this->asal_surat = '';
        $this->tanggal_surat = '';
        $this->tanggal_terima = '';
        $this->perihal = '';
        $this->sifat = 'Biasa';
        $this->tanggal_disposisi = now()->format('Y-m-d');
        $this->tanggal_penyelesaian = '';
        $this->instruksi_pilihan = [];
        $this->instruksi_lainnya = '';
        $this->penerima_pilihan = [];
        $this->penerima_lainnya = '';
        $this->paraf = '';
        $this->memo = '';
    }
}
