<?php

namespace App\Filament\Resources\SoilTopographySurveyResource\Pages;

use App\Filament\Resources\SoilTopographySurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSoilTopographySurvey extends ViewRecord
{
    protected static string $resource = SoilTopographySurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
