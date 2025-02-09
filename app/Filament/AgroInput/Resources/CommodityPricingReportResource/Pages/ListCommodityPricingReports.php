<?php

namespace App\Filament\AgroInput\Resources\CommodityPricingReportResource\Pages;

use App\Filament\AgroInput\Resources\CommodityPricingReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommodityPricingReports extends ListRecords
{
    protected static string $resource = CommodityPricingReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
