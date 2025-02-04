<?php

namespace App\Filament\Resources\InputDistributionSurveyResource\Pages;

use App\Filament\Resources\InputDistributionSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInputDistributionSurvey extends EditRecord
{
    protected static string $resource = InputDistributionSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
