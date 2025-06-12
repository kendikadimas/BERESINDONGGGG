<?php
// app/Filament/Tukang/Widgets/TukangServiceStats.php
namespace App\Filament\Tukang\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Order;

class TukangServiceStats extends BaseWidget
{
    protected function getStats(): array
    {
        $tukang = Auth::user();

        // Layanan Populer
        $popularServiceId = Order::where('tukang_id', $tukang->id)
            ->select('service_id', DB::raw('count(*) as total'))
            ->groupBy('service_id')
            ->orderBy('total', 'desc')
            ->first();
        $popularServiceName = $popularServiceId ? Service::find($popularServiceId->service_id)?->name : 'Belum ada';

        return [
            Stat::make('Layanan Populer', $popularServiceName)
                ->description('Layanan yang paling sering dipesan'),

            Stat::make('Layanan Anda', $tukang->offeredServices()->where('status', 'approved')->count())
                ->description('Total layanan aktif yang Anda tawarkan'),

            Stat::make('Layanan Pending', $tukang->offeredServices()->where('status', 'pending')->count())
                ->description('Menunggu persetujuan admin')
                ->color('warning'),
        ];
    }
}