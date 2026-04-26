<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\TrainingResource\Pages;
use App\Models\Agent;
use App\Models\Lga;
use App\Models\State;
use App\Models\Training;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components;

class TrainingResource extends Resource
{
    protected static ?string $model = Training::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Sales';
    protected static ?string $navigationLabel = 'Trainings';
    protected static ?int $navigationSort = 5;
    protected static ?string $tenantOwnershipRelationshipName = 'team';

    public static function form(Form $form): Form
    {
        $tenant = Filament::getTenant();

        return $form
            ->schema([
                Forms\Components\Select::make('agent_id')
                    ->label('Agent')
                    ->options(fn () => Agent::query()
                        ->when($tenant, fn ($q) => $q->where('team_id', $tenant->id))
                        ->with('user')
                        ->get()
                        ->mapWithKeys(fn ($a) => [$a->id => $a->user->firstname . ' ' . $a->user->lastname]))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('state_id')
                    ->label('State')
                    ->options(fn () => State::query()->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live(),
                Forms\Components\Select::make('lga_id')
                    ->label('LGA')
                    ->options(fn (Forms\Get $get) => Lga::query()
                        ->when($get('state_id'), fn ($q, $state) => $q->where('state_id', $state))
                        ->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->rows(3),
                Forms\Components\TextInput::make('venue')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('number_of_participants')
                    ->numeric()
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date'),
                Forms\Components\Select::make('status')
                    ->options([
                        'planned' => 'Planned',
                        'ongoing' => 'Ongoing',
                        'completed' => 'Completed',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('females')
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('males')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agent.user.firstname')
                    ->label('Agent')
                    ->getStateUsing(fn ($record) => $record->agent?->user?->firstname . ' ' . $record->agent?->user?->lastname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('venue')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->label('Location')
                    ->getStateUsing(fn ($record) => "{$record->agent->state->name}, {$record->agent->lga->name}")
                    ->searchable(),
                Tables\Columns\TextColumn::make('number_of_participants')
                    ->numeric()
                    ->label('Participants')
                    ->sortable(),
                Tables\Columns\TextColumn::make('females')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('males')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $tenant = Filament::getTenant();
        return parent::getEloquentQuery()
            ->when($tenant, fn (Builder $q) => $q->whereHas('agent', fn (Builder $a) => $a->where('team_id', $tenant->id)));
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Training Summary')
                    ->schema([
                        Components\TextEntry::make('title')
                            ->label('Title'),
                        Components\TextEntry::make('start_date')
                            ->label('Start Date')
                            ->date(),
                        Components\TextEntry::make('end_date')
                            ->label('End Date')
                            ->date(),
                        Components\TextEntry::make('agent_name')
                            ->label('Agent')
                            ->getStateUsing(fn (Training $record) => $record->agent?->user?->firstname . ' ' . $record->agent?->user?->lastname),
                        Components\TextEntry::make('venue')
                            ->label('Venue'),
                        Components\TextEntry::make('location')
                            ->label('Location')
                            ->getStateUsing(fn (Training $record) => ($record->state?->name ?? '') . ', ' . ($record->lga?->name ?? '')),
                    ])
                    ->columns(3),

                Components\Section::make('Participants')
                    ->schema([
                        Components\TextEntry::make('number_of_participants')
                            ->label('Total Participants'),
                        Components\TextEntry::make('females')
                            ->label('Females'),
                        Components\TextEntry::make('males')
                            ->label('Males'),
                    ])
                    ->columns(3),

                Components\Section::make('Details')
                    ->schema([
                        Components\TextEntry::make('description')
                            ->label('Description'),
                    ])
                    ->columns(1),

                Components\Section::make('Attachments')
                    ->schema([
                        Components\TextEntry::make('participant_list')
                            ->label('Participant List')
                            ->url(fn (Training $record) => $record->participant_list)
                            ->openUrlInNewTab()
                            ->placeholder('No participant list provided')
                            ->formatStateUsing(fn ($state) => $state ? 'Open Document' : 'Not provided'),
                        Components\TextEntry::make('images_link')
                            ->label('Images')
                            ->placeholder('No images provided')
                            ->url(fn (Training $record) => $record->images_link)
                            ->openUrlInNewTab()
                            ->formatStateUsing(fn ($state) => $state ? 'Open Images' : 'Not provided'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainings::route('/'),
            'view' => Pages\ViewTraining::route('/{record}'),
        ];
    }
}
