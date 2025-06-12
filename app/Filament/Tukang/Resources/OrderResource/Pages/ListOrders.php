<?php

namespace App\Filament\Tukang\Resources\OrderResource\Pages;

use App\Filament\Tukang\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Tukang\Widgets\ApprovedWarrantyClaims; // <-- Impor widget garansi


class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

     protected function getFooterWidgets(): array
    {
        return [
            ApprovedWarrantyClaims::class, // <-- Daftarkan widget di sini
        ];
    }
}
