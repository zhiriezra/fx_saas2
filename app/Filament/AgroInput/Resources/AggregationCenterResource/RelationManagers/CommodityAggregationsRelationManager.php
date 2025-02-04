<?php

namespace App\Filament\AgroInput\Resources\AggregationCenterResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommodityAggregationsRelationManager extends RelationManager
{
    protected static string $relationship = 'commodity_aggregations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('commodity')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('commodity')
            ->columns([
                Tables\Columns\TextColumn::make('commodity'),
                TextColumn::make('quantity'),
                TextColumn::make('unit'),
                TextColumn::make('Agent')
                    ->getStateUsing(function ($record) {
                        return $record->agent->user->firstname. ' '. $record->agent->user->lastname;
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
