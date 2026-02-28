<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    use HasFactory;

    protected $table = 'demos';

    protected $guarded = [];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }

    public function demoType()
    {
        return $this->belongsTo(DemoType::class);
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
