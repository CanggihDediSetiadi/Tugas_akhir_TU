<?php

namespace App\Providers\Filament;

use App\Filament\Pages\ArsipDigital;
use App\Filament\Pages\CetakRekap;
use App\Filament\Pages\Dashboard;
use App\Filament\Pages\Disposisi;
use App\Filament\Pages\SuratKeluar;
use App\Filament\Pages\SuratMasuk;
use App\Filament\Pages\TambahSuratKeluar;
use App\Filament\Pages\UserManagement;
use App\Support\RoleAccess;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\View\PanelsRenderHook;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('SMAN 4 Surabaya')
            ->brandLogo(fn () => view('filament.components.brand-logo'))
            ->favicon(null)
            ->colors([
                'primary' => Color::Blue,
                'info'    => Color::Sky,
                'success' => Color::Green,
                'warning' => Color::Amber,
                'danger'  => Color::Rose,
            ])
            ->renderHook(
                PanelsRenderHook::SIDEBAR_FOOTER,
                fn () => view('filament.components.sidebar-footer'),
            )
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('MENU UTAMA')
                    ->collapsible(false),
                NavigationGroup::make()
                    ->label('PERSURATAN')
                    ->collapsible(false),
                NavigationGroup::make()
                    ->label('UTILITY')
                    ->collapsible(false),
                NavigationGroup::make()
                    ->label('MASTER DATA')
                    ->collapsible(false),
            ])            ->navigationItems([
                NavigationItem::make('Dashboard')
                    ->url(fn () => Dashboard::getUrl())
                    ->icon('heroicon-o-squares-2x2')
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.dashboard'))
                    ->group('MENU UTAMA')
                    ->sort(1),
                NavigationItem::make('Surat Masuk')
                    ->url(fn () => SuratMasuk::getUrl())
                    ->icon('heroicon-o-inbox')
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.surat-masuk'))
                    ->group('PERSURATAN')
                    ->visible(fn () => RoleAccess::canViewIncoming())
                    ->sort(2),

                NavigationItem::make('Surat Keluar')
                    ->url(fn () => SuratKeluar::getUrl())
                    ->icon('heroicon-o-paper-airplane')
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.surat-keluar') || request()->routeIs('filament.admin.pages.tambah-surat-keluar'))
                    ->group('PERSURATAN')
                    ->visible(fn () => RoleAccess::canViewOutgoing())
                    ->sort(3),

                NavigationItem::make('Disposisi')
                    ->url(fn () => Disposisi::getUrl())
                    ->icon('heroicon-o-document-text')
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.disposisi'))
                    ->group('PERSURATAN')
                    ->visible(fn () => RoleAccess::canUseDisposisi())
                    ->sort(4),

                NavigationItem::make('User Management')
                    ->url(fn () => UserManagement::getUrl())
                    ->icon('heroicon-o-users')
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.user-management'))
                    ->group('MASTER DATA')
                    ->visible(fn () => RoleAccess::canManageUsers())
                    ->sort(99),

                NavigationItem::make('Arsip Digital')
                    ->url(fn () => ArsipDigital::getUrl())
                    ->icon('heroicon-o-archive-box')
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.arsip-digital'))
                    ->group('UTILITY')
                    ->visible(fn () => RoleAccess::canViewArsip())
                    ->sort(6),

                NavigationItem::make('Cetak Rekap')
                    ->url(fn () => CetakRekap::getUrl())
                    ->icon('heroicon-o-printer')
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.cetak-rekap'))
                    ->group('UTILITY')
                    ->visible(fn () => RoleAccess::canPrintReports())
                    ->sort(7),
            ])
            // Resources & Pages: only explicit registration to avoid conflicts
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->pages([
                Dashboard::class,
                SuratMasuk::class,
                SuratKeluar::class,
                TambahSuratKeluar::class,
                Disposisi::class,
                UserManagement::class,
                ArsipDigital::class,
                CetakRekap::class,
            ])
            // No widgets ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â dashboard handles everything in its custom view
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}


