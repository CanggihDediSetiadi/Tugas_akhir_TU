<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratMasuk extends Model
{
    protected $table = 'surat_masuk';

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'tanggal_terima',
        'asal_surat',
        'perihal',
        'isi_surat',
        'klasifikasi',
        'status',
        'lampiran',
        'keterangan',
        'diterima_oleh',
    ];

    protected $casts = [
        'tanggal_surat'  => 'date',
        'tanggal_terima' => 'date',
        'lampiran'       => 'array',
    ];

    public function penerimaSurat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'diterima_oleh');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'belum_disposisi' => 'Belum Disposisi',
            'sudah_disposisi' => 'Sudah Disposisi',
            'selesai'         => 'Selesai',
            default           => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'belum_disposisi' => 'yellow',
            'sudah_disposisi' => 'blue',
            'selesai'         => 'green',
            default           => 'gray',
        };
    }

    public function getKlasifikasiColorAttribute(): string
    {
        return match ($this->klasifikasi) {
            'Penting'  => 'red',
            'Rahasia'  => 'dark',
            default    => 'blue',
        };
    }

    /**
     * Generate next agenda number automatically.
     * Format: SM/SMAN4/YYYY/Bulan(Roman)/NNNN
     */
    public static function generateNomorAgenda(): string
    {
        $year  = now()->year;
        $month = now()->month;
        $roman = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'][$month - 1];

        $last = static::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        $seq = str_pad($last + 1, 4, '0', STR_PAD_LEFT);

        return "SM/SMAN4/{$year}/{$roman}/{$seq}";
    }
}
