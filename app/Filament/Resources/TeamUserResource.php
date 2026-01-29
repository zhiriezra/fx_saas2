<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamUserResource\Pages;
use App\Filament\Resources\TeamUserResource\RelationManagers;
use App\Models\TeamUser;
use App\Models\Team;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeamUserResource extends Resource
{
    protected static ?string $model = TeamUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Team Management';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('team_id')
                    ->options(Team::all()->pluck('name', 'id')->filter())
                    ->live()
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('user_id')
                    ->options(User::where('user_type_id', 4)->get()->mapWithKeys(fn ($user) => [
                        $user->id => trim("{$user->firstname} {$user->lastname}")
                    ])->filter())
                    ->live()
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('team.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('User')
                    ->getStateUsing(fn ($record) => $record->user->firstname . ' ' . $record->user->lastname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.phone')
                    ->label('Phone')
                    ->searchable(),
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
            'index' => Pages\ListTeamUsers::route('/'),
            'create' => Pages\CreateTeamUser::route('/create'),
            'edit' => Pages\EditTeamUser::route('/{record}/edit'),
        ];
    }
}
