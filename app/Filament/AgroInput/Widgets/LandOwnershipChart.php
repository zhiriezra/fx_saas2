<?php

namespace App\Filament\AgroInput\Widgets;

use App\Models\LandOwnerSurvey;
use Filament\Widgets\ChartWidget;

class LandOwnershipChart extends ChartWidget
{
    protected static ?string $heading = 'Land Ownership Chart';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $owned = LandOwnerSurvey::where(['ownership' => 'Owned', 'visit' => 'First'])->first();
        $rented = LandOwnerSurvey::where(['ownership' => 'Rented', 'visit' => 'First'])->first();

        $total = $owned->ownership_frequency + $rented->ownership_frequency;

        $ownedPercentage = $total > 0 ? ($owned->ownership_frequency / $total) * 100 : 0;
        $rentedPercentage = $total > 0 ? ($rented->ownership_frequency / $total) * 100 : 0;


        return [
            'datasets' => [
                [
                    'label' => 'Land Ownership',
                    'data' => [round($ownedPercentage, 0), round($rentedPercentage, 0)],
                    'backgroundColor' => 'success',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Owned', 'Rented'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
