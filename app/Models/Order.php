<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'address_id',

        // ✅ pricing (same as cart)
        'subtotal',
        'discount',
        'cgst_amount',
        'sgst_amount',
        'igst_amount',
        'gst_type',
        'total_amount',

        // optional (if still used)
        'amount',

        // payment + status
        'status',
        'payment_id',
        'payment_status',

        // invoice
        'invoice_no'
    ];

    // ================= RELATIONS =================

    public function user()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ================= HELPERS =================

    // ✅ total GST
    public function getGstTotalAttribute()
    {
        return ($this->cgst_amount ?? 0)
             + ($this->sgst_amount ?? 0)
             + ($this->igst_amount ?? 0);
    }

    // ✅ formatted total
    public function getFormattedTotalAttribute()
    {
        return number_format($this->total_amount, 2);
    }
}