<?php

namespace App\Filament\Resources\CooperativeSurveyResource\Pages;

use App\Filament\Resources\CooperativeSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCooperativeSurvey extends EditRecord
{
    protected static string $resource = CooperativeSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
