<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamVisitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'report_title',
        'report_url',
        'active',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
