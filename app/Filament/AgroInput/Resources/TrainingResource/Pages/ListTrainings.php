<?php

namespace App\Filament\AgroInput\Resources\TrainingResource\Pages;

use App\Filament\AgroInput\Resources\TrainingResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListTrainings extends ListRecords
{
    protected static string $resource = TrainingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            'This Week' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
                ->badge(fn(Builder $query) => $query->where('created_at', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                ->badge(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
