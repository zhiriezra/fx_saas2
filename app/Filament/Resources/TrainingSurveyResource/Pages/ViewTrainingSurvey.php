<?php

namespace App\Filament\Resources\TrainingSurveyResource\Pages;

use App\Filament\Resources\TrainingSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTrainingSurvey extends ViewRecord
{
    protected static string $resource = TrainingSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
