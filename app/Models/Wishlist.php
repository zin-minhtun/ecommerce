<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function getProducts()
    {
        return $this->belongsToMany(Product::class, 'product_wishlist');
    }
    public function getProductsWithTrashed()
    {
        return $this->belongsToMany(Product::class, 'product_wishlist')->withTrashed();
    }
}
