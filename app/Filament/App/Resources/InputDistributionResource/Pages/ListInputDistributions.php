<?php

namespace App\Filament\App\Resources\InputDistributionResource\Pages;

use App\Filament\App\Resources\InputDistributionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInputDistributions extends ListRecords
{
    protected static string $resource = InputDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
