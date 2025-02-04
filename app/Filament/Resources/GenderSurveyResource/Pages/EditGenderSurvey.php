<?php

namespace App\Filament\Resources\GenderSurveyResource\Pages;

use App\Filament\Resources\GenderSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGenderSurvey extends EditRecord
{
    protected static string $resource = GenderSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
