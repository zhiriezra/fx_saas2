<?php

namespace App\Filament\AgroInput\Resources\AggregationCenterResource\Pages;

use App\Filament\AgroInput\Resources\AggregationCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAggregationCenter extends ViewRecord
{
    protected static string $resource = AggregationCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
