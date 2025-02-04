<?php

namespace App\Filament\Resources\InputQualitySurveyResource\Pages;

use App\Filament\Resources\InputQualitySurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInputQualitySurvey extends ViewRecord
{
    protected static string $resource = InputQualitySurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
