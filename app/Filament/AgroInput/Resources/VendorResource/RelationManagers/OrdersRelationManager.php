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
                TextColumn::make('product.name'),
                TextColumn::make('quantity'),
                TextColumn::make('status'),
                // TextColumn::make('Agent')
                //     ->getStateUsing(fn ($record) => "{$record->agent->user->firstname} {$record->agent->user->lastname}"),
                // TextColumn::make('Agent Phone')
                //     ->getStateUsing(fn ($record) => $record->agent->user->phone),
                // TextColumn::make('Agent Email')
                //     ->getStateUsing(fn ($record) => $record->agent->user->email),
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
