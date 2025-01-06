<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FarmSeason extends Model
{
    use HasFactory;

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

}
