<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariants extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stock', 'salePrice', 'costPrice', 'saleCount',
    'rating', 'new', 'colorId', 'sizeId', 'discountId', 'productId', 'status'
    ];


    public function product()
    {
        return $this->belongsTo(Products::class, 'productId');
    }

    public function color()
    {
        return $this->belongsTo(Colors::class, 'colorId');
    }

    public function size()
    {
        return $this->belongsTo(Sizes::class, 'sizeId');
    }

    public function discount()
    {
        return $this->belongsTo(Discounts::class, 'discountId');
    }
}
