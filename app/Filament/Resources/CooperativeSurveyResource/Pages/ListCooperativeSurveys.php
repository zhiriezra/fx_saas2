<?php

namespace App\Filament\Resources\CooperativeSurveyResource\Pages;

use App\Filament\Resources\CooperativeSurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCooperativeSurveys extends ListRecords
{
    protected static string $resource = CooperativeSurveyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
