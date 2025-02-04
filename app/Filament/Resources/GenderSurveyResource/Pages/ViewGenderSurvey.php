<?php

namespace App\Filament\Resources\GenderSurveyResource\Pages;

use App\Filament\Resources\GenderSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewGenderSurvey extends ViewRecord
{
    protected static string $resource = GenderSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
