<?php

namespace App\Filament\App\Resources\FarmResource\Pages;

use App\Filament\App\Resources\FarmResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFarm extends ViewRecord
{
    protected static string $resource = FarmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
