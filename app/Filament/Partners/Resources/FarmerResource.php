<?php

namespace App\Filament\Partners\Resources;

use App\Filament\Partners\Resources\FarmerResource\Pages;
use App\Filament\Partners\Resources\FarmerResource\RelationManagers;
use App\Models\Farmer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FarmerResource extends Resource
{
    protected static ?string $model = Farmer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $tenantOwnershipRelationshipName = 'team';

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('agent_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('fname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mname')
                    ->maxLength(255),
                Forms\Components\TextInput::make('lname')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('gender')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('contact_address')
                    ->maxLength(255),
                Forms\Components\TextInput::make('permanent_address')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('dob'),
                Forms\Components\TextInput::make('mobile_no')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('bvn')
                    ->maxLength(255),
                Forms\Components\TextInput::make('nin')
                    ->maxLength(255),
                Forms\Components\TextInput::make('state_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lga_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image_path')
                    ->image(),
                Forms\Components\TextInput::make('marital_status')
                    ->maxLength(255),
                Forms\Components\TextInput::make('disability')
                    ->maxLength(255),
                Forms\Components\TextInput::make('residential_status')
                    ->maxLength(255),
                Forms\Components\TextInput::make('cooperative_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->numeric()
                    ->default(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('agent.user.name')
                    ->label('Agent Name')
                    ->getStateUsing(fn ($record) => $record->agent->user->firstname . ' ' . $record->agent->user->lastname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('Farmer Name')
                    ->getStateUsing(fn ($record) => $record->fname . ' ' . $record->mname . ' ' . $record->lname)
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->label('Gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->label('State')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lga.name')
                    ->label('LGA')
                    ->searchable(),
                Tables\Columns\TextColumn::make('marital_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('disability')
                    ->searchable(),
                Tables\Columns\TextColumn::make('residential_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cooperative_name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListFarmers::route('/'),
            'create' => Pages\CreateFarmer::route('/create'),
            'edit' => Pages\EditFarmer::route('/{record}/edit'),
        ];
    }
}
