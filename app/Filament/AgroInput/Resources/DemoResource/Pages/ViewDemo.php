<?php

namespace App\Filament\AgroInput\Resources\DemoResource\Pages;

use App\Filament\AgroInput\Resources\DemoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDemo extends ViewRecord
{
    protected static string $resource = DemoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
