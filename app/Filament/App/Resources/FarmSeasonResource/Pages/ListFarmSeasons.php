<?php

namespace App\Filament\App\Resources\FarmSeasonResource\Pages;

use App\Filament\App\Resources\FarmSeasonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFarmSeasons extends ListRecords
{
    protected static string $resource = FarmSeasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
