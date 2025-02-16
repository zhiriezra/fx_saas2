<?php

namespace App\Filament\App\Resources\CommodityAggregationResource\Pages;

use App\Filament\App\Resources\CommodityAggregationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommodityAggregation extends EditRecord
{
    protected static string $resource = CommodityAggregationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
