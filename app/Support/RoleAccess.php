<?php

namespace App\Support;

use App\Models\User;

class RoleAccess
{
    public static function role(?User $user = null): string
    {
        $role = trim((string) (($user ?? auth()->user())?->role ?? ''));
        return $role === '' ? 'Guru' : $role;
    }

    public static function normalizedRole(?User $user = null): string
    {
        $role = strtolower(self::role($user));
        $role = str_replace(['_', '-'], ' ', $role);
        $role = preg_replace('/\s+/', ' ', $role) ?: '';

        return trim($role);
    }

    public static function isStaff(?User $user = null): bool
    {
        return in_array(self::normalizedRole($user), [
            'admin',
            'staf tu',
            'staff tu',
            'staf tata usaha',
            'staff tata usaha',
            'tata usaha',
        ], true);
    }

    public static function isHead(?User $user = null): bool
    {
        return in_array(self::normalizedRole($user), [
            'kepala sekolah',
            'kepsek',
            'kepala',
        ], true);
    }

    public static function isTeacher(?User $user = null): bool
    {
        return self::normalizedRole($user) === 'guru';
    }

    public static function canViewDashboard(): bool { return auth()->check(); }
    public static function canViewIncoming(): bool { return self::isStaff() || self::isHead(); }
    public static function canManageIncoming(): bool { return self::isStaff(); }
    public static function canViewOutgoing(): bool { return self::isStaff() || self::isHead(); }
    public static function canManageOutgoing(): bool { return self::isStaff(); }
    public static function canApproveOutgoing(): bool { return self::isStaff() || self::isHead(); }
    public static function canUseDisposisi(): bool { return self::isStaff() || self::isHead() || self::isTeacher(); }
    public static function canCreateDisposisi(): bool { return self::isStaff() || self::isHead(); }
    public static function canManageDisposisi(): bool { return self::isStaff(); }
    public static function canFollowUpDisposisi(): bool { return self::isStaff() || self::isTeacher(); }
    public static function canViewArsip(): bool { return self::isStaff() || self::isHead(); }
    public static function canManageArsip(): bool { return self::isStaff(); }
    public static function canManageUsers(): bool { return self::isStaff(); }
    public static function canPrintReports(): bool { return self::isStaff() || self::isHead(); }
    public static function canViewAuditLog(): bool { return self::isStaff() || self::isHead(); }

    public static function teacherDisposisiRecipients(?User $user = null): array
    {
        $user ??= auth()->user();

        return array_values(array_filter(array_unique([
            'Guru',
            $user?->name,
            $user?->jabatan,
            $user?->role,
        ])));
    }
}
