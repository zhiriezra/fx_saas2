<?php

namespace App\Filament\Resources\InputQualitySurveyResource\Pages;

use App\Filament\Resources\InputQualitySurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInputQualitySurvey extends EditRecord
{
    protected static string $resource = InputQualitySurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
