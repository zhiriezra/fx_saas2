<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Country;
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

        $agents = Agent::where('state_id', $state->id)->get();
        $lgaStats = $agents->groupBy('lga_id')
            ->map(function ($group) {
                return [
                    'name' => $group->first()->lga->name,
                    'count' => $group->count()
                ];
            });

        return response()->json(["status" => false, "message" => "success", "data" => [
            'total_agents' => $agents->count(),
            'unique_lga_count' => $lgaStats->count(),
            'lgas' => $lgaStats->values()
        ]], 200);
    }
}
