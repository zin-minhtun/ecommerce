<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quantity',
    ];

    protected $attributes = [
        'state' => 'active',
    ];

    public function getProduct() {
        return $this->belongsToMany(Product::class, 'product_cart')->withTrashed();
    }

    public function getOrder() {
        return $this->belongsToMany(Order::class, 'cart_order');
    }
}
