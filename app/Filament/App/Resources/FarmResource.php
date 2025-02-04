<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\FarmResource\Pages;
use App\Filament\App\Resources\FarmResource\RelationManagers;
use App\Models\Farm;
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

class FarmResource extends Resource
{
    protected static ?string $model = Farm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Farm Lands';

    protected static ?string $navigationGroup = 'Sales Information';

    protected static bool $shouldRegisterNavigation = false;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->maxLength(36)
                    ->default(null),
                Forms\Components\TextInput::make('farmer_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('description')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('size')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('state_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lga_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('long')
                    ->required()
                    ->maxLength(255)
                    ->default(0.0),
                Forms\Components\TextInput::make('lat')
                    ->required()
                    ->maxLength(255)
                    ->default(0.0),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->numeric()
                    ->default(1),
                Forms\Components\TextInput::make('map_bounds')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\FileUpload::make('map_image')
                    ->image(),
                Forms\Components\DateTimePicker::make('mapping_started'),
                Forms\Components\DateTimePicker::make('mapping_ended'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('uuid')
                    ->label('UUID')
                    ->searchable(),
                Tables\Columns\TextColumn::make('farmer_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('size')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lga_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('long')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->numeric()
                    ->sortable(),
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
                Tables\Columns\TextColumn::make('map_bounds')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('map_image'),
                Tables\Columns\TextColumn::make('mapping_started')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mapping_ended')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListFarms::route('/'),
            'create' => Pages\CreateFarm::route('/create'),
            'view' => Pages\ViewFarm::route('/{record}'),
            'edit' => Pages\EditFarm::route('/{record}/edit'),
        ];
    }
}
