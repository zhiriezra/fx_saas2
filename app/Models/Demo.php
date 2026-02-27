<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
    use HasFactory;

    protected $fillable = [
            'farm_id',
            'agent_id',
            'image_file',
            'designation',
            'stage',
            'project_id',
            'attendance',
            'male',
            'female',
            'season',
            'crop_id',
            'demo_type_id',
            'challenges',
            'observations',
            'activity_date',
        ];

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
