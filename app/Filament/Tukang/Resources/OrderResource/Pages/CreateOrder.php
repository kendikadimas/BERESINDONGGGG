<?php

namespace App\Filament\Tukang\Resources\OrderResource\Pages;

use App\Filament\Tukang\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
