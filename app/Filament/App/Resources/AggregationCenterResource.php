<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\AggregationCenterResource\RelationManagers;
use App\Models\AggregationCenter;
use App\Models\Lga;
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

class AggregationCenterResource extends Resource
{
    protected static ?string $model = AggregationCenter::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-pointing-in';

    protected static ?string $navigationGroup = 'Aggregations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Center Name')
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->label('LGA')
                    ->searchable(),
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
            //
        ];
    }
}
