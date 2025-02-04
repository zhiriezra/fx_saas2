<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommodityAggregationResource\Pages;
use App\Filament\Resources\CommodityAggregationResource\RelationManagers;
use App\Models\CommodityAggregation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommodityAggregationResource extends Resource
{
    protected static ?string $model = CommodityAggregation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team_id')
                    ->relationship('team', 'name')
                    ->required()
                    ->label('Team'),
                Forms\Components\Select::make('aggregation_center_id')
                    ->required()
                    ->relationship('aggregationCenter', 'name'),
                Forms\Components\TextInput::make('agent_id')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('commodity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('unit')
                    ->options([
                        'bags' => 'Bags',
                        'cartons' => 'Cartons',
                        'crates' => 'Crates',
                        'drums' => 'Drums',
                        'jars' => 'Jars',
                        'kegs' => 'Kegs',
                        'liters' => 'Liters',
                        'packs' => 'Packs',
                        'pieces' => 'Pieces',
                        'sacks' => 'Sacks',
                        'tons' => 'Tons',
                    ])
                    ->required()
                    ->default('bags'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('team_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('aggregation_center_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agent_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commodity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('unit')
                    ->searchable(),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCommodityAggregations::route('/'),
            'create' => Pages\CreateCommodityAggregation::route('/create'),
            'view' => Pages\ViewCommodityAggregation::route('/{record}'),
            'edit' => Pages\EditCommodityAggregation::route('/{record}/edit'),
        ];
    }
}
