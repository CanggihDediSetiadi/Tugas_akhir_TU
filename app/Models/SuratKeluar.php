<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratKeluar extends Model
{
    protected $table = 'surat_keluar';

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tujuan',
        'perihal',
        'isi_surat',
        'status',
        'kategori',
        'lampiran',
        'dibuat_oleh',
        'diajukan_at',
        'disetujui_at',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'lampiran'      => 'array',
        'diajukan_at'   => 'datetime',
        'disetujui_at'  => 'datetime',
    ];

    public function pembuatSurat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'draft'                 => 'Draft',
            'menunggu_persetujuan'  => 'Menunggu Persetujuan',
            'disetujui'             => 'Disetujui',
            'dikirim'               => 'Dikirim',
            default                 => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'draft'                 => 'yellow',
            'menunggu_persetujuan'  => 'blue',
            'disetujui'             => 'green',
            'dikirim'               => 'green',
            default                 => 'gray',
        };
    }

    /**
     * Generate next letter number automatically.
     * Format: SMK/TU/YYYY/Bulan(Roman)/NNNN
     */
    public static function generateNomorSurat(): string
    {
        $year  = now()->year;
        $month = now()->month;
        $roman = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'][$month - 1];

        $last = static::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        $seq = str_pad($last + 1, 4, '0', STR_PAD_LEFT);

        return "SMK/TU/{$year}/{$roman}/{$seq}";
    }
}
