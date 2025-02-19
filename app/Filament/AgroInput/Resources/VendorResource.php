<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\VendorResource\Pages;
use App\Filament\AgroInput\Resources\VendorResource\RelationManagers;
use App\Filament\AgroInput\Resources\VendorResource\RelationManagers\OrdersRelationManager;
use App\Filament\AgroInput\Resources\VendorResource\RelationManagers\ProductsRelationManager;
use App\Models\Vendor;
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

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $navigationLabel = 'Hubs';

    protected static ?string $modelLabel = 'Hubs';

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationGroup = 'Sales';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        $tenant = Filament::getTenant();

        return static::getModel()::where('team_id', $tenant->id ?? null)->count();
    }

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
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('identification_mode')
                    ->required(),
                Forms\Components\TextInput::make('identification_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('dob')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('gender'),
                Forms\Components\TextInput::make('marital_status'),
                Forms\Components\TextInput::make('current_location')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('permanent_address')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('state_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('lga_id')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('community')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('business_name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('business_address')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('registration_no')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('business_type'),
                Forms\Components\TextInput::make('business_email')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('business_mobile')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('bank')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('account_no')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('account_name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('tin')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('business_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('identification_mode')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('identification_no')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->label('State')
                    ->sortable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->label('Lga')
                    ->searchable(),
                Tables\Columns\TextColumn::make('community')
                    ->searchable(),

                Tables\Columns\TextColumn::make('business_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('registration_no')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('business_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('business_mobile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bank')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_no')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('account_name')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('tin')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
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
                SelectFilter::make('State')
                    ->relationship('state', 'name')
                    ->searchable()
                    ->preload(),
                SelectFilter::make('Lga')
                    ->relationship('lga', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist{
        return $infolist
            ->schema([
                Section::make('Business Information')
                    ->description('Business Information')
                    ->schema([
                        TextEntry::make('business_name')
                            ->label('Business Name'),
                        TextEntry::make('business_address')
                            ->label('Business Address'),
                        TextEntry::make('Identification Information')
                            ->getStateUsing(fn($record) => $record->identification_mode . ' - ' . $record->identification_no),
                        TextEntry::make('registration_no')
                            ->label('CAC Registration Number'),
                        TextEntry::make('business_email')
                            ->label('Business Email'),
                        TextEntry::make('business_mobile')
                            ->label('Business Mobile'),

                    ])->columns(3),
                Section::make('Bank Information')
                    ->description('Bank Information')
                    ->schema([
                        TextEntry::make('bank.name')
                            ->label('Bank'),
                        TextEntry::make('account_no')
                            ->label('Account Number'),
                        TextEntry::make('account_name')
                            ->label('Account Name'),
                        TextEntry::make('tin')
                            ->label('TIN'),
                    ])->columns(4),

            ]);
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class,
            OrdersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'view' => Pages\ViewVendor::route('/{record}'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }
}
