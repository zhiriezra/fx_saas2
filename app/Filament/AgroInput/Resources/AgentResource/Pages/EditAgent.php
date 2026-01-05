<?php

namespace App\Filament\AgroInput\Resources\AgentResource\Pages;

use App\Filament\AgroInput\Resources\AgentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAgent extends EditRecord
{
    protected static string $resource = AgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
