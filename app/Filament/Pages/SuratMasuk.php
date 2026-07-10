<?php

namespace App\Filament\Pages;

use App\Models\SuratMasuk as SuratMasukModel;
use Filament\Pages\Page;
use App\Support\RoleAccess;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class SuratMasuk extends Page
{
    public static function canAccess(): bool
    {
        return RoleAccess::canViewIncoming();
    }

    use WithFileUploads;

    protected string $view = 'filament.pages.surat-masuk';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Surat Masuk';
    protected static ?int $navigationSort = 2;
    protected static ?string $title = 'Surat Masuk';
    protected static bool $shouldRegisterNavigation = false;

    public bool $showModalTambah = false;
    public bool $showModalEdit = false;
    public bool $showModalDetail = false;
    public bool $showModalHapus = false;

    public string $nomor_surat = '';
    public string $tanggal_terima = '';
    public string $asal_surat = '';
    public string $perihal = '';
    public string $klasifikasi = 'Biasa';
    public string $status = 'belum_disposisi';
    public string $keterangan = '';

    /** @var array<int, TemporaryUploadedFile>|TemporaryUploadedFile|null */
    public $lampiranFiles = [];

    public ?int $editId = null;
    public ?int $hapusId = null;
    public ?array $detailData = null;

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }
    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }

    public function simpanSuratMasuk(): void
    {
        $this->validate($this->rules(), $this->messages());
        SuratMasukModel::create($this->payload());
        $this->resetForm();
        $this->showModalTambah = false;
        session()->flash('sukses', 'Surat masuk berhasil ditambahkan.');
        $this->js('window.location.reload()');
    }

    public function editSuratMasuk(int $id): void
    {
        $surat = SuratMasukModel::findOrFail($id);
        $this->editId = $id;
        $this->nomor_surat = $surat->nomor_surat;
        $this->tanggal_terima = $surat->tanggal_terima?->format('Y-m-d') ?? '';
        $this->asal_surat = $surat->asal_surat;
        $this->perihal = $surat->perihal;
        $this->klasifikasi = $surat->klasifikasi ?? 'Biasa';
        $this->status = $surat->status;
        $this->keterangan = $surat->keterangan ?? '';
        $this->lampiranFiles = [];
        $this->showModalEdit = true;
    }

    public function updateSuratMasuk(): void
    {
        $this->validate($this->rules(), $this->messages());
        $surat = SuratMasukModel::findOrFail($this->editId);
        $payload = $this->payload($surat->lampiran ?? []);
        $surat->update($payload);
        $this->resetForm();
        $this->showModalEdit = false;
        session()->flash('sukses', 'Surat masuk berhasil diperbarui.');
        $this->js('window.location.reload()');
    }

    public function lihatDetail(int $id): void
    {
        $surat = SuratMasukModel::findOrFail($id);
        $lampiran = collect($surat->lampiran ?? [])->map(fn ($file) => ($file['name'] ?? 'Lampiran') . ' (' . ($file['path'] ?? '-') . ')')->implode(', ');
        $this->detailData = [
            'id' => $surat->id,
            'nomor_surat' => $surat->nomor_surat,
            'tanggal_terima' => $surat->tanggal_terima?->format('d M Y'),
            'asal_surat' => $surat->asal_surat,
            'perihal' => $surat->perihal,
            'klasifikasi' => $surat->klasifikasi ?? 'Biasa',
            'status' => $surat->status_label,
            'keterangan' => $surat->keterangan ?? '-',
            'lampiran' => $lampiran ?: '-',
            'dibuat' => $surat->created_at->format('d M Y H:i'),
        ];
        $this->showModalDetail = true;
    }

    public function konfirmasiHapus(int $id): void
    {
        $this->hapusId = $id;
        $this->showModalHapus = true;
    }

    public function hapusSuratMasuk(): void
    {
        $surat = SuratMasukModel::findOrFail($this->hapusId);
        foreach ($surat->lampiran ?? [] as $file) {
            if (! empty($file['path'])) Storage::disk('public')->delete($file['path']);
        }
        $surat->delete();
        $this->hapusId = null;
        $this->showModalHapus = false;
        session()->flash('sukses', 'Surat masuk berhasil dihapus.');
        $this->js('window.location.reload()');
    }

    private function rules(): array
    {
        return [
            'nomor_surat' => 'required|string|max:100',
            'tanggal_terima' => 'required|date',
            'asal_surat' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'lampiranFiles.*' => 'nullable|file|max:10240',
        ];
    }

    private function messages(): array
    {
        return [
            'nomor_surat.required' => 'Nomor surat wajib diisi.',
            'tanggal_terima.required' => 'Tanggal terima wajib diisi.',
            'asal_surat.required' => 'Asal surat wajib diisi.',
            'perihal.required' => 'Perihal wajib diisi.',
            'lampiranFiles.*.max' => 'Lampiran maksimal 10 MB per file.',
        ];
    }

    private function payload(array $existingLampiran = []): array
    {
        return [
            'nomor_surat' => $this->nomor_surat,
            'tanggal_terima' => $this->tanggal_terima,
            'asal_surat' => $this->asal_surat,
            'perihal' => $this->perihal,
            'klasifikasi' => $this->klasifikasi,
            'status' => $this->status,
            'keterangan' => $this->keterangan,
            'lampiran' => array_values(array_merge($existingLampiran, $this->storeLampiran('surat-masuk'))),
            'diterima_oleh' => auth()->id(),
        ];
    }

    private function storeLampiran(string $folder): array
    {
        $files = is_array($this->lampiranFiles) ? $this->lampiranFiles : ($this->lampiranFiles ? [$this->lampiranFiles] : []);
        $stored = [];
        foreach ($files as $file) {
            if (! $file instanceof TemporaryUploadedFile) continue;
            $stored[] = [
                'name' => $file->getClientOriginalName(),
                'path' => $file->store($folder, 'public'),
                'size' => $file->getSize(),
                'type' => $file->getMimeType(),
            ];
        }
        return $stored;
    }

    private function resetForm(): void
    {
        $this->nomor_surat = '';
        $this->tanggal_terima = '';
        $this->asal_surat = '';
        $this->perihal = '';
        $this->klasifikasi = 'Biasa';
        $this->status = 'belum_disposisi';
        $this->keterangan = '';
        $this->lampiranFiles = [];
        $this->editId = null;
    }
}