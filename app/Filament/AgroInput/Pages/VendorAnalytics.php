<?php

namespace App\Filament\AgroInput\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use App\Filament\AgroInput\Resources\VendorResource\Widgets\TopPerformingProductWidget; 
use App\Filament\AgroInput\Widgets\RevenueStatsOverviewAgroInput;
use App\Filament\AgroInput\Resources\VendorResource\Widgets\RevenueTrackingByLocation;

class VendorAnalytics extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.agro-input.pages.vendor-analytics';
    protected static ?string $title = 'Vendor Analytics';
    
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
            RevenueStatsOverviewAgroInput::class,
            TopPerformingProductWidget::class,
            RevenueTrackingByLocation::class,
        ];
    }
    
}
