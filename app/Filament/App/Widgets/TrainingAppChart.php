<?php

namespace App\Filament\App\Widgets;

use App\Models\Training;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TrainingAppChart extends ChartWidget
{
    protected static ?string $heading = 'Training Chart';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $data = Trend::model(Training::class)
            ->between(
                start: now()->startOfMonth(),
                end: now()->endOfMonth(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Trainings',
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
