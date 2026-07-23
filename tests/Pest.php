<?php

use App\Models\SuratMasuk;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class)->in('Feature');

function makeFeatureUser(string $role = 'Admin', array $overrides = []): User
{
    return User::factory()->create(array_merge([
        'name' => "{$role} SIATU",
        'email' => fake()->unique()->safeEmail(),
        'password' => Hash::make('password'),
        'role' => $role,
        'status' => 'active',
    ], $overrides));
}

function makeIncomingLetter(array $overrides = []): SuratMasuk
{
    return SuratMasuk::create(array_merge([
        'no_urut_masuk' => '001',
        'nomor_surat' => 'SM/001/VII/2026',
        'tanggal_surat' => '2026-07-01',
        'tanggal_terima' => '2026-07-02',
        'asal_surat' => 'Dinas Pendidikan',
        'perihal' => 'Undangan koordinasi sekolah',
        'klasifikasi' => 'Biasa',
        'status' => 'belum_disposisi',
    ], $overrides));
}
