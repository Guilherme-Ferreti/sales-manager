<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['sold_at'];

    protected $casts = [
        'sold_at' => 'date',
    ];

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->using(OrderProduct::class)
            ->withPivot('quantity', 'selling_price')
            ->withTimestamps();
    }

    public function getTotalItemsAttribute(): int
    {
        return ($this->relationLoaded('products') ? $this->products->sum('pivot.quantity') : 0);
    }

    public function getTotalValueAttribute(): float
    {
        if (! $this->relationLoaded('products')) {
            return 0;
        }

        $total = 0;

        foreach ($this->products as $product) {
            $total += $product->pivot->selling_price * $product->pivot->quantity;
        }
        
        return $total;
    }
}
