<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SoilTypeSurveyResource\Pages;
use App\Filament\Resources\SoilTypeSurveyResource\RelationManagers;
use App\Models\SoilTypeSurvey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SoilTypeSurveyResource extends Resource
{
    protected static ?string $model = SoilTypeSurvey::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'M&E';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team_id')
                    ->relationship('team', 'name')
                    ->required(),
                Forms\Components\Select::make('visit')
                    ->options([
                        'First' => 'First Visit',
                        'Second' => 'Second Visit',
                        'Third' => 'Third Visit',
                    ])
                    ->required(),
                Forms\Components\Select::make('soil_type')
                    ->options([
                        'Clay' => 'Clay',
                        'Sandy' => 'Sandy',
                        'Loamy' => 'Loamy'
                    ]),
                Forms\Components\TextInput::make('soil_type_frequency')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('team_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('visit')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('soil_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('soil_type_frequency')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListSoilTypeSurveys::route('/'),
            'create' => Pages\CreateSoilTypeSurvey::route('/create'),
            'view' => Pages\ViewSoilTypeSurvey::route('/{record}'),
            'edit' => Pages\EditSoilTypeSurvey::route('/{record}/edit'),
        ];
    }
}
