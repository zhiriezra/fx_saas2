<?php

namespace App\Filament\AgroInput\Resources\VendorResource\Pages;

use App\Filament\AgroInput\Resources\VendorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\AgroInput\Pages\VendorAnalytics;

class ListVendors extends ListRecords
{
    protected static string $resource = VendorResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('vendor-analytics')
                ->label('Agro Dealers Analytics')
                ->url(fn() => VendorAnalytics::getUrl())
                ->icon('heroicon-o-chart-bar'),
            // Actions\CreateAction::make(),
        ];
    }
}
