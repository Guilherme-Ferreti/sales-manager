<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)
                ->using(OrderProduct::class)
                ->withPivot('quantity', 'selling_price')
                ->withTimestamps();
    }
}
