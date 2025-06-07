<?php

namespace App\Filament\Resources\UserResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;

class UserStatsWidget extends BaseWidget
{
    // app/Filament/Resources/UserResource/Widgets/UserStatsWidget.php


protected function getStats(): array
{
    return [
        Stat::make('Total Customer', User::where('role', 'customer')->count())
            ->description('Jumlah customer terdaftar')
            ->icon('heroicon-o-user-group'),
        Stat::make('Total Tukang', User::where('role', 'tukang')->count())
            ->description('Jumlah tukang terdaftar')
            ->icon('heroicon-o-wrench-screwdriver'),
        Stat::make('Butuh Verifikasi', User::whereNull('email_verified_at')->count())
            ->description('User yang belum verifikasi email')
            ->color('warning')
            ->icon('heroicon-o-exclamation-triangle'),
    ];
}
}
