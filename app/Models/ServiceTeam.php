<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'team_id',
        'value',
        'quantity',
        'quantity_unit_id',
        'duration',
        'price',
        'total',
        'evaluation',
        'settings',
        'start_date',
        'end_date',
        'active',
    ];

    protected $casts = [
        'evaluation' => 'array',
        'settings' => 'array',
        'price' => 'decimal:2',
        'total' => 'decimal:2',
        'quantity' => 'decimal:2',
        'active' => 'boolean',
    ];

    /**
     * Get the quantity unit for the service team.
     */
    public function quantityUnit()
    {
        return $this->belongsTo(Unit::class, 'quantity_unit_id');
    }
}
