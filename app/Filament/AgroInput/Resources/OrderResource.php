<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Facades\Filament;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $modelLabel = 'Order Tracking';

    protected static ?string $tenantOwnershipRelationshipName = 'team';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Sales';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('agent_id')
                    ->label('Agent Name')
                    ->getStateUsing(fn ($record) => "{$record->agent->user->firstname} {$record->agent->user->lastname}")
                    ->searchable(),
                TextColumn::make('farmer_id')
                    ->label('Farmer Name')
                    ->getStateUsing(fn ($record) => "{$record->farmer->fname} {$record->farmer->lname}")
                    ->searchable(),
                
                TextColumn::make('agent.state.name')
                    ->label('Location')
                    ->getStateUsing(fn ($record) => "{$record->agent->state->name}, {$record->agent->lga->name}")
                    ->searchable(),
                TextColumn::make('total_amount')
                    ->label('Total Amount')
                    ->money('NGN')
                    ->searchable(),
                TextColumn::make('commission')
                    ->label('Commission Earned')
                    ->money('NGN')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                TextColumn::make('payment_type')
                    ->label('Payment Type')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'info',
                        'completed' => 'success',
                        'declined' => 'danger',
                        'supplied' => 'gray',
                        'accepted' => 'warning',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'accepted' => 'Accepted',
                        'declined' => 'Declined',
                        'supplied' => 'Supplied',
                        'completed' => 'Completed',
                    ]),
                Tables\Filters\SelectFilter::make('payment_type')
                    ->options([
                        'Cash' => 'Cash',
                        'Wallet' => 'Wallet',
                    ]),

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Order')
                    ->schema([
                        Components\TextEntry::make('agent_id')
                            ->label('Agent Name')
                            ->getStateUsing(fn ($record) => "{$record->agent->user->firstname} {$record->agent->user->lastname}"),
                        Components\TextEntry::make('vendor.user.full_name')
                            ->label('Vendor Name')
                            ->getStateUsing(fn ($record) => "{$record->vendor->user->firstname} {$record->vendor->user->lastname}"),
                        Components\TextEntry::make('farmer_id')
                            ->label('Farmer Name')
                            ->getStateUsing(fn ($record) => "{$record->farmer->fname} {$record->farmer->lname}"),                        
                        Components\TextEntry::make('commission')
                            ->label('Commission Earned')
                            ->money('NGN'),
                        
                        Components\TextEntry::make('delivery_type')
                            ->label('Delivery Type'),
                        Components\TextEntry::make('created_at')
                            ->label('Date Made')
                            ->date(),
                        Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'info',
                                'completed' => 'success',
                                'declined' => 'danger',
                                'supplied' => 'gray',
                                'accepted' => 'warning',
                                default => 'gray',
                            }),
                    ])->columns(3),

                Components\Section::make('Products')
                    ->schema([
                        Components\TextEntry::make('product_name')
                            ->label('Product Name')
                            ->state(function (Order $record) {
                                return $record->orderItems
                                    ->map(fn ($item) => $item->product?->manufacturer_product?->name)
                                    ->filter()
                                    ->implode(', ');
                            })
                            ->columns(2),
                        
                        Components\TextEntry::make('manufacturer')
                            ->label('Manufacturer')
                            ->state(function (Order $record) {
                                return $record->orderItems
                                    ->map(fn ($item) => 
                                        $item->product?->manufacturer_product?->manufacturer?->name
                                    )
                                    ->filter()
                                    ->unique()
                                    ->implode(', ');
                            })
                            ->columns(2),

                        Components\TextEntry::make('quantity')
                            ->label('Total Quantity')
                            ->state(function (Order $record) {
                                return $record->orderItems->pluck('quantity')->sum();
                            }),
                    ])
                    ->columns(3),


                // Section: Description
                Components\Section::make('Payment')
                    ->schema([
                        Components\TextEntry::make('transaction_id')
                            ->label('Transaction ID')
                            ->copyable(),
                        Components\TextEntry::make('total_amount')
                            ->label('Total Amount')
                            ->money('NGN'),
                        Components\TextEntry::make('payment_type')
                            ->label('Payment Type'),
                    ])->columns(3),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $tenant = Filament::getTenant();
        return parent::getEloquentQuery()
            ->when($tenant, fn (Builder $q) => $q->whereHas('agent', fn (Builder $a) => $a->where('team_id', $tenant->id)));
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}
