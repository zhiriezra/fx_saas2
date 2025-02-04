<?php

namespace App\Filament\AgroInput\Resources\FarmSeasonResource\Pages;

use App\Filament\AgroInput\Resources\FarmSeasonResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFarmSeason extends ViewRecord
{
    protected static string $resource = FarmSeasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
