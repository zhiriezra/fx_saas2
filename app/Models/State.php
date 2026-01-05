<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function agents()
    {
        return $this->hasMany(Agent::class, 'state_id', 'id');
    }

}
