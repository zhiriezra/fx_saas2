<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\CommodityPricingReportResource\Pages;
use App\Filament\AgroInput\Resources\CommodityPricingReportResource\RelationManagers;
use App\Models\CommodityPricingReport;
use App\Models\Lga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class CommodityPricingReportResource extends Resource
{
    protected static ?string $model = CommodityPricingReport::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Market Intelligence Reports';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationLabel = 'Weekly Commodity Updates';

    protected static ?string $modelLabel = 'Weekly Commodity Pricing Updates';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('commodity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('unit')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('state_id')
                    ->relationship('state', 'name')
                    ->live()
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('lga_id')
                    ->options(fn(Get $get): Collection => Lga::query()
                        ->where('state_id', $get('state_id'))
                        ->get()
                        ->pluck('name', 'id'))
                    ->live()
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('NGN'),
                Forms\Components\TextInput::make('team_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('commodity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('NGN')
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date Reported')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCommodityPricingReports::route('/'),
            'create' => Pages\CreateCommodityPricingReport::route('/create'),
            'edit' => Pages\EditCommodityPricingReport::route('/{record}/edit'),
        ];
    }
}
