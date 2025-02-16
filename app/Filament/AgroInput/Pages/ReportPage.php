<?php

namespace App\Filament\AgroInput\Pages;

use Filament\Pages\Page;

class ReportPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.agro-input.pages.report-page';

    protected static ?string $title = 'Reports from the fields';

    protected static ?string $navigationLabel = 'Monitoring & Evaluation Report';

}
