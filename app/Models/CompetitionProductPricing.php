<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitionProductPricing extends Model
{
    use HasFactory;

    protected $guarded = [''];

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
