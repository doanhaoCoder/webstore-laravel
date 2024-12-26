<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name', 'customer_email', 'customer_phone', 'customer_address', 'total', 'user_id'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Order.php
    public function user()
{
    return $this->belongsTo(User::class);
}

}
