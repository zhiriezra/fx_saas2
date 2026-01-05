<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'agent_id',
        'farmer_id',
    ];

    public function training()
    {
        return $this->belongsTo(Training::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
