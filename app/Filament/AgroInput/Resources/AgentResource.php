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
use App\Filament\AgroInput\Resources\AgentResource\RelationManagers\TrainingsRelationManager;
use App\Filament\AgroInput\Resources\AgentResource\RelationManagers\FarmersRelationManager;

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
            Tables\Columns\ImageColumn::make('user.profile_image')
                ->label('Image')
                ->circular()
                ->width(50)
                ->height(50),
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
            Tables\Columns\TextColumn::make('state.country.name')
                ->label('Country')
                ->sortable(),
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
                // Tables\Actions\EditAction::make(),
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
                Section::make('Agent Information')
                    ->description('Personal and contact details')
                    ->icon('heroicon-o-user-circle')
                    
                    ->schema([
                        \Filament\Infolists\Components\ImageEntry::make('user.profile_image')
                            ->circular()
                            ->height(80)
                            ->width(80),
                        TextEntry::make('user.firstname')
                            ->label('First Name')
                            ->icon('heroicon-o-user')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight('bold'),
                        TextEntry::make('user.lastname')
                            ->label('Last Name')
                            ->icon('heroicon-o-user')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight('bold'),
                        TextEntry::make('user.phone')
                            ->label('Phone Number')
                            ->icon('heroicon-o-phone')
                            ->url(fn ($record) => "tel:{$record->user->phone}")
                            ->color('primary'),
                        TextEntry::make('user.email')
                            ->label('Email Address')
                            ->icon('heroicon-o-envelope')
                            ->url(fn ($record) => "mailto:{$record->user->email}")
                            ->color('primary'),
                        TextEntry::make('gender')
                            ->label('Gender')
                            ->icon('heroicon-o-identification')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Male' => 'success',
                                'Female' => 'warning',
                                default => 'gray',
                            }),
                        TextEntry::make('marital_status')
                            ->label('Marital Status')
                            ->icon('heroicon-o-heart')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('dependants')
                            ->label('Dependants')
                            ->icon('heroicon-o-users')
                            ->badge()
                            ->color('success'),
                        TextEntry::make('mother_tongue')
                            ->label('Mother Tongue')
                            ->icon('heroicon-o-language'),
                        TextEntry::make('bvn')
                            ->label('BVN')
                            ->icon('heroicon-o-credit-card')
                            ->copyable()
                            ->copyMessage('BVN copied to clipboard')
                            ->copyMessageDuration(1500),
                        TextEntry::make('nin')
                            ->label('NIN')
                            ->icon('heroicon-o-identification')
                            ->copyable()
                            ->copyMessage('NIN copied to clipboard')
                            ->copyMessageDuration(1500),
                    ])
                    ->columns(3),

                Section::make('Location & Financial Details')
                    ->description('Geographic and financial information')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        TextEntry::make('state.name')
                            ->label('State')
                            ->icon('heroicon-o-map')
                            ->badge()
                            ->color('primary'),
                        TextEntry::make('lga.name')
                            ->label('Local Government Area')
                            ->icon('heroicon-o-building-office')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('community')
                            ->label('Community')
                            ->icon('heroicon-o-home')
                            ->badge()
                            ->color('success'),
                        TextEntry::make('current_location')
                            ->label('Current Location')
                            // ->icon('heroicon-o-location-marker')
                            ->markdown()
                            ->color('warning'),
                        TextEntry::make('permanent_address')
                            ->label('Permanent Address')
                            ->icon('heroicon-o-home-modern')
                            ->markdown()
                            ->color('gray'),
                        TextEntry::make('monthly_income')
                            ->label('Monthly Income')
                            ->icon('heroicon-o-banknotes')
                            ->money('NGN')
                            ->color('success')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight('bold'),
                        TextEntry::make('bike')
                            ->label('Bike Ownership')
                            ->icon('heroicon-o-truck')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Yes' => 'success',
                                'No' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('tablet')
                            ->label('Tablet Ownership')
                            ->icon('heroicon-o-device-tablet')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Yes' => 'success',
                                'No' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('lat')
                            ->label('Latitude')
                            ->icon('heroicon-o-globe-alt')
                            ->copyable()
                            ->color('info'),
                        TextEntry::make('lng')
                            ->label('Longitude')
                            ->icon('heroicon-o-globe-alt')
                            ->copyable()
                            ->color('info'),
                    ])
                    ->columns(3)
                    ->collapsible()
                    ->collapsed(),

                Section::make('System Details')
                    ->description('Account and administrative information')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        TextEntry::make('team.name')
                            ->label('Assigned Team')
                            ->icon('heroicon-o-user-group')
                            ->badge()
                            ->color('primary'),
                        TextEntry::make('active')
                            ->label('Account Status')
                            ->icon('heroicon-o-check-circle')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Active' : 'Inactive'),
                        TextEntry::make('company_id')
                            ->label('Company ID')
                            ->icon('heroicon-o-building-library')
                            ->badge()
                            ->color('info'),
                        TextEntry::make('created_at')
                            ->label('Registration Date')
                            ->icon('heroicon-o-calendar')
                            ->dateTime('M d, Y \a\t g:i A')
                            ->color('gray'),
                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->icon('heroicon-o-clock')
                            ->dateTime('M d, Y \a\t g:i A')
                            ->color('gray'),
                    ])
                    ->columns(3)
                    ->collapsible()
                    ->collapsed(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FarmersRelationManager::class,
            TrainingsRelationManager::class,
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
