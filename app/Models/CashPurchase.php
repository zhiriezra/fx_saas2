<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashPurchase extends Model
{
    use HasFactory;

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function items()
    {
        return $this->hasMany(CashPurchaseItem::class);
    }

    public function team()
    {
        return $this->hasOneThrough(
            Team::class,
            Agent::class,
            'id',
            'id',
            'agent_id',
            'team_id'
        );
    }
}
