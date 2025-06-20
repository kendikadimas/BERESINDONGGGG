<?php

namespace App\Filament\Tukang\Resources\EmergencyRequestResource\Pages;

use App\Filament\Tukang\Resources\EmergencyRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmergencyRequests extends ListRecords
{
    protected static string $resource = EmergencyRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [        ];
    }
}
