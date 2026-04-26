<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\QuoteRequest;
use App\Models\Country;
use App\Models\Lga;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{

    public function agentsByState(Request $request)
    {
        $country = Country::where('name', $request->country)->first();
        if (!$country) {
            return response()->json([
                "status" => true,
                "data" => [
                    "total_agents" => 0,
                    "total_lgas_with_agents" => 0,
                    "lgas" => []
                ]
            ]);
        }

        $state = State::where('name', $request->state)->where('country_id', $country->id)->first();
        if (!$state) {
            return response()->json([
                "status" => true,
                "data" => [
                    "total_agents" => 0,
                    "total_lgas_with_agents" => 0,
                    "lgas" => []
                ]
            ]);
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

    public function showQuoteForm(Request $request)
    {
        $type = $request->query('type');
        if (!in_array($type, ['quote', 'demo', 'both'])) {
            $type = 'quote';
        }
        return view('quotation', ['type' => $type]);
    }

    public function submitQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'request_type' => ['required', 'in:quote,demo,both'],
            'message' => ['nullable', 'string'],
            'preferred_date' => ['nullable', 'date'],
            'preferred_time' => ['nullable', 'string', 'max:50'],
        ]);

        try {
            QuoteRequest::create($validated);
        } catch (\Throwable $e) {
            $payload = $validated + ['created_at' => now()->toDateTimeString()];
            $existing = [];
            if (Storage::exists('quote_requests.json')) {
                $existing = json_decode(Storage::get('quote_requests.json'), true) ?: [];
            }
            $existing[] = $payload;
            Storage::put('quote_requests.json', json_encode($existing));
        }

        return redirect()->route('quotation')->with('status', 'submitted');
    }
}
