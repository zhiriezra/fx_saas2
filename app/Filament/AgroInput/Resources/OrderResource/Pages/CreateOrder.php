<?php

namespace App\Filament\AgroInput\Resources\OrderResource\Pages;

use App\Filament\AgroInput\Resources\OrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
}
