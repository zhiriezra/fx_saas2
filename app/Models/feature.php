<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    /**
     * Get the feature teams for the feature.
     */
    public function featureTeams()
    {
        return $this->hasMany(FeatureTeam::class);
    }

    /**
     * Get the services that belong to the feature.
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'feature_services')
                    ->withPivot('active')
                    ->withTimestamps();
    }
}
