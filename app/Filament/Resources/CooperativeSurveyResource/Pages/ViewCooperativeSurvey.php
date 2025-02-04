<?php

namespace App\Filament\Resources\CooperativeSurveyResource\Pages;

use App\Filament\Resources\CooperativeSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCooperativeSurvey extends ViewRecord
{
    protected static string $resource = CooperativeSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
