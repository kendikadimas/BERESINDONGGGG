<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Order;
use App\Models\WarrantyClaim;
use Illuminate\Support\Number;

class AdminStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // 1. Menghitung total pendapatan dari order yang statusnya 'completed'
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');

        // 2. Menghitung jumlah pesanan baru di bulan dan tahun saat ini
        $newOrdersThisMonth = Order::whereMonth('created_at', now()->month)
                                   ->whereYear('created_at', now()->year)
                                   ->count();

        // 3. Menghitung jumlah user dengan role 'tukang'
        $activeTukang = User::where('role', 'tukang')->count();

        // 4. Menghitung jumlah klaim garansi yang masih 'pending'
        $pendingClaims = WarrantyClaim::where('status', 'pending')->count();

        return [
            Stat::make('Total Pendapatan', 'Rp ' . Number::format($totalRevenue, locale: 'id'))
                ->description('Dari semua pesanan yang selesai')
                ->color('success')
                ->icon('heroicon-o-banknotes'),

            Stat::make('Pesanan Baru Bulan Ini', $newOrdersThisMonth)
                ->description('Pertumbuhan bisnis bulan ini')
                ->color('primary')
                ->icon('heroicon-o-arrow-trending-up'),

            Stat::make('Total Tukang Aktif', $activeTukang)
                ->description('Jumlah mitra tukang terverifikasi')
                ->icon('heroicon-o-wrench-screwdriver'),

            Stat::make('Klaim Garansi Pending', $pendingClaims)
                ->description('Klaim yang butuh persetujuan')
                ->color('warning')
                ->icon('heroicon-o-exclamation-triangle'),
        ];
    }
}