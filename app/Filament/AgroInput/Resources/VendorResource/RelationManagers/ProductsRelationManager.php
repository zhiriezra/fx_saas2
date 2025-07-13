<?php

namespace App\Filament\AgroInput\Resources\VendorResource\RelationManagers;

use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'products';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('manufacturer_product.image')
                    ->circular()
                    ->height(60)
                    ->width(60)
                    ->label('Image'),
                TextColumn::make('manufacturer_product.name')
                    ->label('Product Name'),
                TextColumn::make('manufacturer_product.manufacturer.name'),
                TextColumn::make('manufacturer_product.sub_category.category.name'),
                TextColumn::make('manufacturer_product.sub_category.name'),
                TextColumn::make('unit_price')
                    ->money('NGN'),
                TextColumn::make('agent_price')
                    ->money('NGN'),
                TextColumn::make('quantity')
                    ->numeric(),
                TextColumn::make('stock_date')
                    ->label('Stock Date'),
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
