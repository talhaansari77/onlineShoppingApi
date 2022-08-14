<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'categoryId', "description", "sku", "image", "brand", "tags"];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'categoryId');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariants::class, 'productId');
    }

    
}
