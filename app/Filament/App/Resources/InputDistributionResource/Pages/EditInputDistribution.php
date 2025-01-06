<?php

namespace App\Filament\App\Resources\InputDistributionResource\Pages;

use App\Filament\App\Resources\InputDistributionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInputDistribution extends EditRecord
{
    protected static string $resource = InputDistributionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
