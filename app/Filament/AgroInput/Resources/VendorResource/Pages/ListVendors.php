<?php

namespace App\Filament\AgroInput\Resources\VendorResource\Pages;

use App\Filament\AgroInput\Resources\VendorResource;
use App\Filament\AgroInput\Widgets\TrainingChart;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendors extends ListRecords
{
    protected static string $resource = VendorResource::class;

    // protected function getHeaderWidgets(): array
    // {
    //     return [
    //         TrainingChart::class,
    //     ];
    // }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
