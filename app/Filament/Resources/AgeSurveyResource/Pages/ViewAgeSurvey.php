<?php

namespace App\Filament\Resources\AgeSurveyResource\Pages;

use App\Filament\Resources\AgeSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAgeSurvey extends ViewRecord
{
    protected static string $resource = AgeSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
