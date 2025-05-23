<?php

namespace App\Filament\AgroInput\Resources\AgentResource\Pages;

use App\Filament\AgroInput\Resources\AgentResource;
use App\Filament\AgroInput\Resources\AgentResource\Widgets\AgentStatsOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAgents extends ListRecords
{
    protected static string $resource = AgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AgentStatsOverview::class,
        ];
    }
}
