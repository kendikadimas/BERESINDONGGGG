<?php
// app/Filament/Tukang/Pages/Dashboard.php

namespace App\Filament\Tukang\Pages;

use App\Filament\Tukang\Widgets\TukangStatsWidget; // 1. Impor kelas Widget Anda
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    // 2. Tambahkan atau modifikasi method ini
    public function getHeaderWidgets(): array
    {
        return [
            TukangStatsWidget::class,
        ];
    }
}