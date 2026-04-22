<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'subtotal',
        'discount',
        'cgst_amount',
        'sgst_amount',
        'igst_amount',
        'gst_type',
        'total_amount'
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
}