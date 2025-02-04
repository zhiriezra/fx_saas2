<?php

namespace App\Filament\Resources\LandOwnerSurveyResource\Pages;

use App\Filament\Resources\LandOwnerSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLandOwnerSurvey extends EditRecord
{
    protected static string $resource = LandOwnerSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
