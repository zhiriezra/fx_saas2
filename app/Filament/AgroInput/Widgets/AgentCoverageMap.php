<?php

namespace App\Filament\AgroInput\Widgets;

use Filament\Widgets\Widget;
use App\Models\Agent;
use Illuminate\Support\Facades\DB;

class AgentCoverageMap extends Widget
{
    protected static ?string $heading = 'Agent Coverage Map';
    protected static ?int $sort = 3;

    protected static string $view = 'filament.agro-input.widgets.agent-coverage-map';

    public function getAgentData()
    {
        return Agent::select(
                'states.name as state',
                'lgas.name as lga',
                DB::raw('COUNT(*) as agent_count')
            )
            ->join('lgas', 'agents.lga_id', '=', 'lgas.id')
            ->join('states', 'lgas.state_id', '=', 'states.id')
            ->where('agents.active', 1)
            ->groupBy('states.id', 'states.name', 'lgas.id', 'lgas.name')
            ->get()
            ->map(function ($item) {
                return [
                    'state' => $item->state,
                    'lga' => $item->lga,
                    'agent_count' => $item->agent_count,
                ];
            });
    }
} 