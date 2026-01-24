<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * Get the service settings for the service.
     */
    public function serviceSettings()
    {
        return $this->hasMany(ServiceSetting::class);
    }

    /**
     * Get the features that belong to the service.
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_services')
                    ->withPivot('active')
                    ->withTimestamps();
    }

    /**
     * Get the team type that owns the service.
     */
    public function teamType()
    {
        return $this->belongsTo(TeamType::class);
    }
}
