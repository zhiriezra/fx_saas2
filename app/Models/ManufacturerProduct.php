<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufacturerProduct extends Model
{
    use HasFactory;

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
