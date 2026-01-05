<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\FarmSeasonResource\Pages;
use App\Filament\AgroInput\Resources\FarmSeasonResource\RelationManagers;
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

    protected static ?string $navigationGroup = 'Sales';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->maxLength(36),
                Forms\Components\TextInput::make('team_id')
                    ->numeric(),
                Forms\Components\Select::make('farm_id')
                    ->relationship('farm', 'id')
                    ->required(),
                Forms\Components\TextInput::make('season')
                    ->maxLength(255),
                Forms\Components\TextInput::make('budget')
                    ->maxLength(255),
                Forms\Components\TextInput::make('goal')
                    ->maxLength(255),
                Forms\Components\TextInput::make('report')
                    ->maxLength(255),
                Forms\Components\TextInput::make('farm_status')
                    ->required(),
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
                Tables\Columns\TextColumn::make('farm.code')
                    ->label('Farm code')
                    ->sortable(),
                Tables\Columns\TextColumn::make('season_year')
                    ->searchable(),
                Tables\Columns\TextColumn::make('commodity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('season')
                    ->searchable(),
                Tables\Columns\TextColumn::make('budget')
                    ->money('NGN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('goal')
                    ->searchable(),
                Tables\Columns\TextColumn::make('report')
                    ->searchable(),
                Tables\Columns\TextColumn::make('farm_status'),
                Tables\Columns\TextColumn::make('planted_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harvest_date')
                    ->date()
                    ->sortable(),
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
            'index' => Pages\ListFarmSeasons::route('/'),
            // 'create' => Pages\CreateFarmSeason::route('/create'),
            // 'edit' => Pages\EditFarmSeason::route('/{record}/edit'),
        ];
    }
}
