<?php

namespace App\Models;

use App\Observers\AggregationCenterObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

#[ObservedBy([AggregationCenterObserver::class])]
class AggregationCenter extends Model
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
        'name',
        'address',
        'contact_person',
        'contact_person_phone',
        'contact_person_email',
        'latitude',
        'longitude',
        'status',
        'state_id',
        'lga_id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function productAggregations()
    {
        return $this->hasMany(CommodityAggregation::class);
    }

    public function commodity_aggregations()
    {
        return $this->hasMany(CommodityAggregation::class);
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
