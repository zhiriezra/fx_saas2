<?php

namespace App\Filament\AgroInput\Widgets;

use App\Models\Agent;
use App\Models\FarmSeason;
use App\Models\Vendor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewAgroInput extends BaseWidget
{

    protected ?string $heading = 'Analytics';

    protected ?string $description = 'An overview of some analytics.';

    protected function getStats(): array
    {
        $vendors = Vendor::where('team_id', auth()->user()->current_team_id)->count();
        $trainings = Agent::where('team_id', auth()->user()->current_team_id)->count();
        $farms = FarmSeason::where(['team_id' => auth()->user()->current_team_id, 'status' => 1])->count();
        return [
            Stat::make('Total Hubs', number_format($vendors))
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->description('Hubs in your network')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('info'),
            Stat::make('Trainings', number_format($trainings))
                ->chart([3, 2, 3, 2, 4, 3, 2])
                ->description('Total Trainings conducted')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('danger'),
            Stat::make('Active farms', number_format($farms))
                ->chart([2, 3, 2, 4, 3, 2, 5])
                ->description('Active farm seasons')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),
        ];
    }
}
