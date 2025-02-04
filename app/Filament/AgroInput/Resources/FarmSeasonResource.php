<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\FarmSeasonResource\Pages;
use App\Filament\AgroInput\Resources\FarmSeasonResource\RelationManagers;
use App\Filament\AgroInput\Resources\FarmSeasonResource\RelationManagers\FarmVisitationsRelationManager;
use App\Models\FarmSeason;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FarmSeasonResource extends Resource
{
    protected static ?string $model = FarmSeason::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Farm Management';

    protected static ?int $navigationSort = 3;

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
                    ->maxLength(36)
                    ->default(null),
                Forms\Components\TextInput::make('team_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\Select::make('farm_id')
                    ->relationship('farm', 'id')
                    ->required(),
                Forms\Components\DatePicker::make('planted_date')
                    ->required(),
                Forms\Components\DatePicker::make('harvest_date'),
                Forms\Components\TextInput::make('season_year')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('commodity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('status')
                    ->required(),
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
                // Tables\Actions\EditAction::make(),
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
                Section::make('Season Information')
                    ->schema([
                        TextEntry::make('commodity'),
                        TextEntry::make('planted_date')
                            ->label('Planted Date'),
                        TextEntry::make('harvest_date')
                            ->label('Harvest Date'),
                        TextEntry::make('season_year')
                            ->label('Season Year'),
                    ])->columns(4),
                Section::make('Farmer Information')
                    ->schema([
                        TextEntry::make('Name')
                            ->getStateUsing(fn($record) => $record->farm->farmer->fname . ' ' . $record->farm->farmer->mname . ' ' . $record->farm->farmer->lname),
                        TextEntry::make('Mobile')
                            ->getStateUsing(fn($record) => $record->farm->farmer->mobile_no),
                        TextEntry::make('Address')
                            ->getStateUsing(fn($record) => $record->farm->farmer->contact_address),
                        TextEntry::make('Marital Status')
                            ->getStateUsing(fn($record) => $record->farm->farmer->marital_status),
                        TextEntry::make('Gender')
                            ->getStateUsing(fn($record) => $record->farm->farmer->gender),
                        TextEntry::make('Date of Birth')
                            ->getStateUsing(fn($record) => $record->farm->farmer->dob),
                        TextEntry::make('Disability')
                            ->getStateUsing(fn($record) => $record->farm->farmer->disability),
                        TextEntry::make('Cooperative')
                            ->getStateUsing(fn($record) => $record->farm->farmer->cooperative_name),

                        TextEntry::make('farm.size')
                            ->label('Farm Size'),
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
            'index' => Pages\ListFarmSeasons::route('/'),
            'create' => Pages\CreateFarmSeason::route('/create'),
            'view' => Pages\ViewFarmSeason::route('/{record}'),
            'edit' => Pages\EditFarmSeason::route('/{record}/edit'),
        ];
    }
}
