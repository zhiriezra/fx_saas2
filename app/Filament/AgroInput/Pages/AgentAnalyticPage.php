<?php

namespace App\Filament\AgroInput\Pages;

use App\Filament\AgroInput\Resources\AgentResource\Widgets\TopPerformingAgent;
use Filament\Actions\Action;

use Filament\Pages\Page;

class AgentAnalyticPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.agro-input.pages.agent-analytic-page';

    protected static ?string $title = 'Agent Analytics';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Back')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(url()->previous())
        ];
    }
    public function getHeaderWidgets(): array
    {
        return [
             TopPerformingAgent::class,
        ];
    }
}
