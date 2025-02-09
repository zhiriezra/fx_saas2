<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        // static::addGlobalScope('team', function (Builder $query) {
        //     if (auth()->user()->isTeam()) {
        //         $query->where('team_id', auth()->user()->current_team_id);
        //     }
        // });
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

}
