<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'discountPrice', 'status'
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'discountId');
    }
}
