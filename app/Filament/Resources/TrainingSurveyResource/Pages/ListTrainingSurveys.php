<?php

namespace App\Filament\Resources\TrainingSurveyResource\Pages;

use App\Filament\Resources\TrainingSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrainingSurveys extends ListRecords
{
    protected static string $resource = TrainingSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
