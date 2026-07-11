<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Auth\Pages\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_to_filament_dashboard(): void
    {
        User::updateOrCreate([
            'email' => 'admin@siatu.sch.id',
        ], [
            'name' => 'Admin TU',
            'password' => Hash::make('sman4sby2024'),
            'role' => 'Admin',
            'status' => 'active',
        ]);

        Livewire::test(Login::class)
            ->set('data.email', 'admin@siatu.sch.id')
            ->set('data.password', 'sman4sby2024')
            ->call('authenticate')
            ->assertRedirect('/admin');

        $this->assertAuthenticatedAs(User::where('email', 'admin@siatu.sch.id')->first());
    }
}
