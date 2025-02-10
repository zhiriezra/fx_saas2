<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class CommodityAggregation extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    protected $fillable = [
        'aggregation_center_id',
        'team_id',
        'agent_id',
        'product_id',
        'quantity',
        'commodity',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function aggregationCenter()
    {
        return $this->belongsTo(AggregationCenter::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

}
