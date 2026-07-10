<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class RecentLettersWidget extends Widget
{
    protected static ?int $sort = 4;

    protected string $view = 'filament.widgets.recent-letters-widget';

    protected int | string | array $columnSpan = 'full';
}
