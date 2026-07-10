<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArsipDigital extends Model
{
    protected $table = 'arsip_digital';

    protected $fillable = [
        'nama_dokumen',
        'tipe',
        'format',
        'kategori',
        'klasifikasi',
        'status',
        'tahun',
        'ukuran_bytes',
        'path_file',
        'thumbnail',
        'keterangan',
        'parent_id',
        'diunggah_oleh',
    ];

    protected $casts = [
        'tahun'        => 'integer',
        'ukuran_bytes' => 'integer',
    ];

    // Relasi ke folder parent
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ArsipDigital::class, 'parent_id');
    }

    // Relasi ke children (jika ini adalah folder)
    public function children(): HasMany
    {
        return $this->hasMany(ArsipDigital::class, 'parent_id');
    }

    // Relasi ke user yang mengunggah
    public function diunggahOleh(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'diunggah_oleh');
    }

    // Format ukuran file
    public function getUkuranFormatAttribute(): string
    {
        $bytes = $this->ukuran_bytes;
        if ($bytes === 0) return '-';
        if ($bytes < 1024) return $bytes . ' B';
        if ($bytes < 1024 * 1024) return round($bytes / 1024, 1) . ' KB';
        if ($bytes < 1024 * 1024 * 1024) return round($bytes / (1024 * 1024), 1) . ' MB';
        return round($bytes / (1024 * 1024 * 1024), 1) . ' GB';
    }

    // Scope untuk folder
    public function scopeFolders($query)
    {
        return $query->where('tipe', 'folder');
    }

    // Scope untuk file
    public function scopeFiles($query)
    {
        return $query->where('tipe', 'file');
    }
}
