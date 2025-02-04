<?php

namespace App\Filament\AgroInput\Widgets;

use App\Models\GenderSurvey;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;

class GenderSurveyChart extends ChartWidget
{
    protected static ?string $heading = 'Gender Survey Chart';
    protected static ?int $sort = 5;

    protected function getData(): array
    {

        $females = GenderSurvey::where(['gender' => 'female', 'visit' => 'First'])->first();
        $males = GenderSurvey::where(['gender' => 'male', 'visit' => 'First'])->first();

        $total = $females->gender_frequency + $males->gender_frequency;

        $malePercentage = $total > 0 ? ($males->gender_frequency / $total) * 100 : 0;
        $femalePercentage = $total > 0 ? ($females->gender_frequency / $total) * 100 : 0;


        return [
            'datasets' => [
                [
                    'label' => 'Gender Segregations',
                    'data' => [round($malePercentage, 0), round($femalePercentage, 0)],
                    'backgroundColor' => ['#36A2EB', '#FF6384'],
                    // 'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Male', 'Female'],
        ];

    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
