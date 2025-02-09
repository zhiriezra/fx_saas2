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

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('product.vendor.business_name')
                    ->label('Hubs')
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('Farmer')
                    ->getStateUsing(fn($record) => "{$record->farmer->fname} {$record->farmer->lname}")
                    ->sortable(),
                Tables\Columns\TextColumn::make('Farmer Phone')
                    ->getStateUsing(fn($record) => "+234 {$record->farmer->mobile_no}")
                    ->sortable(),
                Tables\Columns\TextColumn::make('State')
                    ->getStateUsing(fn($record) => "{$record->farmer->state->name}")
                    ->sortable(),
                Tables\Columns\TextColumn::make('LGA')
                    ->getStateUsing(fn($record) => "{$record->farmer->lga->name}")
                    ->sortable(),
                Tables\Columns\TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('product.agent_price')
                    ->label('Unit Price')
                    ->money('NGN')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->getStateUsing(fn ($record) => ($record->product->agent_price * $record->quantity))
                    ->money('NGN'),
                TextColumn::make('created_at')
                    ->label('Date'),
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
