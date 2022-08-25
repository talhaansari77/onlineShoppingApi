<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    

    protected $fillable = ['name', 'categoryId', "description", "sku", "image", "brand", "tags", 'colors', 'sizes', 'new', 'discountId', 'rating', '', 'status'];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'categoryId');
    }

    public function discount()
    {
        return $this->belongsTo(Discounts::class, 'discountId');
    }
}
