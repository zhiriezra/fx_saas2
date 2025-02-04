<?php

namespace App\Filament\Resources\InputDistributionSurveyResource\Pages;

use App\Filament\Resources\InputDistributionSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInputDistributionSurveys extends ListRecords
{
    protected static string $resource = InputDistributionSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
