<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\TrainingResource\Pages;
use App\Filament\AgroInput\Resources\TrainingResource\RelationManagers;
use App\Models\Training;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Sales';

    protected static ?int $navigationSort = 2;

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
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('team_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('agent_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('venue')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('state_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lga_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('number_of_participants')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('females')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('males')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('participant_list')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('agent.user.firstname')
                    ->getStateUsing(fn($record) => "{$record->agent->user->firstname} {$record->agent->user->lastname}")
                    ->label('Agent')
                    ->sortable(),
                Tables\Columns\TextColumn::make('venue')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_participants')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('females')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('males')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('participant_list')
                    ->url(fn($record) => $record->images, true)
                    ->color('primary')
                    ->icon('heroicon-o-link'),
                Tables\Columns\TextColumn::make('images')
                    ->label('Training Images')
                    ->url(fn($record) => $record->images, true)
                    ->color('primary')
                    ->icon('heroicon-o-link'),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
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
                SelectFilter::make('State')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('Lga')
                    ->relationship('lga', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
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
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            // 'edit' => Pages\EditTraining::route('/{record}/edit'),
        ];
    }
}
