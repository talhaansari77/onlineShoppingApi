<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['productName', 'color', 'size', 'qty', 'salePrice', 'costPrice', 'status', 'orderId'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId');
    }
}
