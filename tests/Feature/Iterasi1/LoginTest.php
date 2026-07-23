<?php

use Filament\Auth\Pages\Login;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

it('admin dapat login menggunakan email dan password yang benar', function (): void {
    $admin = makeFeatureUser('Admin', [
        'name' => 'Admin SIATU',
        'email' => 'admin@siatu.sch.id',
        'password' => Hash::make('sman4sby2024'),
    ]);

    Livewire::test(Login::class)
        ->set('data.email', 'admin@siatu.sch.id')
        ->set('data.password', 'sman4sby2024')
        ->call('authenticate')
        ->assertRedirect('/admin');

    $this->assertAuthenticatedAs($admin);
});
