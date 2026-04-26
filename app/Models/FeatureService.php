<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureService extends Model
{
    use HasFactory;

    protected $fillable = [
        'feature_id',
        'service_id',
        'active',
        'type',
    ];

    /**
     * Get the feature that owns the feature service.
     */
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    /**
     * Get the service that owns the feature service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
