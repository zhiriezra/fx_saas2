<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AgeSurveyResource\Pages;
use App\Filament\Resources\AgeSurveyResource\RelationManagers;
use App\Models\AgeSurvey;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgeSurveyResource extends Resource
{
    protected static ?string $model = AgeSurvey::class;

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
                Forms\Components\Select::make('age_range')
                    ->options([
                        '18-20' => '18-20',
                        '21-25' => '21-25',
                        '26-30' => '26-30',
                        '31-35' => '31-35',
                        '36-40' => '36-40',
                        '41-45' => '41-45',
                        '46-50' => '46-50',
                        '51-55' => '51-55',
                        '56-60' => '56-60',
                        '61-65' => '61-65',
                        '66-70' => '66-70',
                        '71-75' => '71-75',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('age_range_frequency')
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
                Tables\Columns\TextColumn::make('age_range')
                    ->searchable(),
                Tables\Columns\TextColumn::make('age_range_frequency')
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
            'index' => Pages\ListAgeSurveys::route('/'),
            'create' => Pages\CreateAgeSurvey::route('/create'),
            'view' => Pages\ViewAgeSurvey::route('/{record}'),
            'edit' => Pages\EditAgeSurvey::route('/{record}/edit'),
        ];
    }
}
