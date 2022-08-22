<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'status'];

    public function variants()
    {
        return $this->hasMany(ProductVariants::class, 'sizeId');
    }
}
