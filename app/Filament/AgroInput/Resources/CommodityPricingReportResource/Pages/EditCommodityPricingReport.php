<?php

namespace App\Filament\AgroInput\Resources\CommodityPricingReportResource\Pages;

use App\Filament\AgroInput\Resources\CommodityPricingReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommodityPricingReport extends EditRecord
{
    protected static string $resource = CommodityPricingReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
