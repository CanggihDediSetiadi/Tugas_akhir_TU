<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Support\RoleAccess;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagement extends Page
{
    public static function canAccess(): bool
    {
        return RoleAccess::canManageUsers();
    }

    protected string $view = 'filament.pages.user-management';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'User Management';
    protected static ?int $navigationSort = 5;
    protected static ?string $title = 'User Management';
    protected static bool $shouldRegisterNavigation = false;

    // Ã¢â€â‚¬Ã¢â€â‚¬ Modal state Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬
    public bool   $showModalUser   = false;
    public bool   $showModalHapus  = false;
    public bool   $showModalReset  = false;

    // Ã¢â€â‚¬Ã¢â€â‚¬ Form fields Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬
    public string $name     = '';
    public string $email    = '';
    public string $nip      = '';
    public string $jabatan  = '';
    public string $role     = '';
    public string $status   = 'active';
    public string $password = '';

    // Ã¢â€â‚¬Ã¢â€â‚¬ Edit / Delete target Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬
    public ?int  $editId   = null;
    public ?int  $hapusId  = null;
    public ?int  $resetId  = null;
    public bool  $isEdit   = false;

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }
    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable { return ''; }

    // Ã¢â€â‚¬Ã¢â€â‚¬ Buka Modal Tambah Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬
    public function openModalTambah(): void
    {
        abort_unless(RoleAccess::canManageUsers(), 403);
        $this->resetForm();
        $this->isEdit        = false;
        $this->showModalUser = true;
    }

    // Ã¢â€â‚¬Ã¢â€â‚¬ Buka Modal Edit Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬
    public function editUser(int $id): void
    {
        abort_unless(RoleAccess::canManageUsers(), 403);
        $user = User::findOrFail($id);
        $this->editId   = $id;
        $this->name     = $user->name;
        $this->email    = $user->email;
        $this->nip      = $user->nip ?? '';
        $this->jabatan  = $user->jabatan ?? '';
        $this->role     = $user->role ?? '';
        $this->status   = $user->status ?? 'active';
        $this->password = '';
        $this->isEdit   = true;
        $this->showModalUser = true;
    }

    // Ã¢â€â‚¬Ã¢â€â‚¬ Simpan (Tambah atau Update) Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬
    public function simpanUser(): void
    {
        abort_unless(RoleAccess::canManageUsers(), 403);
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email' . ($this->isEdit ? ",{$this->editId}" : ''),
            'role'  => 'required|string',
        ];

        if (!$this->isEdit) {
            $rules['password'] = 'required|string|min:8';
        }

        $this->validate($rules, [
            'name.required'     => 'Nama lengkap wajib diisi.',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email ini sudah terdaftar.',
            'role.required'     => 'Role wajib dipilih.',
            'password.required' => 'Password wajib diisi untuk pengguna baru.',
            'password.min'      => 'Password minimal 8 karakter.',
        ]);

        $data = [
            'name'    => $this->name,
            'email'   => $this->email,
            'nip'     => $this->nip ?: null,
            'jabatan' => $this->jabatan ?: null,
            'role'    => $this->role,
            'status'  => $this->status,
        ];

        if ($this->isEdit) {
            User::findOrFail($this->editId)->update($data);
            $msg = 'Data pengguna berhasil diperbarui.';
        } else {
            $data['password'] = Hash::make($this->password);
            User::create($data);
            $msg = 'Pengguna baru berhasil ditambahkan.';
        }

        $this->resetForm();
        $this->showModalUser = false;
        session()->flash('sukses', $msg);
        $this->js('window.location.reload()');
    }

    // Ã¢â€â‚¬Ã¢â€â‚¬ Konfirmasi & Hapus Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬
    public function konfirmasiHapus(int $id): void
    {
        abort_unless(RoleAccess::canManageUsers(), 403);
        $this->hapusId = $id;
        $this->showModalHapus = true;
    }

    public function hapusUser(): void
    {
        abort_unless(RoleAccess::canManageUsers(), 403);
        if ($this->hapusId === auth()->id()) {
            session()->flash('error', 'Tidak dapat menghapus akun sendiri.');
            $this->showModalHapus = false;
            return;
        }
        User::findOrFail($this->hapusId)->delete();
        $this->hapusId = null;
        $this->showModalHapus = false;
        session()->flash('sukses', 'Pengguna berhasil dihapus.');
        $this->js('window.location.reload()');
    }

    // Ã¢â€â‚¬Ã¢â€â‚¬ Reset Password Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬Ã¢â€â‚¬
    public function konfirmasiReset(int $id): void
    {
        abort_unless(RoleAccess::canManageUsers(), 403);
        $this->resetId = $id;
        $this->showModalReset = true;
    }

    public function resetPassword(): void
    {
        abort_unless(RoleAccess::canManageUsers(), 403);
        $user = User::findOrFail($this->resetId);
        $defaultPassword = 'sman4sby2024';
        $user->update(['password' => Hash::make($defaultPassword)]);
        $this->resetId = null;
        $this->showModalReset = false;
        session()->flash('sukses', 'Password berhasil direset ke default: ' . $defaultPassword);
        $this->js('window.location.reload()');
    }

    private function resetForm(): void
    {
        $this->name     = '';
        $this->email    = '';
        $this->nip      = '';
        $this->jabatan  = '';
        $this->role     = '';
        $this->status   = 'active';
        $this->password = '';
        $this->editId   = null;
        $this->isEdit   = false;
    }
}
