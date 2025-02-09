<?php

namespace App\Filament\AgroInput\Resources\CompetitionProductPricingResource\Pages;

use App\Filament\AgroInput\Resources\CompetitionProductPricingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCompetitionProductPricings extends ListRecords
{
    protected static string $resource = CompetitionProductPricingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
