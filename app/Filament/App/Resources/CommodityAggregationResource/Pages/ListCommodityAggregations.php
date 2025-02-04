<?php

namespace App\Filament\App\Resources\CommodityAggregationResource\Pages;

use App\Filament\App\Resources\CommodityAggregationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommodityAggregations extends ListRecords
{
    protected static string $resource = CommodityAggregationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
