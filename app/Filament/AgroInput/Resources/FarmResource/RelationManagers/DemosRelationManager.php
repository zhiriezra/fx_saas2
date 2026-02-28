<?php

namespace App\Filament\AgroInput\Resources\FarmResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components as Components;
use App\Models\Demo;

class DemosRelationManager extends RelationManager
{
    protected static string $relationship = 'demos';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('activity_date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('designation')
                    ->label('Designation')
                    ->searchable(),
                Tables\Columns\TextColumn::make('stage')
                    ->label('Stage')
                    ->searchable(),
                Tables\Columns\TextColumn::make('project.name')
                    ->label('Project')
                    ->searchable(),
                Tables\Columns\TextColumn::make('attendance')
                    ->label('Attendance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('male')
                    ->label('Male')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('female')
                    ->label('Female')
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->infolist([
                        Components\Section::make('Demo Summary')
                            ->schema([
                                Components\TextEntry::make('activity_date')
                                    ->label('Activity Date')
                                    ->date(),
                                Components\TextEntry::make('designation')
                                    ->label('Designation'),
                                Components\TextEntry::make('stage')
                                    ->label('Stage'),
                                Components\TextEntry::make('season')
                                    ->label('Season'),
                                Components\TextEntry::make('project.name')
                                    ->label('Project'),
                                Components\TextEntry::make('crop.name')
                                    ->label('Crop'),
                                Components\TextEntry::make('demoType.name')
                                    ->label('Demo Type'),
                            ])
                            ->columns(3),
                        Components\Section::make('Participation')
                            ->schema([
                                Components\TextEntry::make('attendance')
                                    ->label('Attendance'),
                                Components\TextEntry::make('male')
                                    ->label('Male'),
                                Components\TextEntry::make('female')
                                    ->label('Female'),
                            ])
                            ->columns(3),
                        Components\Section::make('Notes')
                            ->schema([
                                Components\TextEntry::make('challenges')
                                    ->label('Challenges'),
                                Components\TextEntry::make('observations')
                                    ->label('Observations'),
                            ])
                            ->columns(2),
                        Components\Section::make('Media')
                            ->schema([
                                Components\ImageEntry::make('image_file')
                                    ->label('Image'),
                            ])
                            ->columns(1),
                    ]),
            ])
            ->bulkActions([]);
    }
}

