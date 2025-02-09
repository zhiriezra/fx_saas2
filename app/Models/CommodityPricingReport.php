<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityPricingReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'commodity',
        'unit',
        'price',
        'team_id',
        'state_id',
        'lga_id',
        'location',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }
}
