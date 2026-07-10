<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SuratVolumeChartWidget extends ChartWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 2;

    protected ?string $heading = 'Volume Persuratan 6 Bulan Terakhir';

    protected ?string $description = 'Statistik perbandingan surat masuk dan keluar.';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label'           => 'Surat Masuk',
                    'data'            => [40, 60, 55, 85, 70, 95],
                    'backgroundColor' => 'rgba(0, 88, 190, 0.8)',
                    'borderColor'     => '#0058be',
                    'borderWidth'     => 2,
                    'borderRadius'    => 4,
                ],
                [
                    'label'           => 'Surat Keluar',
                    'data'            => [30, 45, 50, 60, 65, 75],
                    'backgroundColor' => 'rgba(84, 95, 115, 0.8)',
                    'borderColor'     => '#545f73',
                    'borderWidth'     => 2,
                    'borderRadius'    => 4,
                ],
            ],
            'labels' => ['Des', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display'  => true,
                    'position' => 'top',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'grid'        => [
                        'color' => 'rgba(0,0,0,0.05)',
                    ],
                ],
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                ],
            ],
        ];
    }
}
