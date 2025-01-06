<?php

namespace App\Filament\App\Resources\TrainingResource\Pages;

use App\Filament\App\Resources\TrainingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTraining extends ViewRecord
{
    protected static string $resource = TrainingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
