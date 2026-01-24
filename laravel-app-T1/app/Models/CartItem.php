<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'service_id',
        'quantity',
        'price_at_add',
        'rating',
        'comment'
    ];

    protected $casts = [
        'price_at_add' => 'decimal:2',
    ];

    // Scope للمستخدمين المسجلين
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Scope للزوار (بالجلسة)
    public function scopeForSession($query, $sessionId = null)
    {
        $sessionId = $sessionId ?? session('guest_session_id') ?? session()->getId();
        return $query->where('session_id', $sessionId)->whereNull('user_id');
    }

    // Scope للعناصر الحالية (تستخدم user_id أو session_id حسب الحالة)
    public function scopeCurrent($query)
    {
         if (\Illuminate\Support\Facades\Auth::check()) {
            return $query->forUser(\Illuminate\Support\Facades\Auth::id());
        }

        $sessionId = session('guest_session_id') ?? session()->getId();
        return $query->forSession($sessionId);
    }

    // العلاقة مع المستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // العلاقة مع الخدمة
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // دالة مساعدة للحصول على السعر الإجمالي
    public function getTotalAttribute()
    {
        return $this->quantity * $this->price_at_add;
    }

    // دالة لتحويل عناصر الجلسة إلى مستخدم عند تسجيل الدخول
    public static function migrateSessionToUser($sessionId, $userId)
    {
        return self::where('session_id', $sessionId)
            ->whereNull('user_id')
            ->update([
                'user_id' => $userId,
                'session_id' => null, // نحذف session_id بعد الربط بالمستخدم
            ]);
    }
}