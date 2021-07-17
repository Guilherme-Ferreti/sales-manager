<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['cep', 'street', 'number', 'neighborhood', 'city', 'state', 'order_id'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
