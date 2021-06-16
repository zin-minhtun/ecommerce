<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'cost_price',
        'category_id',
        'description',
        'gallery',
    ];

    public function getCart()
    {
        return $this->belongsToMany(Cart::class, 'product_cart');
    }

    public function getCategory()
    {
        return $this->hasMany(Category::class);
    }

    public function getWishlistItems()
    {
        return $this->belongsToMany(Wishlist::class, 'product_wishlist');
    }

    public function getTags ()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getProductPricing ()
    {
        return $this->hasMany(ProductPricing::class);
    }

    public function getDiscountPrice()
    {
        $product_price = $this->price;
        if($this->getProductPricing->first() != null) {
            $disc_percent = $this->getProductPricing->first()->discount_percentage;
            $disc_price = $product_price * ( $disc_percent/100 );
            $disc_price = $product_price - $disc_price;
            return $disc_price;
        }
    }
}
