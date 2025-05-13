<?php

namespace App\Http\Middleware;

use App\Models\TeamType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::user() || Auth::user()->isAdmin()){
            return $next($request);
        }
        if(Auth::user()){
            $user = Auth::user(); // Get the logged-in user
            $team = $user->teams->first();
            // dd($team);
            $team_type = TeamType::where('id', $team->team_type_id)->first();
            return redirect('/'.$team_type->name.'/'.$team->slug);
        }
        abort(403, 'You are not allowed to access this panel');
    }
}
