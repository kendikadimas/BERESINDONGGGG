<?php

namespace App\Filament\Tukang\Resources\EmergencyRequestResource\Pages;

use App\Filament\Tukang\Resources\EmergencyRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEmergencyRequests extends ManageRecords
{
    protected static string $resource = EmergencyRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
