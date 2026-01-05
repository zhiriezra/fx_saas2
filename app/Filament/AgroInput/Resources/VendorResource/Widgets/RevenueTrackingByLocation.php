<?php

namespace App\Filament\AgroInput\Resources\VendorResource\Widgets;

use App\Models\Order;
use App\Models\State;
use App\Models\Lga;
use Filament\Facades\Filament;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Tables\Columns\Summarizers\Average;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class RevenueTrackingByLocation extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    
    // protected ?string $heading = 'Revenue Tracking by Location';
    
    protected ?string $description = 'Essential revenue and performance metrics by State and LGA';

    public function getTableRecordKey($record): string
    {
        return $record->record_key ?? 'default';
    }

    public function table(Table $table): Table
    {
        $tenantId = Filament::getTenant()->id;
        
        $query = Order::query()
            ->select([
                DB::raw('CONCAT(states.id, "-", lgas.id) as record_key'),
                'states.name as state_name',
                'lgas.name as lga_name',
                DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
                DB::raw('SUM(order_items.quantity) as total_quantity'),
                DB::raw('SUM(order_items.quantity * order_items.agent_price) as total_revenue'),
                DB::raw('AVG(order_items.agent_price) as avg_unit_price'),
                DB::raw('COUNT(DISTINCT orders.farmer_id) as unique_farmers'),
                DB::raw('COUNT(DISTINCT orders.agent_id) as unique_agents'),
                DB::raw('ROUND(SUM(order_items.quantity * order_items.agent_price) / COUNT(DISTINCT orders.id), 2) as avg_order_value'),
                // Market penetration rate (farmers served vs estimated total)
                DB::raw('ROUND((COUNT(DISTINCT orders.farmer_id) / 1000) * 100, 2) as market_penetration'),
                // Customer retention rate (farmers with multiple orders)
                DB::raw('ROUND((COUNT(DISTINCT CASE WHEN farmer_order_counts.order_count > 1 THEN orders.farmer_id END) / COUNT(DISTINCT orders.farmer_id)) * 100, 2) as retention_rate'),
                // Product diversity (unique products sold)
                DB::raw('COUNT(DISTINCT products.id) as product_diversity')
            ])
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->join('states', 'vendors.state_id', '=', 'states.id')
            ->join('lgas', 'vendors.lga_id', '=', 'lgas.id')
            ->leftJoin(DB::raw('(SELECT farmer_id, COUNT(*) as order_count FROM orders GROUP BY farmer_id) as farmer_order_counts'), 'orders.farmer_id', '=', 'farmer_order_counts.farmer_id')
            ->where('vendors.team_id', $tenantId)
            ->groupBy('states.id', 'states.name', 'lgas.id', 'lgas.name')
            ->orderBy('total_revenue', 'desc');

        // Debug: Log the SQL and bindings
        \Log::info($query->toSql(), $query->getBindings());

        return $table
            ->query($query)
            ->columns([
                TextColumn::make('state_name')
                    ->label('State')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->lga_name)
                    ->icon('heroicon-m-map-pin'),
                    
                TextColumn::make('total_revenue')
                    ->label('Total Revenue')
                    ->money('NGN')
                    ->sortable()
                    ->weight('bold')
                    ->color('success')
                    ->summarize([
                        Sum::make()
                            ->label('Total Revenue')
                            ->money('NGN')
                    ]),
                    
                TextColumn::make('total_orders')
                    ->label('Orders')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Sum::make()
                            ->label('Total Orders')
                    ]),
                    
                TextColumn::make('avg_order_value')
                    ->label('Avg Order Value')
                    ->money('NGN')
                    ->sortable()
                    ->summarize([
                        Average::make()
                            ->label('Avg Order Value')
                            ->money('NGN')
                    ]),
                    
                TextColumn::make('unique_farmers')
                    ->label('Farmers Served')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Sum::make()
                            ->label('Total Farmers')
                    ]),
                    
                TextColumn::make('market_penetration')
                    ->label('Market Penetration')
                    ->suffix('%')
                    ->numeric()
                    ->sortable()
                    ->color(fn ($record) => $record->market_penetration > 5 ? 'success' : ($record->market_penetration > 2 ? 'warning' : 'danger'))
                    ->summarize([
                        Average::make()
                            ->label('Avg Market Penetration')
                            ->suffix('%')
                    ]),
                    
                TextColumn::make('retention_rate')
                    ->label('Retention Rate')
                    ->suffix('%')
                    ->numeric()
                    ->sortable()
                    ->color(fn ($record) => $record->retention_rate > 50 ? 'success' : ($record->retention_rate > 25 ? 'warning' : 'danger'))
                    ->summarize([
                        Average::make()
                            ->label('Avg Retention Rate')
                            ->suffix('%')
                    ]),
                    
                TextColumn::make('product_diversity')
                    ->label('Products Sold')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Average::make()
                            ->label('Avg Products')
                    ]),
            ])
            ->defaultSort('total_revenue', 'desc')
            ->striped()
            ->paginated([10, 25, 50, 100])
            ->filters([
                // Date Range Filter
                Filter::make('date_range')
                    ->form([
                        DatePicker::make('start_date')
                            ->label('Start Date')
                            ->placeholder('Select start date'),
                        DatePicker::make('end_date')
                            ->label('End Date')
                            ->placeholder('Select end date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['start_date'],
                                fn ($query) => $query->whereDate('orders.created_at', '>=', $data['start_date'])
                            )
                            ->when(
                                $data['end_date'],
                                fn ($query) => $query->whereDate('orders.created_at', '<=', $data['end_date'])
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['start_date'] ?? null) {
                            $indicators['start_date'] = 'From: ' . $data['start_date'];
                        }
                        if ($data['end_date'] ?? null) {
                            $indicators['end_date'] = 'To: ' . $data['end_date'];
                        }
                        return $indicators;
                    }),

                // Revenue Range Filter
                Filter::make('revenue_range')
                    ->form([
                        TextInput::make('min_revenue')
                            ->label('Minimum Revenue')
                            ->numeric()
                            ->placeholder('Enter minimum revenue'),
                        TextInput::make('max_revenue')
                            ->label('Maximum Revenue')
                            ->numeric()
                            ->placeholder('Enter maximum revenue'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['min_revenue'],
                                fn ($query) => $query->having('total_revenue', '>=', $data['min_revenue'])
                            )
                            ->when(
                                $data['max_revenue'],
                                fn ($query) => $query->having('total_revenue', '<=', $data['max_revenue'])
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['min_revenue'] ?? null) {
                            $indicators['min_revenue'] = 'Min Revenue: NGN ' . number_format($data['min_revenue']);
                        }
                        if ($data['max_revenue'] ?? null) {
                            $indicators['max_revenue'] = 'Max Revenue: NGN ' . number_format($data['max_revenue']);
                        }
                        return $indicators;
                    }),

                // Market Penetration Filter
                SelectFilter::make('market_penetration')
                    ->label('Market Penetration')
                    ->options([
                        'high' => 'High Penetration (> 5%)',
                        'medium' => 'Medium Penetration (2-5%)',
                        'low' => 'Low Penetration (< 2%)',
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['value'],
                            function ($query) use ($data) {
                                return match ($data['value']) {
                                    'high' => $query->having('market_penetration', '>', 5),
                                    'medium' => $query->having('market_penetration', '>=', 2)->having('market_penetration', '<=', 5),
                                    'low' => $query->having('market_penetration', '<', 2),
                                    default => $query,
                                };
                            }
                        );
                    }),

                // Retention Rate Filter
                SelectFilter::make('retention_rate')
                    ->label('Customer Retention')
                    ->options([
                        'high' => 'High Retention (> 50%)',
                        'medium' => 'Medium Retention (25-50%)',
                        'low' => 'Low Retention (< 25%)',
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['value'],
                            function ($query) use ($data) {
                                return match ($data['value']) {
                                    'high' => $query->having('retention_rate', '>', 50),
                                    'medium' => $query->having('retention_rate', '>=', 25)->having('retention_rate', '<=', 50),
                                    'low' => $query->having('retention_rate', '<', 25),
                                    default => $query,
                                };
                            }
                        );
                    }),

                // State Filter
                SelectFilter::make('state')
                    ->label('Filter by State')
                    ->options(function () {
                        $tenantId = Filament::getTenant()->id;
                        return Order::join('order_items', 'orders.id', '=', 'order_items.order_id')
                            ->join('products', 'order_items.product_id', '=', 'products.id')
                            ->join('vendors', 'products.vendor_id', '=', 'vendors.id')
                            ->join('states', 'vendors.state_id', '=', 'states.id')
                            ->where('vendors.team_id', $tenantId)
                            ->distinct()
                            ->pluck('states.name', 'states.id')
                            ->toArray();
                    })
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['value'],
                            fn ($query) => $query->where('states.id', $data['value'])
                        );
                    }),

                // Performance Filter
                SelectFilter::make('performance')
                    ->label('Performance Level')
                    ->options([
                        'high' => 'High Performance (Revenue > NGN 100,000)',
                        'medium' => 'Medium Performance (Revenue NGN 10,000 - 100,000)',
                        'low' => 'Low Performance (Revenue < NGN 10,000)',
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['value'],
                            function ($query) use ($data) {
                                return match ($data['value']) {
                                    'high' => $query->having('total_revenue', '>', 100000),
                                    'medium' => $query->having('total_revenue', '>=', 10000)->having('total_revenue', '<=', 100000),
                                    'low' => $query->having('total_revenue', '<', 10000),
                                    default => $query,
                                };
                            }
                        );
                    }),
            ])
            ->actions([
                // Add actions if needed
            ])
            ->bulkActions([
                // Add bulk actions if needed
            ]);
    }
}
