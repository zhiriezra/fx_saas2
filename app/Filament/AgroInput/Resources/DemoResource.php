<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\DemoResource\Pages;
use App\Models\Agent;
use App\Models\Demo;
use App\Models\Farm;
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

class DemoResource extends Resource
{
    protected static ?string $model = Demo::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Sales';
    protected static ?string $navigationLabel = 'Demos';
    protected static ?string $modelLabel = 'Demonstration Plot';
    protected static ?int $navigationSort = 4;
    protected static ?string $tenantOwnershipRelationshipName = 'team';


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('activity_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('agent.user.firstname')
                    ->label('Agent')
                    ->getStateUsing(fn ($record) => $record->agent?->user?->firstname . ' ' . $record->agent?->user?->lastname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('Farm Code')
                    ->placeholder('Not Provided')
                    ->searchable(),
                Tables\Columns\TextColumn::make('designation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stage')
                    ->searchable(),
                Tables\Columns\TextColumn::make('attendance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('male')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('female')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('season')
                    ->searchable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $tenant = Filament::getTenant();
        return parent::getEloquentQuery()
            ->when($tenant, fn (Builder $q) => $q->whereHas('agent', fn (Builder $a) => $a->where('team_id', $tenant->id)));
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Demo Summary')
                    ->schema([
                        Components\TextEntry::make('activity_date')
                            ->label('Activity Date')
                            ->date(),
                        Components\TextEntry::make('agent_name')
                            ->label('Agent')
                            ->getStateUsing(fn (Demo $record) => $record->agent?->user?->firstname . ' ' . $record->agent?->user?->lastname),
                        Components\TextEntry::make('code')
                            ->label('Farm Code')
                            ->placeholder('Not Provided'),
                        Components\TextEntry::make('designation')
                            ->label('Designation'),
                        Components\TextEntry::make('stage')
                            ->label('Stage'),
                    ])
                    ->columns(3),

                Components\Section::make('Participation')
                    ->schema([
                        Components\TextEntry::make('attendance')
                            ->label('Attendance'),
                        Components\TextEntry::make('male')
                            ->label('Male'),
                        Components\TextEntry::make('female')
                            ->label('Female'),
                    ])
                    ->columns(3),

                Components\Section::make('Details')
                    ->schema([
                        Components\TextEntry::make('season')
                            ->label('Season'),
                        Components\TextEntry::make('project.name')
                            ->label('Project'),
                        Components\TextEntry::make('crop.name')
                            ->label('Crop'),
                        Components\TextEntry::make('demoType.name')
                            ->label('Demo Type'),
                    ])
                    ->columns(4),

                Components\Section::make('Notes')
                    ->schema([
                        Components\TextEntry::make('challenges')
                            ->label('Challenges'),
                        Components\TextEntry::make('observations')
                            ->label('Observations'),
                    ])
                    ->columns(2),

                Components\Section::make('Media')
                    ->schema([
                        Components\ImageEntry::make('image_file')
                            ->label('Image'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDemos::route('/'),
            'view' => Pages\ViewDemo::route('/{record}'),
        ];
    }
}
