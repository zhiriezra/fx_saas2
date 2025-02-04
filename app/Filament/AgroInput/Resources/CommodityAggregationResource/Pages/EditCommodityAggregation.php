<?php

namespace App\Filament\AgroInput\Resources\CommodityAggregationResource\Pages;

use App\Filament\AgroInput\Resources\CommodityAggregationResource;
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
