<?php

namespace App\Filament\Resources\InputQualitySurveyResource\Pages;

use App\Filament\Resources\InputQualitySurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInputQualitySurveys extends ListRecords
{
    protected static string $resource = InputQualitySurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
