<?php

namespace App\Filament\Resources\ServiceResource\Pages;

use App\Filament\Resources\ServiceResource;
use App\Filament\Resources\ServiceResource\Widgets\ServiceStatsWidget; // 1. Impor Widget
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServices extends ListRecords
{
    protected static string $resource = ServiceResource::class;

    // 2. Tambahkan method untuk menampilkan widget di header
    protected function getHeaderWidgets(): array
    {
        return [
            ServiceStatsWidget::class,
        ];
    }

    // 3. Tambahkan method untuk menampilkan tombol "Tambah Layanan" di header
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah Layanan'),
        ];
    }
}