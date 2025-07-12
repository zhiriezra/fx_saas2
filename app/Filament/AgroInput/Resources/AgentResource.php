<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\AgentResource\Pages;
use App\Filament\AgroInput\Resources\AgentResource\RelationManagers;
use App\Models\Agent;
use Filament\Facades\Filament;
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

class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;

    protected static ?string $navigationLabel = 'Agents';

    protected static ?string $modelLabel = 'Agent';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Sales';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('team_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->maxLength(36)
                    ->default(null),
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('business_name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('bvn')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('nin')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('gender')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('marital_status')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('dependants')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('mother_tongue')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('bike')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('tablet')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('monthly_income')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('current_location')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('permanent_address')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('company_id')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('state_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('lga_id')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('community')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('lat')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('lng')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('team.name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('user.firstname')
                ->label('First name')
                ->searchable(),
            Tables\Columns\TextColumn::make('user.lastname')
                ->label('Last name')
                ->searchable(),
            Tables\Columns\TextColumn::make('user.email')
                ->label('Email')
                ->searchable(),
            Tables\Columns\TextColumn::make('user.phone')
                ->label('Phone')
                ->searchable(),
            Tables\Columns\TextColumn::make('state.name')
                ->sortable(),
            Tables\Columns\TextColumn::make('lga.name')
                ->searchable(),
            Tables\Columns\IconColumn::make('active')
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

    public static function infolist(Infolist $infolist): Infolist{
        return $infolist
            ->schema([
                Section::make('Personal Information')
                    ->description('')
                    ->schema([
                        TextEntry::make('user.firstname')
                            ->label('First name'),
                        TextEntry::make('user.lastname')
                            ->label('Last name'),
                        TextEntry::make('user.phone')
                            ->label('Phone'),
                        TextEntry::make('user.email')
                            ->label('Email'),
                        TextEntry::make('gender')
                            ->label('Gender'),
                        TextEntry::make('marital_status')
                            ->label('Marital Status'),
                        TextEntry::make('dependants')
                            ->label('Dependants'),
                        TextEntry::make('mother_tonge')
                            ->label('Mother tongue'),
                        TextEntry::make('bnv')
                            ->label('BVN'),
                        TextEntry::make('nin')
                            ->label('NIN'),
                    ])
                    ->columns(4)
                    ->collapsible()
                    ->collapsed(),

                Section::make('Location Information')
                    ->description('')
                    ->schema([
                        TextEntry::make('state.name')
                            ->label('State'),
                        TextEntry::make('lga.name')
                            ->label('LGA'),
                        TextEntry::make('current_location')
                            ->label('Current Location'),
                        TextEntry::make('permanent_address')
                            ->label('Permanent Address'),
                        TextEntry::make('community')
                            ->label('Community'),
                        TextEntry::make('lat')
                            ->label('Latitude'),
                        TextEntry::make('lng')
                            ->label('Longitude'),
                    ])
                    ->columns(4)
                    ->collapsible()
                    ->collapsed(),

                Section::make('Other Information')
                    ->description('')
                    ->schema([
                        TextEntry::make('monthly_income')
                            ->label('Monthly Income')
                            ->money('NGN'),
                        TextEntry::make('bike')
                            ->label('Do you have Bike'),
                        TextEntry::make('tablet')
                            ->label('Do you have Tablet'),
                    ])
                    ->columns(4)
                    ->collapsible(),

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
            'view' => Pages\ViewAgent::route('/{record}'),
            'edit' => Pages\EditAgent::route('/{record}/edit'),
        ];
    }
}
