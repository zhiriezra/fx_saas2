<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\TrainingResource\Pages;
use App\Filament\App\Resources\TrainingResource\RelationManagers;
use App\Models\Agent;
use App\Models\Lga;
use App\Models\Training;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Sales Information';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('agent_id')
                    ->label('Agent')
                    ->required()
                    ->options(fn() => Agent::query()
                        ->where('current_team_id', auth()->user()->current_team_id)
                        ->get()
                        ->mapWithKeys(fn ($agent) => [
                            $agent->id => "{$agent->user->firstname} {$agent->user->lastname} - {$agent->user->phone}",
                        ])
                        ->toArray()
                    )
                    ->searchable()
                    ->preload()
                    ->live(),
                Forms\Components\TextInput::make('venue')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\Select::make('state_id')
                    ->relationship(name: 'state', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required()
                    ->afterStateUpdated(fn(Set $set) => $set('lga_id', null)),
                Forms\Components\Select::make('lga_id')
                    ->options(fn(Get $get): Collection => Lga::query()
                        ->where('state_id', $get('state_id'))
                        ->pluck('name', 'id')
                    )
                    ->searchable()
                    ->preload()
                    ->live()
                    ->required(),
                Forms\Components\TextInput::make('number_of_participants')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('males')
                    ->label('Number of Males')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('females')
                    ->label('Number of Females')
                    ->required()
                    ->numeric(),
                // Forms\Components\TextInput::make('participant_list')
                //     ->maxLength(255)
                //     ->default(null),
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
                    ->label('Training')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Agent')
                    ->getStateUsing(fn ($record) => "{$record->agent->user->firstname} {$record->agent->user->lastname}")
                    ->sortable(),
                Tables\Columns\TextColumn::make('venue')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_of_participants')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('females')
                    ->label('Females')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('males')
                    ->label('Males')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('participant_list')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            'view' => Pages\ViewTraining::route('/{record}'),
            'edit' => Pages\EditTraining::route('/{record}/edit'),
        ];
    }
}
