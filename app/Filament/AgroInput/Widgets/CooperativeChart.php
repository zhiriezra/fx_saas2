<?php

namespace App\Filament\AgroInput\Widgets;

use App\Models\CooperativeSurvey;
use Filament\Widgets\ChartWidget;

class CooperativeChart extends ChartWidget
{
    protected static ?string $heading = 'Cooperative Membership Chart';
    protected static ?int $sort = 2;

    protected static string $color = 'danger';

    protected function getData(): array
    {
        $yes = CooperativeSurvey::where(['cooperative_status' => 'Belongs', 'visit' => 'First'])->first();
        $no = CooperativeSurvey::where(['cooperative_status' => 'Does not belong', 'visit' => 'First'])->first();

        $total = $yes->cooperative_status_frequency + $no->cooperative_status_frequency;

        $yes = $total > 0 ? ($yes->cooperative_status_frequency / $total) * 100 : 0;
        $no = $total > 0 ? ($no->cooperative_status_frequency / $total) * 100 : 0;


        return [
            'datasets' => [
                [
                    'label' => 'Cooperative Membership',
                    'data' => [round($yes, 0), round($no, 0)],
                    
                ],
            ],
            'labels' => ['Belongs', 'Does not Belong'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    // protected function getData(): array
    // {
    //     return [
    //         'datasets' => [
    //             [
    //                 'label' => 'Blog posts created',

    //                 'data' => [20, 89],
    //             ],
    //         ],
    //         'labels' => ['yes', 'no'],
    //     ];
    // }

    // protected function getType(): string
    // {
    //     return 'pie';
    // }
}
