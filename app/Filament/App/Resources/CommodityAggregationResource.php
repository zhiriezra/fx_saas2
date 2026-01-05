<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\CommodityAggregationResource\Pages;
use App\Filament\App\Resources\CommodityAggregationResource\RelationManagers;
use App\Models\CommodityAggregation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommodityAggregationResource extends Resource
{
    protected static ?string $model = CommodityAggregation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Aggregations';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListCommodityAggregations::route('/'),
            'create' => Pages\CreateCommodityAggregation::route('/create'),
            'edit' => Pages\EditCommodityAggregation::route('/{record}/edit'),
        ];
    }
}
