<?php

namespace App\Filament\AgroInput\Resources\FarmSeasonResource\Pages;

use App\Filament\AgroInput\Resources\FarmSeasonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFarmSeason extends EditRecord
{
    protected static string $resource = FarmSeasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
