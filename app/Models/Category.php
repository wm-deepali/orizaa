<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'old_id',
        'name',
        'slug',
        'parent_id',
        'sub_title',
        'meta_title',
        'meta_description',
        'image',
        'sort_order',

        'is_popular',
        'status',

        'added_by',
        'is_featured',
        'show_on_website',
        'is_sub_category',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Parent
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Children
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->whereNull('deleted_at'); // ✅ ignore soft deleted
    }

    // PRODUCTS (CATEGORY)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category');
    }

    // PRODUCTS (SUBCATEGORY)
    public function subcategoryProducts()
    {
        return $this->belongsToMany(Product::class, 'product_subcategories', 'subcategory_id', 'product_id');
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES (🔥 VERY USEFUL)
    |--------------------------------------------------------------------------
    */

    // Only active
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Only parent categories
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    // Only subcategories
    public function scopeSubCategories($query)
    {
        return $query->whereNotNull('parent_id');
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS (CLEAN UI)
    |--------------------------------------------------------------------------
    */

    public function getIsParentAttribute()
    {
        return is_null($this->parent_id);
    }

    public function getIsChildAttribute()
    {
        return !is_null($this->parent_id);
    }

    public function getUniqueProductsCountAttribute()
    {
        // Only include active children
        $subcategoryIds = $this->children()
            ->where('status', 1)
            ->pluck('id')
            ->toArray();

        return \App\Models\Product::where(function ($q) use ($subcategoryIds) {

            // ✅ Products linked to ACTIVE category
            $q->whereHas('categories', function ($q2) {
                $q2->where('categories.id', $this->id)
                    ->where('categories.status', 1);
            })

                // ✅ Products linked to ACTIVE subcategories
                ->orWhereHas('subcategories', function ($q3) use ($subcategoryIds) {
                    $q3->whereIn('categories.id', $subcategoryIds)
                        ->where('categories.status', 1);
                });

        })->distinct()->count();
    }
}