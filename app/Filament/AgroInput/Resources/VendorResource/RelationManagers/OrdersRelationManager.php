<?php

namespace App\Filament\AgroInput\Resources\VendorResource\RelationManagers;

use App\Filament\Exports\OrderExporter;
use Faker\Provider\ar_EG\Text;
use Filament\Tables\Actions\ExportAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Order;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Card;
use Filament\Infolists\Components\Grid;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('transaction_id')
                    ->label('Transaction ID')
                    ->copyable()
                    ->searchable(),
                TextColumn::make('farmer_id')
                    ->label('Farmer')
                    ->getStateUsing(fn($record) => "{$record->farmer->fname} {$record->farmer->lname}"),
                TextColumn::make('agent_id')
                    ->label('Agent')
                    ->getStateUsing(fn($record) => "{$record->agent->user->firstname} {$record->agent->user->lastname}"),
                TextColumn::make('vendor_location')
                    ->label('Vendor Location')
                    ->getStateUsing(fn($record) => $record->vendor->state->name . ', ' . $record->vendor->lga->name)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('total_amount')
                    ->label('Total Amount')
                    ->money('NGN'),
                TextColumn::make('commission')
                    ->label('Commission Earned')
                    ->money('NGN'),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('order_date_range')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('From Date'),
                        DatePicker::make('created_until')
                            ->label('Until Date'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Order date from ' . \Carbon\Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Order date until ' . \Carbon\Carbon::parse($data['created_until'])->toFormattedDateString();
                        }
                        return $indicators;
                    }),
                SelectFilter::make('vendor_state')
                    ->label('Vendor State')
                    ->relationship('vendor.state', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('vendor_lga')
                    ->label('Vendor LGA')
                    ->relationship('vendor.lga', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                ExportAction::make()
                    ->exporter(OrderExporter::class),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Order Summary')
                    ->icon('heroicon-o-receipt-refund')
                    ->description('Overview of this order and its items.')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('transaction_id')
                            ->label('Transaction ID')
                            ->badge()
                            ->color('primary')
                            ->icon('heroicon-o-hashtag'),
                        TextEntry::make('created_at')
                            ->label('Order Date')
                            ->date()
                            ->icon('heroicon-o-calendar-days'),
                        TextEntry::make('farmer.full_name')
                            ->label('Farmer')
                            ->icon('heroicon-o-user'),
                        TextEntry::make('agent.user.full_name')
                            ->label('Agent')
                            ->icon('heroicon-o-user-group'),
                        TextEntry::make('vendor_location')
                            ->label('Vendor Location')
                            ->getStateUsing(fn($record) => $record->vendor->state->name . ', ' . $record->vendor->lga->name)
                            ->icon('heroicon-o-map-pin'),
                        TextEntry::make('total_amount')
                            ->label('Total Amount')
                            ->money('NGN')
                            ->color('success')
                            ->icon('heroicon-o-currency-dollar'),
                        TextEntry::make('commission')
                            ->label('Commission Earned')
                            ->money('NGN')
                            ->color('warning')
                            ->icon('heroicon-o-banknotes'),
                    ]),

                Section::make('Order Items')
                    ->icon('heroicon-o-shopping-cart')
                    ->description('List of products in this order.')
                    ->collapsible()
                    ->schema([
                        RepeatableEntry::make('orderItems')
                            ->label('Items')
                            ->schema([
                                // Remove Card to avoid multiple borders
                                Grid::make()
                                    ->columns(6)
                                    ->schema([
                                        // Product image
                                        ImageEntry::make('product.manufacturer_product.image')
                                            ->label('')
                                            ->circular()
                                            ->height(60)
                                            ->width(60)
                                            ->columnSpan(1),
                                        // Product name and quantity
                                        Grid::make()
                                            ->columns(1)
                                            ->schema([
                                                TextEntry::make('product.manufacturer_product.name')
                                                    ->label('Product')
                                                    ->weight('bold')
                                                    ->color('primary'),
                                                TextEntry::make('quantity')
                                                    ->label('Qty')
                                                    ->badge()
                                                    ->color('info'),
                                            ])
                                            ->columnSpan(2),
                                        // Prices and commission
                                        Grid::make()
                                            ->columns(1)
                                            ->schema([
                                                TextEntry::make('unit_price')
                                                    ->label('Agent Price')
                                                    ->money('NGN')
                                                    ->color('success'),
                                                TextEntry::make('unit_price')
                                                    ->label('Unit Price')
                                                    ->money('NGN'),
                                            ])
                                            ->columnSpan(1),
                                        // Commission
                                        TextEntry::make('commission')
                                            ->label('Commission')
                                            ->money('NGN')
                                            ->color('warning')
                                            ->columnSpan(1),
                                        // Subtotal
                                        TextEntry::make('subtotal')
                                            ->label('Sub Total')
                                            ->money('NGN')
                                            ->color('primary')
                                            ->columnSpan(1),
                                ])
                            ])
                    ])
            ]);
    }
}
