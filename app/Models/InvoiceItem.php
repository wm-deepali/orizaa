<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'article_no',
        'description',
        'qty',
        'rate',
        'discount',
        'discount_type',
        'gst',
        'price'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}