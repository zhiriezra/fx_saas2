<?php

namespace App\Filament\AgroInput\Resources\VendorResource\Pages;

use App\Filament\AgroInput\Resources\VendorResource;
use App\Filament\AgroInput\Resources\VendorResource\Widgets\HubsMonthlyPerformanceRevenue;
use App\Filament\AgroInput\Resources\VendorResource\Widgets\TopProductsTable;
use App\Filament\AgroInput\Widgets\SalesStatsOverviewAgroInput;
use App\Filament\AgroInput\Widgets\TrainingChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendors extends ListRecords
{
    protected static string $resource = VendorResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            SalesStatsOverviewAgroInput::class,
            HubsMonthlyPerformanceRevenue::class,
            TopProductsTable::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
