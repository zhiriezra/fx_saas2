<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureTeam extends Model
{
    use HasFactory;

    /**
     * Get the feature that owns the feature team.
     */
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    /**
     * Get the team that owns the feature team.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
