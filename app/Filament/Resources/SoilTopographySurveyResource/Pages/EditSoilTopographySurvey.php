<?php

namespace App\Filament\Resources\SoilTopographySurveyResource\Pages;

use App\Filament\Resources\SoilTopographySurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSoilTopographySurvey extends EditRecord
{
    protected static string $resource = SoilTopographySurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
