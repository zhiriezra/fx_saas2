<?php

namespace App\Filament\AgroInput\Resources\VendorResource\Widgets;

use App\Models\Order;
use App\Models\Vendor;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class HubsMonthlyPerformanceRevenue extends ChartWidget
{
    protected static ?string $heading = 'Monthly Revenue by Hubs';
    protected int | string | array $columnSpan = 'full';
    private $colors;

    public function __construct()
    {
        $this->colors = $this->generateRandomColors(5);
    }

    protected function getData(): array
    {

        $currentMonth = Carbon::now();

        $vendors = Vendor::all();
        $labels = $vendors->pluck('business_name');

        $monthlyRevenue = $vendors->map(function($vendor) use ($currentMonth){
            return Order::whereHas('product', function ($query) use ($vendor) {
                $query->where('vendor_id', $vendor->id);
            })
            ->whereYear('orders.created_at', $currentMonth->year)
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->sum(DB::raw('orders.quantity * products.agent_price'));
        })->toArray();


        return [
            'datasets' => [
                [
                    'label' => $currentMonth->format('F Y') . ' Revenue',
                    'data' => $monthlyRevenue,
                    'backgroundColor' => $this->colors,
                    'borderColor' => $this->colors,
                    'borderWidth' => 1,

                ],
            ],

            'labels' => $labels,
        ];
    }

    private function generateRandomColors(int $count): array
    {
        $colors = [];

        for ($i = 0; $i < $count; $i++) {
            $colors[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        }

        return $colors;
    }


    protected function getType(): string
    {
        return 'bar';
    }

}
