<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount_percentage',
        'product_id',
        'status',
    ];

    public function getProduct()
    {
        return $this->belongsTo(Product::class);
    }
}
