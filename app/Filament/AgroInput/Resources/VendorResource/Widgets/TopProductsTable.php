<?php

namespace App\Filament\AgroInput\Resources\VendorResource\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class TopProductsTable extends BaseWidget
{
    protected static ?string $heading = 'Top Performing Products';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->select([
                        'products.id',
                        'products.name',
                        'products.agent_price',
                        DB::raw('SUM(orders.quantity) as total_quantity'),
                        DB::raw('SUM(orders.quantity * products.agent_price) as total_revenue'),
                        'vendors.business_name as vendor_name'
                    ])
                    ->join('orders', 'products.id', '=', 'orders.product_id')
                    ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                    ->groupBy('products.id', 'products.name', 'products.agent_price', 'vendors.business_name')
                    // ->orderByDesc('total_revenue')
                    ->limit(10)
            )->defaultSort('total_revenue', 'desc')

            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Product')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('vendor_name')
                    ->label('Vendor')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('agent_price')
                    ->label('Unit Price')
                    ->money('NGN')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_quantity')
                    ->label('Quantity Sold')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_revenue')
                    ->label('Total Revenue')
                    ->money('NGN')
                    ->sortable()
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->money('NGN'),
                    ]),
            ]);
    }
}
