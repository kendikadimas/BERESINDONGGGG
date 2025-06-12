<?php

namespace App\Filament\Tukang\Resources\RatingResource\Pages;

use App\Filament\Tukang\Resources\RatingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Tukang\Resources\RatingResource\Widgets\RatingStats; // Impor widget


class ListRatings extends ListRecords
{
    protected static string $resource = RatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

     protected function getHeaderWidgets(): array
    {
        return [
            RatingStats::class,
        ];
    }
}
