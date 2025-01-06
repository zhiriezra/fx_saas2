<?php

namespace App\Filament\App\Widgets;

use App\Models\Agent;
use App\Models\FarmSeason;
use App\Models\Vendor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAppOverview extends BaseWidget
{

    protected ?string $heading = 'Analytics';

    protected ?string $description = 'An overview of some analytics.';

    protected static ?int $sort = 3;


    protected function getStats(): array
    {
        return [
            Stat::make('Agents', Agent::query()->count())
            ->description('Agents working for you')
            ->descriptionIcon('heroicon-m-users')
            ->color('primary'),
        Stat::make('Farm Lands', FarmSeason::query()->count())
            ->description('Your farm lands')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('primary'),
        Stat::make('Hubs', Vendor::query()->count())
            ->description('Hubs in your network')
            ->descriptionIcon('heroicon-m-shopping-cart')
            ->color('primary'),
        ];
    }
}
