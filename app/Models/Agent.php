<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class);
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

    public function farmers()
    {
        return $this->hasMany(Farmer::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function aggregations()
    {
        return $this->hasMany(CommodityAggregation::class);
    }

}
