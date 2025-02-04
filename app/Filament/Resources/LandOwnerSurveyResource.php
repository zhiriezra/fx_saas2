<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandOwnerSurveyResource\Pages;
use App\Filament\Resources\LandOwnerSurveyResource\RelationManagers;
use App\Models\LandOwnerSurvey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LandOwnerSurveyResource extends Resource
{
    protected static ?string $model = LandOwnerSurvey::class;

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
                Forms\Components\Select::make('ownership')
                    ->options([
                        'Owned' => 'Owned',
                        'Rented' => 'Rented'
                    ]),
                Forms\Components\TextInput::make('ownership_frequency')
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
                Tables\Columns\TextColumn::make('ownership')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ownership_frequency')
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
            'index' => Pages\ListLandOwnerSurveys::route('/'),
            'create' => Pages\CreateLandOwnerSurvey::route('/create'),
            'view' => Pages\ViewLandOwnerSurvey::route('/{record}'),
            'edit' => Pages\EditLandOwnerSurvey::route('/{record}/edit'),
        ];
    }
}
