<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'alt_phone',
        'address',
        'state_id',
        'city_id',
        'pincode'
    ];

    protected $hidden = [
        'password',
    ];

    // ✅ RELATIONS
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}