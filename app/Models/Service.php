<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'duration_minutes'];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_minutes' => 'integer',
    ];

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2) . ' ر.س';
    }

    public function getDurationFormattedAttribute()
    {
        if (!$this->duration_minutes) return null;
        $m = $this->duration_minutes;
        if ($m < 60) return $m . ' دقيقة';
        $h = floor($m / 60);
        $rem = $m % 60;
        return $h . ' ساعة' . ($rem ? ' و ' . $rem . ' دقيقة' : '');
    }

    // Scopes for searching and filtering
    public function scopeSearch(Builder $query, ?string $term)
    {
        if (!$term) return $query;
        $term = trim($term);
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%");
        });
    }

    public function scopePriceBetween(Builder $query, $min = null, $max = null)
    {
        if (!is_null($min)) $query->where('price', '>=', $min);
        if (!is_null($max)) $query->where('price', '<=', $max);
        return $query;
    }

    public function scopeDurationMax(Builder $query, $minutes = null)
    {
        if (is_null($minutes)) return $query;
        return $query->where('duration_minutes', '<=', (int) $minutes);
    }

    public function scopeOrdered(Builder $query, $sort = null)
    {
        switch ($sort) {
            case 'price_asc':
                return $query->orderBy('price', 'asc');
            case 'price_desc':
                return $query->orderBy('price', 'desc');
            case 'duration_asc':
                return $query->orderBy('duration_minutes', 'asc');
            case 'duration_desc':
                return $query->orderBy('duration_minutes', 'desc');
            default:
                return $query->orderBy('name', 'asc');
        }
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
