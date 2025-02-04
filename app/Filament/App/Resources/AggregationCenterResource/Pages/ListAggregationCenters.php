<?php

namespace App\Filament\App\Resources\AggregationCenterResource\Pages;

use App\Filament\App\Resources\AggregationCenterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAggregationCenters extends ListRecords
{
    protected static string $resource = AggregationCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
