<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['session_id', 'user_id', 'total_price', 'customer_name', 'customer_phone', 'customer_address', 'status'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
