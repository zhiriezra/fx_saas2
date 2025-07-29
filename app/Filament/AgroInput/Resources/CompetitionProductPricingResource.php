<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\CompetitionProductPricingResource\Pages;
use App\Filament\AgroInput\Resources\CompetitionProductPricingResource\RelationManagers;
use App\Models\CompetitionProductPricing;
use App\Models\Lga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use Filament\Facades\Filament;


class CompetitionProductPricingResource extends Resource
{
    protected static ?string $model = CompetitionProductPricing::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static ?string $navigationGroup = 'Market Intelligence Reports';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationLabel = 'Competition Products';
    protected static ?string $modelLabel = 'Competition Product';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('team_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('product')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('competition')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('NGN'),
                    Forms\Components\Select::make('state_id')
                    ->relationship('state', 'name')
                    ->live()
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('lga_id')
                    ->options(fn(Get $get): Collection => Lga::query()
                        ->where('state_id', $get('state_id'))
                        ->get()
                        ->pluck('name', 'id'))
                    ->live()
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('product')
                    ->searchable(),
                Tables\Columns\TextColumn::make('competition')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Selling Price')
                    ->money('NGN')
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Date Reported'),
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
            'index' => Pages\ListCompetitionProductPricings::route('/'),
            'create' => Pages\CreateCompetitionProductPricing::route('/create'),
            'edit' => Pages\EditCompetitionProductPricing::route('/{record}/edit'),
        ];
    }
}
