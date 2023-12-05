<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_address',
        'store_location',
        'shipping_method',
    ];

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

}

