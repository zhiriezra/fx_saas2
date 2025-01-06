<?php

namespace App\Filament\App\Resources\InputDistributionResource\Pages;

use App\Filament\App\Resources\InputDistributionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInputDistribution extends ViewRecord
{
    protected static string $resource = InputDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
