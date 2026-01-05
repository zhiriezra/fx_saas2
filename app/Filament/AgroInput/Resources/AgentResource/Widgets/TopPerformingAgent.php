<?php

namespace App\Filament\AgroInput\Resources\AgentResource\Widgets;

use App\Models\Agent;
use Filament\Facades\Filament;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class TopPerformingAgent extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected ?string $description = 'Agents ranked by their performance metrics.';

    protected function getHeading(): string
    {
        return 'Top Performing Agents';
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                ImageColumn::make('user.profile_image')
                    ->circular()
                    ->height(50)
                    ->width(50)
                    ->label('Image'),
                TextColumn::make('user.firstname')
                    ->getStateUsing(fn ($record) => $record->user->firstname . ' ' . $record->user->lastname)
                    ->label('Agent Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('state.name')
                    ->label('State')
                    ->searchable(),
                TextColumn::make('lga.name')
                    ->label('LGA')
                    ->searchable(),
                TextColumn::make('total_orders')
                    ->label('Total Orders')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Sum::make()
                            ->label('Total Orders')
                    ]),
                TextColumn::make('order_value')
                    ->label('Order Value (₦)')
                    ->money('NGN')
                    ->sortable()
                    ->summarize([
                        Sum::make()
                            ->label('Total Order Value')
                            ->money('NGN')
                    ]),
                TextColumn::make('commission_earned')
                    ->label('Commission Earned (₦)')
                    ->money('NGN')
                    ->sortable()
                    ->summarize([
                        Sum::make()
                            ->label('Total Commission')
                            ->money('NGN')
                    ]),
                TextColumn::make('total_trainings')
                    ->label('Total Trainings')
                    ->numeric()
                    ->sortable()
                    ->summarize([
                        Sum::make()
                            ->label('Total Trainings')
                    ]),
                TextColumn::make('team.name')
                    ->label('Team')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('state_id')
                    ->label('Filter by State')
                    ->relationship('state', 'name')
                    ->searchable(),
            ])
            ->defaultSort('order_value', 'desc')
            ->paginated(false);
    }

    protected function getTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $tenantId = Filament::getTenant()->id;
        
        return Agent::query()
            ->select([
                'agents.*',
                DB::raw('COALESCE(COUNT(DISTINCT orders.id), 0) as total_orders'),
                DB::raw('COALESCE(SUM(orders.total_amount), 0) as order_value'),
                DB::raw('COALESCE(SUM(orders.commission), 0) as commission_earned'),
                DB::raw('COALESCE(COUNT(DISTINCT trainings.id), 0) as total_trainings')
            ])
            ->leftJoin('orders', 'agents.id', '=', 'orders.agent_id')
            ->leftJoin('order_items', 'orders.id', '=', 'order_items.order_id')
            ->leftJoin('products', 'order_items.product_id', '=', 'products.id')
            ->leftJoin('vendors', 'products.vendor_id', '=', 'vendors.id')
            ->leftJoin('trainings', 'agents.id', '=', 'trainings.agent_id')
            ->where('agents.team_id', $tenantId)
            ->with(['user', 'state', 'lga', 'team'])
            ->groupBy('agents.id');
    }
}
