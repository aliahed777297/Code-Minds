<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'service_id',
        'service_name',
        'quantity',
        'price',
        'subtotal'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // العلاقة مع الطلب
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // العلاقة مع الخدمة
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Accessor للحصول على اسم الخدمة
    public function getServiceNameAttribute()
    {
        return $this->service ? $this->service->name : ($this->attributes['service_name'] ?? 'خدمة');
    }

    // Accessor للحصول على المجموع (subtotal) لكل عنصر
    public function getTotalAttribute()
    {
        if (isset($this->attributes['subtotal']) && $this->attributes['subtotal'] !== null) {
            return $this->attributes['subtotal'];
        }

        // fallback: calculate from quantity and price
        $quantity = $this->attributes['quantity'] ?? 0;
        $price = $this->attributes['price'] ?? 0;

        return $quantity * $price;
    }
}