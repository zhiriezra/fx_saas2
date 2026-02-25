<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\CashPurchaseResource\Pages;
use App\Filament\AgroInput\Resources\CashPurchaseResource\RelationManagers\ItemsRelationManager;
use App\Models\Agent;
use App\Models\CashPurchase;
use App\Models\Vendor;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;

class CashPurchaseResource extends Resource
{
    protected static ?string $model = CashPurchase::class;

    protected static ?string $modelLabel = 'Cash Purchases';
    protected static ?string $navigationLabel = 'Cash Purchases';
    protected static ?string $navigationGroup = 'Sales Information';
    protected static ?int $navigationSort = 3;
    protected static ?string $tenantOwnershipRelationshipName = 'team';
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    public static function form(Form $form): Form
    {
        $tenant = Filament::getTenant();

        return $form
            ->schema([
                Forms\Components\Select::make('agent_id')
                    ->label('Agent')
                    ->options(fn () => Agent::query()
                        ->when($tenant, fn ($q) => $q->where('team_id', $tenant->id))
                        ->with('user')
                        ->get()
                        ->mapWithKeys(fn ($a) => [$a->id => $a->user->firstname . ' ' . $a->user->lastname]))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('vendor_id')
                    ->label('Vendor')
                    ->options(fn () => Vendor::query()
                        ->when($tenant, fn ($q) => $q->where('team_id', $tenant->id))
                        ->get()
                        ->mapWithKeys(fn ($v) => [$v->id => $v->business_name ?? ('Vendor #' . $v->id)]))
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('date_purchased')
                    ->label('Date Purchased')
                    ->required(),
                Forms\Components\TextInput::make('remark')
                    ->label('Remark')
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('agent.user.firstname')
                    ->label('Agent')
                    ->getStateUsing(fn ($record) => $record->agent?->user?->firstname . ' ' . $record->agent?->user?->lastname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('vendor.business_name')
                    ->label('Vendor Business')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vendor.user.firstname')
                    ->label('Vendor')
                    ->formatStateUsing(fn ($state, $record) => $record->vendor->user->firstname . ' ' . $record->vendor->user->lastname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('items_sum_amount')
                    ->label('Total Amount')
                    ->money('NGN')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        0 => 'Pending',
                        1 => 'Approved',
                        2 => 'Rejected',
                        default => 'Unknown',
                    }),
                Tables\Columns\TextColumn::make('date_purchased')
                    ->label('Date Logged')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Purchase Details')
                    ->schema([
                        TextEntry::make('agent.user.firstname')
                            ->label('Agent')
                            ->formatStateUsing(fn ($state, $record) => $record->agent->user->firstname . ' ' . $record->agent->user->lastname),

                        TextEntry::make('location')
                            ->label('Location')
                            ->state(fn ($record) => ($record->agent->state->name ?? 'N/A') . ', ' . ($record->agent->lga->name ?? 'N/A')),

                        TextEntry::make('vendor.user.firstname')
                            ->label('Vendor')
                            ->formatStateUsing(fn ($state, $record) => $record->vendor->user->firstname . ' ' . $record->vendor->user->lastname),

                        TextEntry::make('date_purchased')
                            ->label('Date Purchased')
                            ->date(),
                        TextEntry::make('remark')
                            ->label('Remark'),
                        TextEntry::make('total_amount')
                            ->label('Total Amount')
                            ->state(fn ($record) => $record->items->sum('amount'))
                            ->numeric(decimalPlaces: 2)
                            ->prefix('₦'),
                        TextEntry::make('status')
                            ->label('Status')
                            ->formatStateUsing(fn ($state) => match ($state) {
                                0 => 'Pending',
                                1 => 'Approved',
                                2 => 'Rejected',
                                default => 'Unknown',
                            }),
                    ])
                    ->columns(2),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $tenant = Filament::getTenant();
        return parent::getEloquentQuery()
            ->when($tenant, fn (Builder $q) => $q->whereHas('agent', fn (Builder $a) => $a->where('team_id', $tenant->id)))
            ->withSum('items', 'amount');
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCashPurchases::route('/'),
            'view' => Pages\ViewCashPurchase::route('/{record}'),
        ];
    }
}

