<?php

namespace App\Filament\Resources\CommodityAggregationResource\Pages;

use App\Filament\Resources\CommodityAggregationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommodityAggregation extends EditRecord
{
    protected static string $resource = CommodityAggregationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
