<?php

namespace App\Filament\AgroInput\Widgets;

use App\Models\InputQualitySurvey;
use App\Models\TrainingSurvey;
use Filament\Widgets\ChartWidget;

class TrainingChart extends ChartWidget
{
    protected static ?string $heading = 'Input Quality Chart';
    protected static ?int $sort = 4;


    protected function getData(): array
    {
        $yes = InputQualitySurvey::where(['input_quality_status' => 'Satisfied', 'visit' => 'First'])->first();
        $no = InputQualitySurvey::where(['input_quality_status' => 'Not satisfied', 'visit' => 'First'])->first();

        $total = $yes->input_quality_status_frequency + $no->input_quality_status_frequency;

        $yes = $total > 0 ? ($yes->input_quality_status_frequency / $total) * 100 : 0;
        $no = $total > 0 ? ($no->input_quality_status_frequency / $total) * 100 : 0;


        return [
            'datasets' => [
                [
                    'label' => 'Input Quality',
                    'data' => [round($yes, 0), round($no, 0)],
                    'backgroundColor' => ['#3669e6', '#ff0000'],
                    // 'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Satisfied', 'Not Satisfied'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
