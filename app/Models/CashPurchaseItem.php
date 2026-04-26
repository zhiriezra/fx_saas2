<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashPurchaseItem extends Model
{
    use HasFactory;

    protected $table = 'cash_purchase_products';

    public function cashPurchase()
    {
        return $this->belongsTo(CashPurchase::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
