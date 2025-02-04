<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Vendor extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function state(){
        return $this->belongsTo(State::class);
    }

    public function lga(){
        return $this->belongsTo(Lga::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function orders(){
        return $this->hasManyThrough(Order::class, Product::class, 'vendor_id', 'product_id');
    }

    public function bank(){
        return $this->belongsTo(Bank::class, 'bank');
    }

}
