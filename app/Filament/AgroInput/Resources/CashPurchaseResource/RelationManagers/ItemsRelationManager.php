<?php

namespace App\Filament\AgroInput\Resources\CashPurchaseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('qty')
                    ->label('Quantity')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('amount')
                    ->money('NGN')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\ImageColumn::make('product.manufacturer_product.image')
                    ->circular()
                    ->height(60)
                    ->width(60)
                    ->label('Image'),
                Tables\Columns\TextColumn::make('product.manufacturer_product.name')
                    ->label('Product')
                    ->searchable(),
                Tables\Columns\TextColumn::make('qty')
                    ->label('Quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount')
                    ->money('NGN'),
            ])
            ->filters([])
            ->headerActions([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }
}

