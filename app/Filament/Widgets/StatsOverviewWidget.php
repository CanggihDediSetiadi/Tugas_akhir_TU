<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Surat Masuk', '1,284')
                ->description('+12% bulan ini')
                ->descriptionIcon('heroicon-m-trending-up')
                ->color('primary')
                ->chart([40, 50, 45, 60, 55, 85, 70, 95]),

            Stat::make('Total Surat Keluar', '856')
                ->description('+5% bulan ini')
                ->descriptionIcon('heroicon-m-trending-up')
                ->color('info')
                ->chart([30, 35, 40, 45, 50, 55, 60, 75]),

            Stat::make('Disposisi Menunggu', '24')
                ->description('Segera diproses')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning'),

            Stat::make('Arsip Selesai', '2,110')
                ->description('Tersinkronisasi Cloud')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
