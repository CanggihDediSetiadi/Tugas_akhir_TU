<?php

namespace App\Filament\Pages;

use App\Models\SuratKeluar as SuratKeluarModel;
use Filament\Pages\Page;
use App\Support\RoleAccess;

class SuratKeluar extends Page
{
    public static function canAccess(): bool
    {
        return RoleAccess::canViewOutgoing();
    }

    protected string $view = 'filament.pages.surat-keluar';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-paper-airplane';
    protected static ?string $navigationLabel = 'Surat Keluar';
    protected static ?int $navigationSort = 3;
    protected static ?string $title = 'Surat Keluar';
    protected static bool $shouldRegisterNavigation = false;

    public bool $showModalDetail = false;
    public bool $showModalEdit = false;
    public bool $showModalHapus = false;

    public ?int $editId = null;
    public ?int $hapusId = null;
    public ?array $detailData = null;

    public string $nomor_surat = '';
    public string $tanggal_surat = '';
    public string $tujuan = '';
    public string $perihal = '';
    public string $isi_surat = '';
    public string $kategori = 'Biasa';
    public string $status = 'draft';

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }
    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }

    public function lihatDetail(int $id): void
    {
        $surat = SuratKeluarModel::findOrFail($id);
        $this->detailData = [
            'nomor_surat' => $surat->nomor_surat,
            'tanggal_surat' => $surat->tanggal_surat?->format('d M Y'),
            'tujuan' => $surat->tujuan,
            'perihal' => $surat->perihal,
            'kategori' => $surat->kategori,
            'status' => $surat->status_label,
            'isi_surat' => $surat->isi_surat ?: '-',
            'dibuat' => $surat->created_at?->format('d M Y H:i'),
        ];
        $this->showModalDetail = true;
    }

    public function editSuratKeluar(int $id): void
    {
        $surat = SuratKeluarModel::findOrFail($id);
        $this->editId = $id;
        $this->nomor_surat = $surat->nomor_surat;
        $this->tanggal_surat = $surat->tanggal_surat?->format('Y-m-d') ?? now()->format('Y-m-d');
        $this->tujuan = $surat->tujuan;
        $this->perihal = $surat->perihal;
        $this->isi_surat = $surat->isi_surat ?? '';
        $this->kategori = $surat->kategori ?? 'Biasa';
        $this->status = $surat->status ?? 'draft';
        $this->showModalEdit = true;
    }

    public function updateSuratKeluar(): void
    {
        $this->validate([
            'nomor_surat' => 'required|string|max:100|unique:surat_keluar,nomor_surat,' . $this->editId,
            'tanggal_surat' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'perihal' => 'required|string|max:255',
            'kategori' => 'required|string|max:50',
            'status' => 'required|string|max:50',
        ]);

        $surat = SuratKeluarModel::findOrFail($this->editId);
        $surat->update([
            'nomor_surat' => $this->nomor_surat,
            'tanggal_surat' => $this->tanggal_surat,
            'tujuan' => $this->tujuan,
            'perihal' => $this->perihal,
            'isi_surat' => $this->isi_surat,
            'kategori' => $this->kategori,
            'status' => $this->status,
            'diajukan_at' => $this->status === 'menunggu_persetujuan' ? ($surat->diajukan_at ?? now()) : $surat->diajukan_at,
            'disetujui_at' => in_array($this->status, ['disetujui', 'dikirim'], true) ? ($surat->disetujui_at ?? now()) : $surat->disetujui_at,
        ]);

        $this->resetForm();
        $this->showModalEdit = false;
        session()->flash('sukses', 'Surat keluar berhasil diperbarui.');
        $this->js('window.location.reload()');
    }

    public function setujuiSurat(int $id): void
    {
        SuratKeluarModel::findOrFail($id)->update([
            'status' => 'disetujui',
            'disetujui_at' => now(),
        ]);
        session()->flash('sukses', 'Surat keluar berhasil disetujui.');
        $this->js('window.location.reload()');
    }

    public function tandaiDikirim(int $id): void
    {
        SuratKeluarModel::findOrFail($id)->update([
            'status' => 'dikirim',
            'disetujui_at' => now(),
        ]);
        session()->flash('sukses', 'Surat keluar berhasil ditandai terkirim.');
        $this->js('window.location.reload()');
    }

    public function konfirmasiHapus(int $id): void
    {
        $this->hapusId = $id;
        $this->showModalHapus = true;
    }

    public function hapusSuratKeluar(): void
    {
        SuratKeluarModel::findOrFail($this->hapusId)->delete();
        $this->hapusId = null;
        $this->showModalHapus = false;
        session()->flash('sukses', 'Surat keluar berhasil dihapus.');
        $this->js('window.location.reload()');
    }

    private function resetForm(): void
    {
        $this->editId = null;
        $this->nomor_surat = '';
        $this->tanggal_surat = '';
        $this->tujuan = '';
        $this->perihal = '';
        $this->isi_surat = '';
        $this->kategori = 'Biasa';
        $this->status = 'draft';
    }
}