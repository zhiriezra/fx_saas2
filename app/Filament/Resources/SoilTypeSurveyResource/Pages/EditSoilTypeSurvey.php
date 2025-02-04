<?php

namespace App\Filament\Resources\SoilTypeSurveyResource\Pages;

use App\Filament\Resources\SoilTypeSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSoilTypeSurvey extends EditRecord
{
    protected static string $resource = SoilTypeSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
