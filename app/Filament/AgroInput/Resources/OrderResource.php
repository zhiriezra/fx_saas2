<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\OrderResource\Pages;
use App\Filament\AgroInput\Resources\OrderResource\RelationManagers;
use App\Filament\Exports\OrderExporter;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Sales';
    protected static ?string $navigationLabel = 'Purchasing Farmers';
    protected static ?string $modelLabel = 'Purchasing Farmers';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('product_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('agent_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('farmer_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.vendor.business_name')
                    ->label('Hubs')
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Farmer')
                    ->getStateUsing(fn($record) => "{$record->farmer->fname} {$record->farmer->lname}")
                    ->sortable(),
                Tables\Columns\TextColumn::make('Farmer Phone')
                    ->getStateUsing(fn($record) => "+234 {$record->farmer->mobile_no}")
                    ->sortable(),
                Tables\Columns\TextColumn::make('State')
                    ->getStateUsing(fn($record) => "{$record->farmer->state->name}")
                    ->sortable(),
                Tables\Columns\TextColumn::make('LGA')
                    ->getStateUsing(fn($record) => "{$record->farmer->lga->name}")
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.agent_price')
                    ->label('Unit Price')
                    ->money('NGN')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->getStateUsing(fn ($record) => ($record->product->agent_price * $record->quantity))
                    ->money('NGN'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(OrderExporter::class)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
