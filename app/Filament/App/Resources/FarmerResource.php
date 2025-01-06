<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\FarmerResource\Pages;
use App\Filament\App\Resources\FarmerResource\RelationManagers;
use App\Models\Farmer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FarmerResource extends Resource
{
    protected static ?string $model = Farmer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Sales Information';

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
                Forms\Components\TextInput::make('agent_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('fname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mname')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('lname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('gender')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_address')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('permanent_address')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\DatePicker::make('dob'),
                Forms\Components\TextInput::make('mobile_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bvn')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('nin')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('state_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lga_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('marital_status')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('disability')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('residential_status')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('cooperative_name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('team.name')
                    ->label('Team')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Agent name')
                    ->getStateUsing(fn ($record) => "{$record->agent->user->firstname} {$record->agent->user->lastname}"),
                Tables\Columns\TextColumn::make('fname')
                    ->label('First name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mname')
                    ->label('Middle name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lname')
                    ->label('Last name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('permanent_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bvn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marital_status')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('disability')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('residential_status')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('cooperative_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('status')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Hired Date')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListFarmers::route('/'),
            'create' => Pages\CreateFarmer::route('/create'),
            'view' => Pages\ViewFarmer::route('/{record}'),
            'edit' => Pages\EditFarmer::route('/{record}/edit'),
        ];
    }
}
