<?php

namespace App\Filament\Tukang\Resources\RatingResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class RatingStats extends BaseWidget
{
    protected function getStats(): array
    {
        $user = Auth::user();

        // Menghitung rata-rata rating, menangani kasus jika belum ada rating
        $averageRating = $user->ratings()->avg('rating');
        $displayRating = $averageRating ? number_format($averageRating, 1) . ' / 5.0' : 'Belum Ada';

        return [
            Stat::make('Rating diterima', $user->ratings()->count()),
            Stat::make('Total Rating', $displayRating),
        ];
    }
}