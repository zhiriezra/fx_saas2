<?php

namespace App\Filament\Resources\SoilTypeSurveyResource\Pages;

use App\Filament\Resources\SoilTypeSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSoilTypeSurveys extends ListRecords
{
    protected static string $resource = SoilTypeSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
