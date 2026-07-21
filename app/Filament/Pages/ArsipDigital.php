<?php

namespace App\Filament\Pages;

use App\Models\ArsipDigital as ArsipDigitalModel;
use Filament\Pages\Page;
use App\Support\RoleAccess;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ArsipDigital extends Page
{
    public static function canAccess(): bool
    {
        return RoleAccess::canViewArsip();
    }

    use WithFileUploads;

    protected string $view = 'filament.pages.arsip-digital';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationLabel = 'Arsip Digital';
    protected static ?int $navigationSort = 6;
    protected static ?string $title = 'Arsip Digital';
    protected static bool $shouldRegisterNavigation = false;

    /** @var array<int, TemporaryUploadedFile>|TemporaryUploadedFile|null */
    public $arsipFiles = [];

    public string $nama_dokumen = '';
    public string $tahun = '';
    public string $kategori = 'Umum';
    public string $klasifikasi = 'Biasa';
    public string $keterangan = '';
    public ?int $currentFolderId = null;
    public bool $modalUnggahTerbuka = false;

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }
    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }

    public function unggahDokumen(): void
    {
        $this->validate([
            'nama_dokumen' => 'required|string|max:255',
            'tahun' => 'nullable|integer|min:2000|max:2099',
            'kategori' => 'required|string|max:100',
            'klasifikasi' => 'required|string|max:100',
            'arsipFiles' => 'required',
            'arsipFiles.*' => 'file|max:51200',
        ], [
            'nama_dokumen.required' => 'Nama dokumen wajib diisi.',
            'arsipFiles.required' => 'Pilih minimal satu file untuk diunggah.',
            'arsipFiles.*.max' => 'Ukuran file maksimal 50 MB.',
        ]);

        $files = is_array($this->arsipFiles) ? $this->arsipFiles : [$this->arsipFiles];

        foreach ($files as $index => $file) {
            if (! $file instanceof TemporaryUploadedFile) {
                continue;
            }

            $storedPath = $file->store('arsip-digital', 'public');
            $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'file');
            $name = count($files) > 1
                ? $this->nama_dokumen . ' - ' . ($index + 1)
                : $this->nama_dokumen;

            ArsipDigitalModel::create([
                'nama_dokumen' => $name,
                'tipe' => 'file',
                'format' => $extension,
                'kategori' => $this->kategori,
                'klasifikasi' => $this->klasifikasi,
                'status' => 'tervalidasi',
                'tahun' => $this->tahun !== '' ? (int) $this->tahun : now()->year,
                'ukuran_bytes' => $file->getSize() ?: 0,
                'path_file' => $storedPath,
                'keterangan' => $this->keterangan,
                'parent_id' => $this->currentFolderId,
                'diunggah_oleh' => auth()->id(),
            ]);
        }

        $this->resetForm();
        $this->modalUnggahTerbuka = false;
        session()->flash('sukses', 'Dokumen berhasil diunggah ke arsip digital.');
        $this->js("const fileList = document.getElementById('adFileList'); if (fileList) fileList.style.display='none';");
    }

    public function bukaModalUnggah(): void
    {
        $this->modalUnggahTerbuka = true;
    }

    public function tutupModalUnggah(): void
    {
        $this->modalUnggahTerbuka = false;
        $this->resetForm();
        $this->js("const fileList = document.getElementById('adFileList'); if (fileList) fileList.style.display='none';");
    }

    public function buatFolder(): void
    {
        $this->validate([
            'nama_dokumen' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'klasifikasi' => 'required|string|max:100',
            'keterangan' => 'nullable|string|max:2000',
        ], [
            'nama_dokumen.required' => 'Nama folder wajib diisi.',
        ]);

        ArsipDigitalModel::create([
            'nama_dokumen' => $this->nama_dokumen,
            'tipe' => 'folder',
            'format' => null,
            'kategori' => $this->kategori,
            'klasifikasi' => $this->klasifikasi,
            'status' => 'tervalidasi',
            'tahun' => now()->year,
            'ukuran_bytes' => 0,
            'keterangan' => $this->keterangan,
            'parent_id' => $this->currentFolderId,
            'diunggah_oleh' => auth()->id(),
        ]);

        $this->resetForm();
        session()->flash('sukses', 'Folder arsip berhasil dibuat.');
        $this->js("document.getElementById('modalBuatFolder').style.display='none';");
    }

    public function bukaFolder(int $id): void
    {
        $folder = ArsipDigitalModel::where('tipe', 'folder')->findOrFail($id);
        $this->currentFolderId = $folder->id;
    }

    public function bukaRoot(): void
    {
        $this->currentFolderId = null;
    }

    public function bukaParent(): void
    {
        $folder = $this->currentFolderId
            ? ArsipDigitalModel::where('tipe', 'folder')->find($this->currentFolderId)
            : null;

        $this->currentFolderId = $folder?->parent_id;
    }

    public function hapusArsip(int $id): void
    {
        $arsip = ArsipDigitalModel::findOrFail($id);
        if ($arsip->tipe === 'folder') {
            $this->hapusChildren($arsip);
        }

        if ($arsip->path_file) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($arsip->path_file);
        }

        if ($this->currentFolderId === $arsip->id) {
            $this->currentFolderId = $arsip->parent_id;
        }

        $arsip->delete();
        session()->flash('sukses', 'Arsip berhasil dihapus.');
    }

    private function resetForm(): void
    {
        $this->reset(['arsipFiles', 'nama_dokumen', 'tahun', 'keterangan']);
        $this->kategori = 'Umum';
        $this->klasifikasi = 'Biasa';
    }

    private function hapusChildren(ArsipDigitalModel $folder): void
    {
        foreach ($folder->children as $child) {
            if ($child->tipe === 'folder') {
                $this->hapusChildren($child);
            }

            if ($child->path_file) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($child->path_file);
            }

            $child->delete();
        }
    }
}
