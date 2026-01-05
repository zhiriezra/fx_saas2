<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainingResource\Pages;
use App\Filament\Resources\TrainingResource\RelationManagers;
use App\Models\Training;
use App\Models\Team;
use App\Models\State;
use App\Models\Lga;
use App\Models\Agent;
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
        
                Forms\Components\Select::make('team_id')
                    ->label('Team')
                    ->options(Team::all()->pluck('name', 'id'))
                    ->required()
                    ->live(),
                Forms\Components\Select::make('agent_id')
                    ->label('Agent')
                    ->searchable()
                    ->options(function (Forms\Get $get) {
                        $search = $get('search');
                        $teamId = $get('team_id');
                        
                        if (!$teamId) {
                            return [];
                        }

                        return Agent::query()
                            ->with('user')
                            ->where('team_id', $teamId)
                            ->when($search, function ($query) use ($search) {
                                $query->whereHas('user', function ($query) use ($search) {
                                    $query->where('firstname', 'like', "%{$search}%")
                                        ->orWhere('lastname', 'like', "%{$search}%");
                                });
                            })
                            ->get()
                            ->mapWithKeys(function ($agent) {
                                return [$agent->id => $agent->user->firstname . ' ' . $agent->user->lastname];
                            });
                    })
                    ->required()
                    ->live(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('venue')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('state_id')
                    ->label('State')
                    ->searchable()
                    ->options(State::query()->pluck('name', 'id'))
                    ->live()
                    ->required(),
                Forms\Components\Select::make('lga_id')
                    ->label('LGA')
                    ->live()
                    ->searchable()
                    ->options(function (Forms\Get $get) {
                        $stateId = $get('state_id');
                        if (!$stateId) {
                            return [];
                        }
                        return Lga::query()
                            ->where('state_id', $stateId)
                            ->pluck('name', 'id');
                    })
                    ->required(),
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
                Tables\Columns\TextColumn::make('team_id')
                    ->label('Team')
                    ->getStateUsing(fn ($record) => $record->team->name)
                    ->searchable(),
                Tables\Columns\TextColumn::make('agent_id')
                    ->label('Agent')
                    ->getStateUsing(fn ($record) => $record->agent->user->firstname . ' ' . $record->agent->user->lastname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('venue')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lga_id')
                    ->numeric()
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
                Tables\Columns\TextColumn::make('deleted_at')
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
            'index' => Pages\ListTrainings::route('/'),
            'create' => Pages\CreateTraining::route('/create'),
            'edit' => Pages\EditTraining::route('/{record}/edit'),
        ];
    }
}
