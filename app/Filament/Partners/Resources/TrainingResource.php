<?php

namespace App\Filament\Partners\Resources;

use App\Filament\Partners\Resources\TrainingResource\Pages;
use App\Filament\Partners\Resources\TrainingResource\RelationManagers;
use App\Models\Training;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('team_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('agent_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
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
                    ->numeric(),
                Forms\Components\TextInput::make('males')
                    ->numeric(),
                Forms\Components\TextInput::make('participant_list')
                    ->maxLength(255),
                Forms\Components\TextInput::make('images_link')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('agent_id')
                    ->label('Agent')
                    ->getStateUsing(fn($record) => $record->agent->user->firstname. ' '. $record->agent->user->lastname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('venue')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->label('State')
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.lga.name')
                    ->label('LGA')
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('images_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
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
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            'edit' => Pages\EditTraining::route('/{record}/edit'),
        ];
    }
}
