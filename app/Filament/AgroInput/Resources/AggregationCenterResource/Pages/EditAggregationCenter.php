<?php

namespace App\Filament\AgroInput\Resources\AggregationCenterResource\Pages;

use App\Filament\AgroInput\Resources\AggregationCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAggregationCenter extends EditRecord
{
    protected static string $resource = AggregationCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
