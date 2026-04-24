<?php

namespace App\Filament\AgroInput\Resources;

use App\Filament\AgroInput\Resources\FarmResource\Pages;
use App\Models\Farm;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components as Components;
use App\Filament\AgroInput\Resources\FarmResource\RelationManagers\DemosRelationManager;

class FarmResource extends Resource
{
    protected static ?string $model = Farm::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Sales';
    protected static ?string $navigationLabel = 'Farms';
    protected static ?int $navigationSort = 3;
    protected static ?string $tenantOwnershipRelationshipName = 'team';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Farm Code')
                    ->placeholder('Not Provided')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('farmer.fname')
                    ->label('Farmer')
                    ->getStateUsing(fn ($record) => $record->farmer?->fname . ' ' . $record->farmer?->mname . ' ' . $record->farmer?->lname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('agent.user.firstname')
                    ->label('Agent')
                    ->getStateUsing(fn ($record) => $record->agent?->user?->firstname . ' ' . $record->agent?->user?->lastname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('size')
                    ->label('Size')
                    ->sortable(),
                Tables\Columns\TextColumn::make('estimated_size')
                    ->label('Estimated Size')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('location')
                    ->label('Location')
                    ->getStateUsing(fn ($record) => ($record->state?->name ?? '') . ', ' . ($record->lga?->name ?? ''))
                    ->searchable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        $tenant = Filament::getTenant();
        return parent::getEloquentQuery()
            ->when($tenant, fn (Builder $q) => $q->whereHas('agent', fn (Builder $a) => $a->where('team_id', $tenant->id)))
            ->where('farm_type', 'Demo Plot');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make('Farm Summary')
                    ->schema([
                        Components\TextEntry::make('code')
                            ->placeholder('Not Provided')
                            ->label('Code'),
                        Components\TextEntry::make('farm_type')->label('Type'),
                        Components\TextEntry::make('farmer.fname')
                            ->label('Farmer')
                            ->getStateUsing(fn (Farm $record) => $record->farmer?->fname . ' ' . $record->farmer?->mname . ' ' . $record->farmer?->lname),
                        Components\TextEntry::make('agent.user.firstname')
                            ->label('Agent')
                            ->getStateUsing(fn (Farm $record) => $record->agent?->user?->firstname . ' ' . $record->agent?->user?->lastname),
                    ])
                    ->columns(4),
                Components\Section::make('Location')
                    ->schema([
                        Components\TextEntry::make('state.name')->label('State'),
                        Components\TextEntry::make('lga.name')->label('LGA'),
                        Components\TextEntry::make('address')->label('Address'),
                        Components\TextEntry::make('lat')->label('Latitude'),
                        Components\TextEntry::make('long')->label('Longitude'),
                    ])
                    ->columns(3),
                Components\Section::make('Sizes')
                    ->schema([
                        Components\TextEntry::make('size')->label('Size'),
                        Components\TextEntry::make('estimated_size')->label('Estimated Size'),
                    ])
                    ->columns(2),
                Components\Section::make('Description')
                    ->schema([
                        Components\TextEntry::make('description')->label('Description'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DemosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFarms::route('/'),
            'view' => Pages\ViewFarm::route('/{record}'),
        ];
    }
}
