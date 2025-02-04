<?php

namespace App\Filament\AgroInput\Widgets;

use App\Models\SoilTypeSurvey;
use Filament\Widgets\ChartWidget;

class SoilTypeChart extends ChartWidget
{
    protected static ?string $heading = 'Soil Type Chart';
    protected static ?int $sort = 3;

    protected function getData(): array
    {

        $clay = SoilTypeSurvey::where(['soil_type' => 'Clay', 'visit' => 'First'])->first();
        $loamy = SoilTypeSurvey::where(['soil_type' => 'Loamy', 'visit' => 'First'])->first();
        $sandy = SoilTypeSurvey::where(['soil_type' => 'Sandy', 'visit' => 'First'])->first();



        $total = $clay->soil_type_frequency + $loamy->soil_type_frequency + $sandy->soil_type_frequency;

        $clay = $total > 0 ? ($clay->soil_type_frequency / $total) * 100 : 0;
        $loamy = $total > 0 ? ($loamy->soil_type_frequency / $total) * 100 : 0;
        $sandy = $total > 0 ? ($sandy->soil_type_frequency / $total) * 100 : 0;


        return [
            'datasets' => [
                [
                    'label' => 'Soil Type',
                    'data' => [round($clay, 0), round($loamy, 0), round($sandy, 0)],
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Clay', 'Loamy', 'Sandy'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
