<?php

namespace App\Filament\AgroInput\Resources\VendorResource\Pages;

use App\Filament\AgroInput\Resources\VendorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVendor extends EditRecord
{
    protected static string $resource = VendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
