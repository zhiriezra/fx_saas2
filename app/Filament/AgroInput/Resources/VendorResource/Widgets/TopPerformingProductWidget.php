<?php

namespace App\Filament\AgroInput\Resources\VendorResource\Widgets;

use App\Models\Product;
use Filament\Facades\Filament;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class TopPerformingProductWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $tenantId = Filament::getTenant()->id;
        
        return $table
            ->query(
                Product::query()
                    ->select([
                        'products.*',
                        DB::raw('COALESCE(SUM(order_items.quantity), 0) as total_quantity_sold'),
                        DB::raw('COALESCE(SUM(order_items.quantity * order_items.agent_price), 0) as total_revenue'),
                        DB::raw('COALESCE(COUNT(DISTINCT order_items.order_id), 0) as total_orders')
                    ])
                    ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
                    ->whereHas('vendor', function ($query) use ($tenantId) {
                        $query->where('team_id', $tenantId);
                    })
                    ->with(['vendor', 'manufacturer_product.manufacturer', 'manufacturer_product.sub_category.category'])
                    ->groupBy('products.id')
            )
            ->columns([
                ImageColumn::make('manufacturer_product.image')
                    ->circular()
                    ->height(60)
                    ->width(60)
                    ->label('Image'),
                TextColumn::make('manufacturer_product.name')
                    ->label('Product Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('manufacturer_product.sub_category.category.name')
                    ->label('Category')
                    ->searchable(),
                TextColumn::make('total_quantity_sold')
                    ->label('Units Sold')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Sum::make()
                            ->label('Total Units')
                    ]),
                TextColumn::make('total_orders')
                    ->label('Orders')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Sum::make()
                            ->label('Total Orders')
                    ]),
                TextColumn::make('total_revenue')
                    ->label('Revenue')
                    ->money('NGN')
                    ->sortable()
                    ->summarize([
                        Sum::make()
                            ->label('Total Revenue')
                            ->money('NGN')
                    ]),
                TextColumn::make('agent_price')
                    ->label('Agent Price')
                    ->money('NGN')
                    ->sortable(),
                TextColumn::make('vendor.business_name')
                    ->label('Vendor')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('performance_metric')
                    ->label('Rank by Performance Metric')
                    ->options([
                        'total_quantity_sold' => 'Units Sold',
                        'total_revenue' => 'Revenue',
                        'total_orders' => 'Number of Orders',
                    ])
                    ->default('total_quantity_sold')
                    ->query(function ($query, array $data) {
                        if (isset($data['values']['performance_metric'])) {
                            $metric = $data['values']['performance_metric'];
                            $query->orderBy($metric, 'desc');
                        }
                        return $query;
                    })
            ])
            ->defaultSort('total_quantity_sold', 'desc')
            ->paginated(false);
    }
}
