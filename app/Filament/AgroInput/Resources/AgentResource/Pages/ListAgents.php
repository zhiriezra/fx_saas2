<?php

namespace App\Filament\AgroInput\Resources\AgentResource\Pages;

use App\Filament\AgroInput\Resources\AgentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\AgroInput\Pages\AgentAnalyticPage;

class ListAgents extends ListRecords
{
    protected static string $resource = AgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('agent-analytics')
                ->label('Agent Analytics')
                ->url(fn() => AgentAnalyticPage::getUrl())
                ->icon('heroicon-o-chart-bar'),
            // Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
        ];
    }
}
