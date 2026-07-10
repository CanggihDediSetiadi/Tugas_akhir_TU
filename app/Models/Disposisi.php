<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disposisi extends Model
{
    protected $table = 'disposisi';

    protected $fillable = [
        'surat_masuk_id',
        'nomor_disposisi',
        'diteruskan_ke',
        'sifat',
        'instruksi',
        'status',
        'dibuat_oleh',
        'dikirim_at',
        'selesai_at',
    ];

    protected $casts = [
        'dikirim_at' => 'datetime',
        'selesai_at' => 'datetime',
    ];

    public function suratMasuk(): BelongsTo
    {
        return $this->belongsTo(SuratMasuk::class, 'surat_masuk_id');
    }

    public function pembuat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'   => 'Pending',
            'diproses'  => 'Diproses',
            'selesai'   => 'Selesai',
            default     => ucfirst($this->status),
        };
    }

    public function getSifatLabelAttribute(): string
    {
        return match ($this->sifat) {
            'sangat_segera' => 'Sangat Segera',
            'segera'        => 'Segera',
            default         => ucfirst($this->sifat),
        };
    }

    /**
     * Auto-generate nomor disposisi.
     * Format: DISP/SMAN4/YYYY/Bulan(Roman)/NNNN
     */
    public static function generateNomor(): string
    {
        $year  = now()->year;
        $month = now()->month;
        $roman = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'][$month - 1];
        $last  = static::whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
        $seq   = str_pad($last + 1, 4, '0', STR_PAD_LEFT);
        return "DISP/SMAN4/{$year}/{$roman}/{$seq}";
    }
}
