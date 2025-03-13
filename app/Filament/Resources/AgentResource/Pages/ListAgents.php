<?php

namespace App\Filament\Resources\AgentResource\Pages;

use App\Filament\AgroInput\Resources\AgentResource\Widgets\AgentStatsOverview;
use App\Filament\AgroInput\Widgets\SalesStatsOverviewAgroInput;
use App\Filament\Resources\AgentResource;
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
            SalesStatsOverviewAgroInput::class,
        ];
    }
}
