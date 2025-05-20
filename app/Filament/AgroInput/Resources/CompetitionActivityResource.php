<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\CompetitionActivityResource\Pages;
use App\Filament\AgroInput\Resources\CompetitionActivityResource\RelationManagers;
use App\Models\CompetitionActivity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Facades\Filament;

class CompetitionActivityResource extends Resource
{
    protected static ?string $model = CompetitionActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationGroup = 'Market Intelligence Reports';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Competition Activities';

    public static function getNavigationBadge(): ?string
    {
        $tenant = Filament::getTenant();

        return static::getModel()::where('team_id', $tenant->id ?? null)->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team_id')
                    ->relationship('team', 'name')
                    ->required(),
                Forms\Components\TextInput::make('competition')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('activity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('state_id')
                    ->relationship('state', 'name')
                    ->preload()
                    ->searchable()
                    ->live()
                    ->required(),
                Forms\Components\Select::make('lga_id')
                    ->relationship('lga', 'name')
                    ->preload()
                    ->searchable()
                    ->live()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('competition')
                    ->searchable(),
                Tables\Columns\TextColumn::make('activity')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Reported At')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCompetitionActivities::route('/'),
            // 'create' => Pages\CreateCompetitionActivity::route('/create'),
            // 'edit' => Pages\EditCompetitionActivity::route('/{record}/edit'),
        ];
    }
}
