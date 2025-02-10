<?php

namespace App\Filament\AgroInput\Resources\CompetitionActivityResource\Pages;

use App\Filament\AgroInput\Resources\CompetitionActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompetitionActivity extends EditRecord
{
    protected static string $resource = CompetitionActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }
}
