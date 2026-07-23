<?php

use App\Filament\Pages\UserManagement;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

it('admin dapat menambahkan user baru', function (): void {
    $this->actingAs(makeFeatureUser('Admin'));

    Livewire::test(UserManagement::class)
        ->set('name', 'Operator Tata Usaha')
        ->set('email', 'operator@siatu.sch.id')
        ->set('nip', '1987654321')
        ->set('jabatan', 'Staf Tata Usaha')
        ->set('role', 'Staf TU')
        ->set('status', 'active')
        ->set('password', 'password123')
        ->call('simpanUser')
        ->assertHasNoErrors();

    $operator = User::where('email', 'operator@siatu.sch.id')->firstOrFail();

    expect($operator->role)->toBe('Staf TU')
        ->and($operator->status)->toBe('active')
        ->and(Hash::check('password123', $operator->password))->toBeTrue();
});
