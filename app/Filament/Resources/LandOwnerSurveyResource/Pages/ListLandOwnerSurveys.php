<?php

namespace App\Filament\Resources\LandOwnerSurveyResource\Pages;

use App\Filament\Resources\LandOwnerSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLandOwnerSurveys extends ListRecords
{
    protected static string $resource = LandOwnerSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
