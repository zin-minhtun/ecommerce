<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'city',
        'address',
        'payment_id',
        'payment_receipt',
    ];

    public function getCart()
    {
        return $this->belongsToMany(Cart::class, 'cart_order');
    }

    public function getProfit()
    {
        return $this->hasOne(OrderProfit::class);
    }
}
