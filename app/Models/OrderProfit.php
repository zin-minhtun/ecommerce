<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProfit extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'total_price',
        'total_cost_price',
        'total_discount_price',
    ];

    public function getOrder()
    {
        return $this->belongsTo(Order::class);
    }
}
