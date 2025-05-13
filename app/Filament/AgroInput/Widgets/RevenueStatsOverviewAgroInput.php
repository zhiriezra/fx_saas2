<?php

namespace App\Filament\AgroInput\Widgets;

use App\Models\Order;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class RevenueStatsOverviewAgroInput extends BaseWidget
{

    protected ?string $heading = 'Revenue Stats';

    protected ?string $description = 'An overview of sales analytics.';

    protected function getStats(): array
    {

        $tenantId = Filament::getTenant()->id;

        // Get total sales for current month
        $currentSales = Order::join('products', 'orders.product_id', '=', 'products.id')
            ->whereHas('product.vendor', function ($query) use ($tenantId) {
                $query->where('team_id', $tenantId);
            })
            // ->whereBetween('orders.created_at', [now()->startOfMonth(), now()])
            ->sum(DB::raw('orders.quantity * products.agent_price'));

        // Get total sales for previous month
        $previousSales = Order::join('products', 'orders.product_id', '=', 'products.id')
            ->whereHas('product.vendor', function ($query) use ($tenantId) {
                $query->where('team_id', $tenantId);
            })
            ->whereBetween('orders.created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])
            ->sum(DB::raw('orders.quantity * products.agent_price'));

        // Calculate growth percentage
        $growth = $previousSales > 0 ? (($currentSales - $previousSales) / $previousSales) * 100 : 0;


        return [
            Stat::make('Total Revenue Last Month', 'NGN '. number_format($previousSales,2))
                ->description('Earnings last month')
                ->icon('heroicon-m-presentation-chart-bar')
                ->chart([17, 2, 1, 3, 15, 4, 4])
                ->color('info'),

            Stat::make('Revenue This Month', 'NGN '. number_format($currentSales,2))
                ->description('Earnings this month')
                ->icon('heroicon-m-presentation-chart-bar')
                ->chart([7, 17])
                ->color($previousSales >= $currentSales ? 'danger':'success'),

            Stat::make('Sales Growth', number_format($growth, 2) . '%')
                ->description($growth >= 0 ? 'Increase from last month' : 'Decrease from last month')
                ->icon($growth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color($growth >= 0 ? 'success' : 'danger'),
        ];
    }
}
