<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [

        // 🔥 IMPORTANT (old system mapping)
        'old_id',

        // BASIC
        'name',
        'slug',
        'video_url',
        'sub_title',
        'summary',

        // OLD DB FIELDS
        'product_code',
        'brand_id',
        'added_by',
        'sort_order',

        // PRICING
        'mrp',
        'price',
        'discount',
        'discount_type',

        // FLAGS
        'featured',
        'new_arrival',
        'sale',
        'best_seller',

        'is_premium',
        'is_engraving',
        'is_personalized_engraving',
        'is_limited_edition',
        'show_on_website',

        // ✅ NEW FLAGS
        'ready_to_ship',
        'bulk_available',
        'gift_hamper',

        // OTHER
        'sku',
        'min_qty',
        'delivery_time',
        'quality',
        'pan_india',

        'details',
        'delivery_returns',

        'meta_title',
        'meta_description',

        'cart',
        'whatsapp',
        'call',

        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |-------------------------------------------------------------------------- 
    */

    // CATEGORY
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    // SUBCATEGORY
    public function subcategories()
    {
        return $this->belongsToMany(Category::class, 'product_subcategories', 'product_id', 'subcategory_id');
    }

    // OCCASIONS
    public function occasions()
    {
        return $this->belongsToMany(
            GiftingOccasion::class,
            'occasion_product',
            'product_id',
            'occasion_id'
        );
    }

    // CUSTOMIZATION
    public function customizations()
    {
        return $this->belongsToMany(Customization::class, 'customization_product');
    }

    // INCLUSIONS
    public function inclusions()
    {
        return $this->hasMany(ProductInclusion::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    public function getCategoryNamesAttribute()
    {
        return $this->categories->pluck('name')->implode(', ');
    }

    public function getSubcategoryNamesAttribute()
    {
        return $this->subcategories->pluck('name')->implode(', ');
    }

    public function getDisplayImageAttribute()
    {
        // relation loaded ho to query nahi chalegi
        $default = $this->images->where('is_default', 1)->first();

        if ($default && $default->image) {
            return $default->image;
        }

        $first = $this->images->first();

        return $first->image ?? null;
    }
}