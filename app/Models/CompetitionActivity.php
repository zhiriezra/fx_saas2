<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompetitionActivity extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function team(): BelongsTo{
        return $this->belongsTo(Team::class);
    }

    public function state(): BelongsTo{
        return $this->belongsTo(State::class);
    }

    public function lga(): BelongsTo{
        return $this->belongsTo(Lga::class);
    }
}
