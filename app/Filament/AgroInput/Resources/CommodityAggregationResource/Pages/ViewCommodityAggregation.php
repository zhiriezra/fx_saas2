<?php

namespace App\Filament\AgroInput\Resources\CommodityAggregationResource\Pages;

use App\Filament\AgroInput\Resources\CommodityAggregationResource;
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
