<?php

namespace App\Filament\Tukang\Widgets; // <-- 1. NAMESPACE SUDAH DIPERBAIKI

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth; // <-- 2. Gunakan Auth Facade

class TukangStatsWidget extends BaseWidget
{

    protected function getStats(): array
    {
        // 3. Ganti auth() dengan Auth::
        $tukangId = Auth::id();
        $user = Auth::user();

        // Pastikan user tidak null sebelum mengakses propertinya
        if (!$user) {
            return []; // Kembalikan array kosong jika tidak ada user
        }

        return [
            Stat::make('Total Pesanan', Order::where('tukang_id', $tukangId)->count())
                ->icon('heroicon-o-clipboard-document-list'),
            
            Stat::make('Total Customer', Order::where('tukang_id', $tukangId)->distinct('user_id')->count('user_id'))
                ->icon('heroicon-o-users'),

            Stat::make('Rating', number_format($user->rating, 1))
                ->icon('heroicon-o-star'),
        ];
    }
}