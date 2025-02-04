<?php

namespace App\Filament\Resources\AgeSurveyResource\Pages;

use App\Filament\Resources\AgeSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgeSurveys extends ListRecords
{
    protected static string $resource = AgeSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
