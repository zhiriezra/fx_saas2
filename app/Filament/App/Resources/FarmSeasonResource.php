<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\FarmSeasonResource\Pages;
use App\Filament\App\Resources\FarmSeasonResource\RelationManagers;
use App\Models\FarmSeason;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FarmSeasonResource extends Resource
{
    protected static ?string $model = FarmSeason::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Farm Lands';

    protected static ?string $navigationGroup = 'Sales Information';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->maxLength(36)
                    ->default(null),
                Forms\Components\TextInput::make('team_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('farm_id')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('planted_date')
                    ->required(),
                Forms\Components\DatePicker::make('harvest_date'),
                Forms\Components\TextInput::make('season_year')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('commodity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('farm.description')
                    ->label('Description')
                    ->sortable(),
                Tables\Columns\TextColumn::make('commodity')
                ->searchable(),
                Tables\Columns\TextColumn::make('farm.state.name')
                    ->label('State')
                    ->sortable(),
                Tables\Columns\TextColumn::make('farm.lga.name')
                    ->label('City/Town')
                    ->sortable(),
                Tables\Columns\TextColumn::make('planted_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harvest_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('season_year')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
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
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListFarmSeasons::route('/'),
            'create' => Pages\CreateFarmSeason::route('/create'),
            'view' => Pages\ViewFarmSeason::route('/{record}'),
            'edit' => Pages\EditFarmSeason::route('/{record}/edit'),
        ];
    }
}
