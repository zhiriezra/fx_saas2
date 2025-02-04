<?php

namespace App\Filament\AgroInput\Widgets;

use App\Models\InputDistribution;
use App\Models\InputDistributionSurvey;
use Filament\Widgets\ChartWidget;

class InputDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'Input Distribution';
    protected static ?int $sort = 6;

    protected function getData(): array
    {
        $yes = InputDistributionSurvey::where(['input_distribution_status' => 'Yes', 'visit' => 'First'])->first();
        $no = InputDistributionSurvey::where(['input_distribution_status' => 'No', 'visit' => 'First'])->first();

        $total = $yes->input_distribution_status_frequency + $no->input_distribution_status_frequency;

        $yes = $total > 0 ? ($yes->input_distribution_status_frequency / $total) * 100 : 0;
        $no = $total > 0 ? ($no->input_distribution_status_frequency / $total) * 100 : 0;


        return [
            'datasets' => [
                [
                    'label' => 'Land Ownership',
                    'data' => [round($yes, 0), round($no, 0)],
                    'backgroundColor' => ['#287e36', '#ff0000'],
                    // 'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Recieved Input', 'Did not Recieve Input'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
