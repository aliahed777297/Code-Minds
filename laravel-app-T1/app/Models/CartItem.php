<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'service_id',
        'quantity',
        'rating',
        'comment',
        'price_at_add',
    ];

    /* =====================
     | Relationships
     ===================== */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /* =====================
     | Accessors
     ===================== */

    public function getSubtotalAttribute(): float
    {
        return $this->quantity * ($this->service->price ?? 0);
    }
}
