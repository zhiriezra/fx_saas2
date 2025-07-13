<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function escrow(){
        return $this->hasMany(Escrow::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function manufacturer_product()
    {
        return $this->belongsTo(ManufacturerProduct::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

}
