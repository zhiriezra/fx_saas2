<?php

namespace App\Filament\App\Resources\FarmSeasonResource\Pages;

use App\Filament\App\Resources\FarmSeasonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFarmSeason extends EditRecord
{
    protected static string $resource = FarmSeasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
