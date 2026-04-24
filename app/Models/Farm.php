<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
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

    public function farmSeasons()
    {
        return $this->hasMany(FarmSeason::class);
    }

    public function demos()
    {
        return $this->hasMany(Demo::class);
    }

    public function team()
    {
        return $this->hasOneThrough(
            Team::class,
            Agent::class,
            'id',
            'id',
            'agent_id',
            'team_id'
        );
    }
}
