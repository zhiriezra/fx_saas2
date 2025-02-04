<?php

namespace App\Filament\Resources\AgeSurveyResource\Pages;

use App\Filament\Resources\AgeSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgeSurvey extends EditRecord
{
    protected static string $resource = AgeSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
