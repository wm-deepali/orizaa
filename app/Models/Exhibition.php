<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Exhibition extends Model
{
    protected $fillable = [
        'title',
        'venue',
        'from_date',
        'to_date',
        'subtitle',
        'image',
        'slug',
        'meta_title',
        'meta_description',
        'status'
    ];

    /**
     * Boot method for auto slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($exhibition) {
            if (empty($exhibition->slug)) {
                $exhibition->slug = Str::slug($exhibition->title);
            }
        });
    }

    /**
     * Relation: Exhibition has many gallery images
     */
    public function galleries()
    {
        return $this->hasMany(ExhibitionGallery::class);
    }

    /**
     * Scope: Active exhibitions
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Route model binding by slug
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}