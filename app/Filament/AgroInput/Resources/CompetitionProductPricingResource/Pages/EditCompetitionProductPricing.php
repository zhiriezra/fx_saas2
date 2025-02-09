<?php

namespace App\Filament\AgroInput\Resources\CompetitionProductPricingResource\Pages;

use App\Filament\AgroInput\Resources\CompetitionProductPricingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompetitionProductPricing extends EditRecord
{
    protected static string $resource = CompetitionProductPricingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
