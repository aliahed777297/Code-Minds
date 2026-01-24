<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'subtotal',
        'tax',
        'total',
        'status',
        'payment_status',
        'notes',
        'customer_name',
        'customer_email',
        'customer_phone'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total' => 'decimal:2',
        'created_at' => 'datetime:d/m/Y H:i',
        'updated_at' => 'datetime:d/m/Y H:i',
    ];

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع عناصر الطلب
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessor للحالة بالعربية
    public function getStatusArabicAttribute()
    {
        $statuses = [
            'pending' => 'قيد الانتظار',
            'processing' => 'قيد المعالجة',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }

    // Accessor لحالة الدفع بالعربية
    public function getPaymentStatusArabicAttribute()
    {
        $statuses = [
            'pending' => 'قيد الانتظار',
            'paid' => 'مدفوع',
            'failed' => 'فشل الدفع',
            'refunded' => 'تم الاسترداد',
        ];
        
        return $statuses[$this->payment_status] ?? $this->payment_status;
    }

    // Accessor لتنسيق التاريخ
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d/m/Y - h:i A');
    }

    // دالة لإنشاء رقم طلب فريد
    public static function generateOrderNumber()
    {
        do {
            $number = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
        } while (self::where('order_number', $number)->exists());
        
        return $number;
    }
}