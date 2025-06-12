<?php

namespace App\Filament\Partners\Resources;

use App\Filament\Partners\Resources\AgentResource\Pages;
use App\Filament\Partners\Resources\AgentResource\RelationManagers;
use App\Models\Agent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('team_id')
                    ->numeric(),
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->maxLength(36),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('business_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('bvn')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nin')
                    ->maxLength(255),
                Forms\Components\TextInput::make('gender')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('dob'),
                Forms\Components\TextInput::make('marital_status')
                    ->maxLength(255),
                Forms\Components\TextInput::make('dependants')
                    ->maxLength(255),
                Forms\Components\TextInput::make('mother_tongue')
                    ->maxLength(255),
                Forms\Components\TextInput::make('bike')
                    ->maxLength(255),
                Forms\Components\TextInput::make('tablet')
                    ->maxLength(255),
                Forms\Components\TextInput::make('monthly_income')
                    ->maxLength(255),
                Forms\Components\TextInput::make('current_location')
                    ->maxLength(255),
                Forms\Components\TextInput::make('permanent_address')
                    ->maxLength(255),
                Forms\Components\TextInput::make('company_id')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('state_id')
                    ->numeric(),
                Forms\Components\TextInput::make('lga_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('community')
                    ->maxLength(255),
                Forms\Components\TextInput::make('lat')
                    ->maxLength(255),
                Forms\Components\TextInput::make('lng')
                    ->maxLength(255),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Agent ID')
                    ->getStateUsing(fn ($record) => 'EXAF-'. $record->id)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Full Name')
                    ->getStateUsing(fn ($record) => $record->user->firstname . ' ' . $record->user->lastname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marital_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->label('State')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->label('LGA')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('community')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->label('Date of Birth')
                    ->sortable(),
                Tables\Columns\TextColumn::make('dependants')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_tongue')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bike')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tablet')
                    ->searchable(),
                Tables\Columns\TextColumn::make('monthly_income')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lng')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                
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
            'index' => Pages\ListAgents::route('/'),
            'create' => Pages\CreateAgent::route('/create'),
            'edit' => Pages\EditAgent::route('/{record}/edit'),
        ];
    }
}
