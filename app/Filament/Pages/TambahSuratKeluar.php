<?php

namespace App\Filament\Pages;

use App\Models\SuratKeluar as SuratKeluarModel;
use Filament\Pages\Page;
use App\Support\RoleAccess;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class TambahSuratKeluar extends Page
{
    public static function canAccess(): bool
    {
        return RoleAccess::canManageOutgoing();
    }

    use WithFileUploads;

    protected string $view = 'filament.pages.tambah-surat-keluar';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-plus-circle';
    protected static ?string $navigationLabel = 'Buat Surat Keluar';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $title = 'Tambah Surat Keluar';

    public string $nomor_surat = '';
    public string $tanggal_surat = '';
    public string $tujuan = '';
    public string $perihal = '';
    public string $isi_surat = '';
    public string $kategori = 'Biasa';
    public string $status_action = 'draft';

    /** @var array<int, TemporaryUploadedFile>|TemporaryUploadedFile|null */
    public $lampiranFiles = [];

    public function mount(): void
    {
        $this->nomor_surat = SuratKeluarModel::generateNomorSurat();
        $this->tanggal_surat = now()->format('Y-m-d');
    }

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }
    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }

    public function simpanDraft(): void
    {
        $this->validate($this->rules(false), $this->messages());
        SuratKeluarModel::create($this->payload('draft'));
        session()->flash('sukses', 'Draft surat berhasil disimpan.');
        $this->redirect(SuratKeluar::getUrl());
    }

    public function ajukanPersetujuan(): void
    {
        $this->validate($this->rules(true), $this->messages());
        SuratKeluarModel::create($this->payload('menunggu_persetujuan') + ['diajukan_at' => now()]);
        session()->flash('sukses', 'Surat berhasil diajukan untuk persetujuan.');
        $this->redirect(SuratKeluar::getUrl());
    }

    private function rules(bool $requireIsi): array
    {
        $rules = [
            'tanggal_surat' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'lampiranFiles.*' => 'nullable|file|max:10240',
        ];
        if ($requireIsi) $rules['isi_surat'] = 'required|string|min:10';
        return $rules;
    }

    private function messages(): array
    {
        return [
            'tujuan.required' => 'Tujuan surat wajib diisi.',
            'perihal.required' => 'Perihal surat wajib diisi.',
            'isi_surat.required' => 'Isi surat wajib diisi sebelum diajukan.',
            'isi_surat.min' => 'Isi surat terlalu singkat.',
            'lampiranFiles.*.max' => 'Lampiran maksimal 10 MB per file.',
        ];
    }

    private function payload(string $status): array
    {
        return [
            'nomor_surat' => $this->nomor_surat,
            'tanggal_surat' => $this->tanggal_surat,
            'tujuan' => $this->tujuan,
            'perihal' => $this->perihal,
            'isi_surat' => $this->isi_surat,
            'kategori' => $this->kategori,
            'status' => $status,
            'lampiran' => $this->storeLampiran(),
            'dibuat_oleh' => auth()->id(),
        ];
    }

    private function storeLampiran(): array
    {
        $files = is_array($this->lampiranFiles) ? $this->lampiranFiles : ($this->lampiranFiles ? [$this->lampiranFiles] : []);
        $stored = [];
        foreach ($files as $file) {
            if (! $file instanceof TemporaryUploadedFile) continue;
            $stored[] = [
                'name' => $file->getClientOriginalName(),
                'path' => $file->store('surat-keluar', 'public'),
                'size' => $file->getSize(),
                'type' => $file->getMimeType(),
            ];
        }
        return $stored;
    }
}