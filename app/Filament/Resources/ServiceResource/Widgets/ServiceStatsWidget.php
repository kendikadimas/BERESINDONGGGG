<?php

namespace App\Filament\Resources\ServiceResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\ServiceCategory;

class ServiceStatsWidget extends BaseWidget
{
    // app/Filament/Resources/ServiceResource/Widgets/ServiceStatsWidget.php


protected function getStats(): array
{
    // Ambil semua kategori beserta jumlah layanan di dalamnya
    $categories = ServiceCategory::withCount('services')->get();

    // Buat array Stat secara dinamis
    return $categories->map(function ($category) {
        return Stat::make($category->name, $category->services_count);
    })->all();
}
}
