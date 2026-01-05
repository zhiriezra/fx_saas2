<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\AgentResource\Pages;
use App\Filament\App\Resources\AgentResource\RelationManagers;
use App\Filament\App\Resources\AgentResource\RelationManagers\AggregationsRelationManager;
use App\Filament\App\Resources\AgentResource\RelationManagers\FarmersRelationManager;
use App\Filament\App\Resources\AgentResource\RelationManagers\OrdersRelationManager;
use App\Filament\App\Resources\AgentResource\RelationManagers\TrainingsRelationManager;
use App\Models\Agent;
use Faker\Provider\ar_EG\Text;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Sales Information';

    protected static ?int $navigationSort = 1;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('uuid')
                    ->label('UUID')
                    ->maxLength(36),
                Forms\Components\TextInput::make('team_id')
                    ->numeric(),
                Forms\Components\TextInput::make('business_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('bvn')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nin')
                    ->maxLength(255),
                Forms\Components\TextInput::make('gender')
                    ->maxLength(255),
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
                Forms\Components\TextInput::make('state_id')
                    ->numeric(),
                Forms\Components\TextInput::make('lga_id')
                    ->maxLength(255),
                Forms\Components\TextInput::make('community')
                    ->maxLength(255),
                Forms\Components\Toggle::make('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.firstname')
                    ->label('First name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.lastname')
                    ->label('Last name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.phone')
                    ->label('Mobile number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bvn')
                    ->label('BVN')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nin')
                    ->label('NIN')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mother_tongue')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('permanent_address')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('state.name')
                    ->numeric()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('community')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('State')
                    ->relationship('state', 'name')
                    ->label('Filter by State')
                    ->indicator('State')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('Lga')
                    ->relationship('lga', 'name')
                    ->label('Filter by LGA')
                    ->indicator('LGA')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('gender')
                    ->options([
                        'male' => 'male',
                        'female' => 'female'

                    ])
                    ->label('Filter by Gender')
                    ->indicator('Gender'),

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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Personal Information')
                    ->schema([
                        TextEntry::make('user.firstname')
                            ->label('First name'),
                        TextEntry::make('user.lastname')
                            ->label('Last name'),
                        TextEntry::make('user.email')
                            ->label('Email'),
                        TextEntry::make('user.phone')
                            ->label('Mobile number'),
                        TextEntry::make('gender'),
                        TextEntry::make('marital_status')
                            ->label('Marital Status'),

                    ])->columns(3),

                Section::make('Additional Information')
                    ->schema([
                        TextEntry::make('business_name')
                            ->label('Business Name'),
                        TextEntry::make('bvn')
                            ->label('BVN'),
                        TextEntry::make('nin')
                            ->label('NIN'),
                        TextEntry::make('state.name')
                            ->label('State'),
                        TextEntry::make('lga.name')
                            ->label('LGA'),
                        TextEntry::make('community'),
                        TextEntry::make('permanent_address')
                            ->label('Permanent Address'),

                    ])->columns(3)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FarmersRelationManager::class,
            TrainingsRelationManager::class,
            AggregationsRelationManager::class,
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
