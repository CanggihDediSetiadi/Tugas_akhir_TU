<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class StorageStatusWidget extends Widget
{
    protected static ?int $sort = 3;

    protected string $view = 'filament.widgets.storage-status-widget';

    protected int | string | array $columnSpan = 1;
}
