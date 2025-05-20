<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\DemoResource\Pages;
use App\Filament\AgroInput\Resources\DemoResource\RelationManagers;
use App\Filament\AgroInput\Resources\FarmSeasonResource\RelationManagers\FarmVisitationsRelationManager;
use App\Models\Demo;
use App\Models\FarmSeason;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Facades\Filament;


class DemoResource extends Resource
{
    protected static ?string $model = FarmSeason::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Sales';
    protected static ?string $navigationLabel = 'Demos';
    protected static ?string $modelLabel = 'Demonstration Plot';



    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        $tenant = Filament::getTenant();

        return static::getModel()::where('team_id', $tenant->id ?? null)->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('commodity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('planted_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harvest_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('state')
                    ->getStateUsing(fn($record) => $record->farm->state->name),
                TextColumn::make('lga')
                    ->getStateUsing(fn($record) => $record->farm->lga->name),
                TextColumn::make('Location Description')
                    ->getStateUsing(fn($record) => $record->farm->address),
                TextColumn::make('latitude')
                    ->getStateUsing(fn($record) => $record->farm->lat),
                TextColumn::make('longitude')
                    ->getStateUsing(fn($record) => $record->farm->long),
                Tables\Columns\TextColumn::make('season_year')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infoList(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Demo Information')
                    ->schema([
                        TextEntry::make('commodity'),
                        TextEntry::make('planted_date')
                            ->label('Planted Date'),
                        TextEntry::make('harvest_date')
                            ->label('Harvest Date'),
                        TextEntry::make('season_year')
                            ->label('Season Year'),
                    ])->columns(4),
                Section::make('Agent Information')
                    ->schema([
                        TextEntry::make('Name')
                            ->getStateUsing(fn($record) => $record->farm->farmer->agent->user->firstname . ' ' . $record->farm->farmer->agent->user->firstname),
                        TextEntry::make('Phone')
                            ->getStateUsing(fn($record) => $record->farm->farmer->agent->user->phone),
                        TextEntry::make('Email')
                            ->getStateUsing(fn($record) => $record->farm->farmer->agent->user->email),
                        TextEntry::make('State')
                            ->getStateUsing(fn($record) => $record->farm->farmer->agent->state->name),
                        TextEntry::make('LGA')
                            ->label('LGA')
                            ->getStateUsing(fn($record) => $record->farm->farmer->agent->lga->name),
                        TextEntry::make('marital_status')
                            ->getStateUsing(fn($record) => $record->farm->farmer->agent->marital_status),
                        TextEntry::make('gender')
                            ->getStateUsing(fn($record) => $record->farm->farmer->agent->gender),



                    ])->columns(4),
                Section::make('Farm Location')
                    ->schema([
                        TextEntry::make('farm.state.name')
                            ->label('State'),
                        TextEntry::make('farm.lga.name')
                            ->label('LGA'),
                        TextEntry::make('farm.address')
                            ->label('Location Description'),
                        TextEntry::make('farm.lat')
                            ->label('Latitude'),
                        TextEntry::make('farm.long')
                            ->label('Longitude'),
                    ])->columns(3),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FarmVisitationsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDemos::route('/'),
            // 'create' => Pages\CreateDemo::route('/create'),
            'view' => Pages\ViewDemo::route('/{record}'),
            // 'edit' => Pages\EditDemo::route('/{record}/edit'),
        ];
    }
}
