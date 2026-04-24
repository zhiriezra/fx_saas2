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

    /**
     * Get the quantity unit for the service.
     */
    public function quantityUnit()
    {
        return $this->belongsTo(Unit::class, 'quantity_unit_id');
    }

    /**
     * Get the units for the service (many-to-many relationship).
     */
    public function units()
    {
        return $this->belongsToMany(Unit::class, 'service_units')
                    ->withTimestamps();
    }

    /**
     * Check if the service requires quantity input.
     */
    public function requiresQuantity()
    {
        return (bool) $this->quantity;
    }

    /**
     * Check if the service requires duration input.
     */
    public function requiresDuration()
    {
        return (bool) $this->duration;
    }
}
