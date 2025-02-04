<?php

namespace App\Filament\Resources\SoilTopographySurveyResource\Pages;

use App\Filament\Resources\SoilTopographySurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSoilTopographySurveys extends ListRecords
{
    protected static string $resource = SoilTopographySurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
