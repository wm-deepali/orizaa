<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierEnquiry extends Model
{
    protected $fillable = [
        'name',
        'company',
        'email',
        'phone',
        'category_id',
        'capacity',
        'moq',
        'description',
        'city',
        'gst',
        'catalogue',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}