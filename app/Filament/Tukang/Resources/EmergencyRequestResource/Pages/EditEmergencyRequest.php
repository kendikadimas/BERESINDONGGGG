<?php

namespace App\Filament\Tukang\Resources\EmergencyRequestResource\Pages;

use App\Filament\Tukang\Resources\EmergencyRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmergencyRequest extends EditRecord
{
    protected static string $resource = EmergencyRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
