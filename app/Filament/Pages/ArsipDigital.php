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
                'diunggah_oleh' => auth()->id(),
            ]);
        }

        $this->resetForm();
        session()->flash('sukses', 'Dokumen berhasil diunggah ke arsip digital.');
        $this->js('window.location.reload()');
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
            'diunggah_oleh' => auth()->id(),
        ]);

        $this->resetForm();
        session()->flash('sukses', 'Folder arsip berhasil dibuat.');
        $this->js('window.location.reload()');
    }

    public function hapusArsip(int $id): void
    {
        $arsip = ArsipDigitalModel::findOrFail($id);
        if ($arsip->path_file) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($arsip->path_file);
        }
        $arsip->delete();
        session()->flash('sukses', 'Arsip berhasil dihapus.');
        $this->js('window.location.reload()');
    }

    private function resetForm(): void
    {
        $this->reset(['arsipFiles', 'nama_dokumen', 'tahun', 'keterangan']);
        $this->kategori = 'Umum';
        $this->klasifikasi = 'Biasa';
    }
}