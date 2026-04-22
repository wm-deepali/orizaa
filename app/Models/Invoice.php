<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_no',
        'date',

        'customer_name',
        'mobile',
        'email',
        'address',
        'city',
        'state',
        'state_code',
        'gstin',
        'zip',

        'total_taxable',
        'total_tax',
        'total_amount',

        'amount_in_words'
    ];

    // Relationship
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}