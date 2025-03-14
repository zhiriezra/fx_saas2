<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Country;
use App\Models\Lga;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{

    public function agentsByState(Request $request)
    {
        $country = Country::where('name', $request->country)->first();
        if (!$country) {
            return response()->json(["status" => false, "message" => "Country not found"], 404);
        }

        $state = State::where('name', $request->state)->where('country_id', $country->id)->first();
        if (!$state) {
            return response()->json(["status" => false, "message" => "State not found"], 404);
        }

        $lgas = Lga::where('state_id', $state->id)
            ->withCount('agents')
            ->having('agents_count', '>', 0)
            ->get();

        $totalAgents = Agent::where('state_id', $state->id)->count();

        return response()->json([
            "status" => true,
            "data" => [
                "total_agents" => $totalAgents,
                "total_lgas_with_agents" => $lgas->count(),
                "lgas" => $lgas->map(function($lga) {
                    return [
                        "name" => $lga->name,
                        "agents_count" => $lga->agents_count
                    ];
                })
            ]
        ]);
    }
}
