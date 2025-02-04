<?php

namespace App\Filament\Resources\CommodityAggregationResource\Pages;

use App\Filament\Resources\CommodityAggregationResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCommodityAggregation extends ViewRecord
{
    protected static string $resource = CommodityAggregationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
