<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\AggregationCenterResource\Pages;
use App\Filament\AgroInput\Resources\AggregationCenterResource\RelationManagers;
use App\Filament\AgroInput\Resources\AggregationCenterResource\RelationManagers\CommodityAggregationsRelationManager;
use App\Models\AggregationCenter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Facades\Filament;

class AggregationCenterResource extends Resource
{
    protected static ?string $model = AggregationCenter::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-pointing-in';

    protected static ?string $navigationGroup = 'Aggregations';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        $tenant = Filament::getTenant();

        return static::getModel()::where('team_id', $tenant->id ?? null)->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('team_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('state_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lga_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_person')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_person_phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_person_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('latitude')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('longitude')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->label('State')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->label('LGA')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_person')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_person_phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_person_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
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
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Center Information')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('address'),
                        TextEntry::make('state.name')->label('State'),
                        TextEntry::make('lga.name')->label('LGA'),
                        TextEntry::make('contact_person'),
                        TextEntry::make('contact_person_phone'),
                        TextEntry::make('contact_person_email'),

                    ])->columns(4)
            ]);
    }
    public static function getRelations(): array
    {
        return [
            CommodityAggregationsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAggregationCenters::route('/'),
            'create' => Pages\CreateAggregationCenter::route('/create'),
            'view' => Pages\ViewAggregationCenter::route('/{record}'),
            // 'edit' => Pages\EditAggregationCenter::route('/{record}/edit'),
        ];
    }
}
