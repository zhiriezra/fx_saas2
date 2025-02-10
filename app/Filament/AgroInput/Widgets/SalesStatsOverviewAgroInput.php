<?php

namespace App\Filament\AgroInput\Widgets;

use App\Models\Order;
use App\Models\Vendor;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class SalesStatsOverviewAgroInput extends BaseWidget
{
    protected ?string $heading = 'Sales Analytics';

    protected ?string $description = 'An overview of sales analytics.';

    protected function getStats(): array
    {

        $tenantId = Filament::getTenant()->id;

        $lastMonthOrders = Order::whereHas('product.vendor', function ($query) use ($tenantId) {
            $query->where('team_id', $tenantId);
        })
        ->whereBetween('created_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])
        ->count();

        $thisMonthOrders = Order::where('status','completed')->whereBetween('created_at', [now()->startOfMonth(), now()])->whereHas('product.vendor', function ($query) use ($tenantId) {
            $query->where(['team_id' => $tenantId]);
        })->count();

        // Get total sales for current month
        $currentSales = Order::join('products', 'orders.product_id', '=', 'products.id')
            ->whereHas('product.vendor', function ($query) use ($tenantId) {
                $query->where('team_id', $tenantId);
            })
            ->whereBetween('orders.created_at', [now()->startOfMonth(), now()])
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
        $totalHubs = Vendor::where('team_id', $tenantId)->count();

        return [
            Stat::make('Total Orders Last Month', $lastMonthOrders)
                ->icon('heroicon-m-presentation-chart-line')
                ->description('Orders placed in the previous month')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),

            Stat::make('Total Orders This Month', $thisMonthOrders)
                ->description($lastMonthOrders >= $thisMonthOrders ? 'There\'s a decline in orders':'Great, you are have more orders this month')
                ->icon('heroicon-m-presentation-chart-line')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color($lastMonthOrders >= $thisMonthOrders ? 'danger':'primary'),

            Stat::make('Total Hubs', $totalHubs)
                ->description('Hubs across your network')
                ->icon('heroicon-m-building-storefront')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color($totalHubs <= 5 ? 'warning' : 'success'),

        ];
    }
}
