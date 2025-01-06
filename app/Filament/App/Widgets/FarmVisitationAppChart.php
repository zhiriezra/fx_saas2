<?php

namespace App\Filament\App\Widgets;

use App\Models\FarmVisitation;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class FarmVisitationAppChart extends ChartWidget
{
    protected static ?string $heading = 'Farm Visitations Chart';

    protected static ?int $sort = 2;

    protected static string $color = 'info';


    protected function getData(): array
    {
        $data = Trend::model(FarmVisitation::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Visitations',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
