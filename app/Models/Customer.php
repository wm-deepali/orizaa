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

    // ================= RELATIONS =================

    // STATE
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    // CITY
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // ORDERS
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    // ADDRESSES
    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    // REVIEWS
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }

    // WISHLIST
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'user_id');
    }

    // ================= HELPERS (VERY USEFUL) =================

    // Total Orders Count
    public function getOrdersCountAttribute()
    {
        return $this->orders()->count();
    }

    // Total Spend
    public function getTotalSpentAttribute()
    {
        return $this->orders()->sum('total');
    }

    // Default Address
    public function defaultAddress()
    {
        return $this->hasOne(Address::class, 'user_id')->where('is_default', 1);
    }
}