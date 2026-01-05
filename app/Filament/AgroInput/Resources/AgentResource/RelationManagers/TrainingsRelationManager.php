<?php

namespace App\Filament\AgroInput\Resources\AgentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Grid;

class TrainingsRelationManager extends RelationManager
{
    protected static string $relationship = 'trainings';

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
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable(),
                Tables\Columns\TextColumn::make('venue')
                    ->searchable(),
                Tables\Columns\TextColumn::make('state.name'),
                Tables\Columns\TextColumn::make('lga.name'),
                Tables\Columns\TextColumn::make('number_of_participants')
                    ->label('Participants')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('start_date'),
                Tables\Columns\TextColumn::make('end_date'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->slideOver(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Training Details')
                    ->description('Essential information about the training session')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        TextEntry::make('title')
                            ->label('Training Title')
                            ->size(TextEntry\TextEntrySize::Large)
                            ->weight('bold')
                            ->color('primary'),
                        TextEntry::make('description')
                            ->label('Description')
                            ->markdown()
                            ->columnSpanFull(),
                        TextEntry::make('start_date')
                            ->label('Start Date')
                            ->date()
                            ->icon('heroicon-m-calendar'),
                        TextEntry::make('end_date')
                            ->label('End Date')
                            ->date()
                            ->icon('heroicon-m-calendar'),
                        TextEntry::make('venue')
                            ->label('Venue')
                            ->icon('heroicon-m-map-pin'),
                        TextEntry::make('state.name')
                            ->label('State')
                            ->icon('heroicon-m-flag'),
                        TextEntry::make('lga.name')
                            ->label('Local Government Area')
                            ->icon('heroicon-m-building-office'),
                    ])
                    ->columns(3)
                    ->collapsible()
                    ->collapsed(false),

                Section::make('Participant Statistics')
                    ->description('Summary of attendance and demographics')
                    ->icon('heroicon-o-chart-bar')
                    ->schema([
                        TextEntry::make('number_of_participants')
                            ->label('Total Participants')
                            ->badge()
                            ->color('success')
                            ->icon('heroicon-m-users'),
                        TextEntry::make('females')
                            ->label('Female Participants')
                            ->badge()
                            ->color('warning')
                            ->icon('heroicon-m-user'),
                        TextEntry::make('males')
                            ->label('Male Participants')
                            ->badge()
                            ->color('info')
                            ->icon('heroicon-m-user'),
                        TextEntry::make('participant_list')
                            ->label('Participant Link')
                            ->url(fn ($record) => $record->participant_list)
                            ->icon('heroicon-m-link'),
                        TextEntry::make('images_link')
                            ->label('Images Link')
                            ->url(fn ($record) => $record->images_link)
                            ->icon('heroicon-m-link'),
                    ])
                    ->columns(3)
                    ->collapsible()
                    ->collapsed(false),

                Section::make('Participant List')
                    ->description('Detailed information about each participant')
                    ->icon('heroicon-o-user-group')
                    ->schema([
                        RepeatableEntry::make('participants')
                            ->label('')
                            ->schema([
                                // Header with image and basic info
                                Grid::make()
                                    ->columns(12)
                                    ->schema([
                                        ImageEntry::make('farmer.image_path')
                                            ->circular()
                                            ->height(80)
                                            ->width(80)
                                            ->columnSpan(2),
                                        Grid::make()
                                            ->columns(1)
                                            ->columnSpan(10)
                                            ->schema([
                                                TextEntry::make('farmer.fname')
                                                    ->label('Farmer Name')
                                                    ->getStateUsing(fn ($record) => $record->farmer->fname . ' ' . $record->farmer->mname . ' ' . $record->farmer->lname)
                                                    ->size(TextEntry\TextEntrySize::Large)
                                                    ->weight('bold')
                                                    ->color('primary'),
                                                Grid::make()
                                                    ->columns(3)
                                                    ->schema([
                                                        TextEntry::make('farmer.gender')
                                                            ->label('Gender')
                                                            ->badge()
                                                            ->color(fn (string $state): string => match ($state) {
                                                                'Male' => 'info',
                                                                'Female' => 'warning',
                                                                default => 'gray',
                                                            }),
                                                        TextEntry::make('farmer.phone')
                                                            ->label('Phone')
                                                            ->icon('heroicon-m-phone'),
                                                        TextEntry::make('farmer.dob')
                                                            ->label('Date of Birth')
                                                            ->date()
                                                            ->icon('heroicon-m-cake'),
                                                    ]),
                                            ]),
                                    ]),
                                
                                // Contact and Location Information
                                Grid::make()
                                    ->columns(2)
                                    ->schema([
                                        TextEntry::make('farmer.permanent_address')
                                            ->label('Permanent Address')
                                            ->icon('heroicon-m-home')
                                            ->columnSpanFull(),
                                        TextEntry::make('farmer.residential_status')
                                            ->label('Residential Status')
                                            ->icon('heroicon-m-home'),
                                        TextEntry::make('farmer.state.name')
                                            ->label('State')
                                            ->icon('heroicon-m-flag'),
                                        TextEntry::make('farmer.lga.name')
                                            ->label('LGA')
                                            ->icon('heroicon-m-building-office'),
                                        TextEntry::make('farmer.community')
                                            ->label('Community')
                                            ->icon('heroicon-m-home-modern'),
                                    ]),
                            ])
                            ->columns(1)
                            ->contained(true)
                            ->separator()
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
