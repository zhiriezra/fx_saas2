<?php

namespace App\Filament\Resources\GenderSurveyResource\Pages;

use App\Filament\Resources\GenderSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGenderSurveys extends ListRecords
{
    protected static string $resource = GenderSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
