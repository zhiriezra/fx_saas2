<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\CommodityAggregationResource\Pages;
use App\Filament\AgroInput\Resources\CommodityAggregationResource\RelationManagers;
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

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Aggregations';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        $tenant = Filament::getTenant();

        return static::getModel()::where('team_id', $tenant->id ?? null)->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('team.name')
                    ->required(),
                Forms\Components\TextInput::make('aggregation_center_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('agent_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('quantity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('commodity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('unit')
                    ->required()
                    ->maxLength(255)
                    ->default('bags'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('aggregation_center_id')
                    ->label('Aggregation Center')
                    ->getStateUsing(fn($record) => $record->aggregationCenter->name)
                    ->sortable(),
                Tables\Columns\TextColumn::make('agent_id')
                    ->getStateUsing(fn($record) => $record->agent->user->firstname. ' ' . $record->agent->user->lastname)
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
                // Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCommodityAggregations::route('/'),
            'create' => Pages\CreateCommodityAggregation::route('/create'),
            // 'view' => Pages\ViewCommodityAggregation::route('/{record}'),
            // 'edit' => Pages\EditCommodityAggregation::route('/{record}/edit'),
        ];
    }
}
