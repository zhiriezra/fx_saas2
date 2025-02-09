<?php

namespace App\Filament\Exports;

use App\Models\Order;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('product.vendor.business_name')
                ->label('Hubs'),
            ExportColumn::make('product.name')
                ->label('product'),
            ExportColumn::make('Farmer')
                ->getStateUsing(fn($record) => "{$record->farmer->fname} {$record->farmer->lname}")
                ->label('Farmer'),
            ExportColumn::make('Farmer Phone')
                ->getStateUsing(fn($record) => "+234 {$record->farmer->mobile_no}"),
            ExportColumn::make('State')
                ->getStateUsing(fn($record) => "{$record->farmer->state->name}"),
            ExportColumn::make('LGA')
                ->getStateUsing(fn($record) => "{$record->farmer->lga->name}"),
            ExportColumn::make('quantity'),
            ExportColumn::make('product.agent_price')
                ->label('Unit Price'),
            ExportColumn::make('total')
                ->label('Total')
                ->getStateUsing(fn ($record) => ($record->product->agent_price * $record->quantity)),
            ExportColumn::make('status')
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your order export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
