<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmInformationSurvey extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
