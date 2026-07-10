<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'nip',
        'jabatan',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at'     => 'datetime',
            'password'          => 'hashed',
        ];
    }

    /** Generate inisial dari nama untuk avatar */
    public function getInitialsAttribute(): string
    {
        $parts = explode(' ', trim($this->name));
        $initials = strtoupper(substr($parts[0], 0, 1));
        if (count($parts) > 1) {
            $initials .= strtoupper(substr(end($parts), 0, 1));
        }
        return $initials;
    }

    /** Warna avatar berdasarkan role */
    public function getAvatarColorAttribute(): string
    {
        return match ($this->role) {
            'Admin'          => 'background:#dbeafe;color:#1e40af',
            'Kepala Sekolah' => 'background:#f3e8ff;color:#7e22ce',
            'Wakasek'        => 'background:#dcfce7;color:#166534',
            'Bendahara'      => 'background:#fee2e2;color:#991b1b',
            'Guru'           => 'background:#e0f2fe;color:#075985',
            default          => 'background:#f1f5f9;color:#475569',
        };
    }

    /** Warna badge role */
    public function getRoleBadgeAttribute(): string
    {
        return match ($this->role) {
            'Admin'          => 'background:#dbeafe;color:#1e40af;border:1px solid #bfdbfe',
            'Kepala Sekolah' => 'background:#f3e8ff;color:#7e22ce;border:1px solid #e9d5ff',
            'Wakasek'        => 'background:#dcfce7;color:#166534;border:1px solid #86efac',
            'Bendahara'      => 'background:#fee2e2;color:#991b1b;border:1px solid #fca5a5',
            'Guru'           => 'background:#e0f2fe;color:#075985;border:1px solid #7dd3fc',
            default          => 'background:#f1f5f9;color:#475569;border:1px solid #e2e8f0',
        };
    }
}
