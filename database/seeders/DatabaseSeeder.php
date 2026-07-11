<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create or update the admin user so login is always available.
        User::updateOrCreate([
            'email' => 'admin@siatu.sch.id',
        ], [
            'name' => 'Admin TU',
            'email' => 'admin@siatu.sch.id',
            'password' => Hash::make('sman4sby2025'),
            'role' => 'Admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
}
