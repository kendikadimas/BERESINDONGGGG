<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStatsWidget extends BaseWidget
{
    // app/Filament/Resources/OrderResource/Widgets/OrderStatsWidget.php

protected function getStats(): array
{
    return [
        Stat::make('Total Pesanan', Order::count())
            ->description('Semua pesanan yang masuk')
            ->icon('heroicon-o-clipboard-document-list'),
        Stat::make('Berlangsung', Order::where('status', 'ongoing')->count())
            ->description('Pesanan yang sedang dikerjakan')
            ->color('primary')
            ->icon('heroicon-o-clock'),
        Stat::make('Selesai', Order::where('status', 'completed')->count())
            ->description('Pesanan yang telah selesai')
            ->color('success')
            ->icon('heroicon-o-check-circle'),
    ];
}
}
