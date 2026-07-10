<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Support\RoleAccess;

class CetakRekap extends Page
{
    public static function canAccess(): bool
    {
        return RoleAccess::canPrintReports();
    }

    protected string $view = 'filament.pages.cetak-rekap';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-printer';

    protected static ?string $navigationLabel = 'Cetak Rekap';

    protected static ?int $navigationSort = 7;

    protected static ?string $title = 'Cetak Rekap';

    // Navigasi dikelola oleh NavigationItem di AdminPanelProvider (UTILITY group)
    protected static bool $shouldRegisterNavigation = false;

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return '';
    }

    public function getHeading(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return '';
    }
}
