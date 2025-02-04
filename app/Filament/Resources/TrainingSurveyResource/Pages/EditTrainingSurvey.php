<?php

namespace App\Filament\Resources\TrainingSurveyResource\Pages;

use App\Filament\Resources\TrainingSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrainingSurvey extends EditRecord
{
    protected static string $resource = TrainingSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
