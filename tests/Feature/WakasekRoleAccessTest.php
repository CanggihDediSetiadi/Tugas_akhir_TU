<?php

namespace Tests\Feature;

use App\Filament\Pages\Disposisi;
use App\Models\User;
use App\Support\RoleAccess;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WakasekRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    private function wakasek(): User
    {
        return User::factory()->create([
            'name' => 'Wakasek Kurikulum',
            'role' => 'Wakasek',
            'status' => 'active',
            'jabatan' => 'Waka Kurikulum',
        ]);
    }

    public function test_wakasek_only_has_dashboard_and_disposisi_permissions(): void
    {
        $this->actingAs($this->wakasek());

        $this->assertTrue(RoleAccess::isWakasek());
        $this->assertTrue(RoleAccess::isDisposisiRecipient());
        $this->assertTrue(RoleAccess::canViewDashboard());
        $this->assertTrue(RoleAccess::canUseDisposisi());
        $this->assertTrue(RoleAccess::canFollowUpDisposisi());
        $this->assertTrue(Disposisi::canAccess());

        $this->assertFalse(RoleAccess::canCreateDisposisi());
        $this->assertFalse(RoleAccess::canManageDisposisi());
        $this->assertFalse(RoleAccess::canViewIncoming());
        $this->assertFalse(RoleAccess::canViewOutgoing());
        $this->assertFalse(RoleAccess::canViewArsip());
        $this->assertFalse(RoleAccess::canManageUsers());
        $this->assertFalse(RoleAccess::canPrintReports());
    }

    public function test_wakasek_dashboard_and_navigation_only_show_allowed_modules(): void
    {
        $this->actingAs($this->wakasek())
            ->get('/admin')
            ->assertOk()
            ->assertSee('Dashboard Wakil Kepala Sekolah')
            ->assertSee('href="http://localhost/admin/disposisi"', false)
            ->assertDontSee('href="http://localhost/admin/surat-masuk"', false)
            ->assertDontSee('href="http://localhost/admin/surat-keluar"', false)
            ->assertDontSee('href="http://localhost/admin/arsip-digital"', false)
            ->assertDontSee('href="http://localhost/admin/cetak-rekap"', false)
            ->assertDontSee('href="http://localhost/admin/user-management"', false);
    }

    public function test_wakasek_notifications_only_contain_assigned_disposisi_module(): void
    {
        $this->actingAs($this->wakasek())
            ->getJson('/api/notifications')
            ->assertOk()
            ->assertJsonCount(1, 'items')
            ->assertJsonPath('items.0.key', 'disposisi');
    }

    public function test_wakasek_cannot_open_modules_outside_dashboard_and_disposisi(): void
    {
        $this->actingAs($this->wakasek());

        $this->get('/admin/disposisi')->assertOk();
        $this->get('/admin/surat-masuk')->assertForbidden();
        $this->get('/admin/surat-keluar')->assertForbidden();
        $this->get('/admin/arsip-digital')->assertForbidden();
        $this->get('/admin/cetak-rekap')->assertForbidden();
        $this->get('/admin/user-management')->assertForbidden();
    }

    public function test_wakasek_recipient_aliases_include_role_identity_and_position(): void
    {
        $wakasek = $this->wakasek();
        $recipients = RoleAccess::disposisiRecipients($wakasek);

        $this->assertContains('Wakasek', $recipients);
        $this->assertContains('Wakil Kepala Sekolah', $recipients);
        $this->assertContains('Waka', $recipients);
        $this->assertContains('Wakasek Kurikulum', $recipients);
        $this->assertContains('Waka Kurikulum', $recipients);
    }
}
