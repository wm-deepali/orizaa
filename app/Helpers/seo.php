<?php

use App\Models\SeoPage;

function getSeo()
{
    // Safely get route name
    $route = optional(request()->route())->getName();

    // Route → Page Key mapping
    $map = [

        'home' => 'home',

        'category' => 'category',
        'subcategory' => 'sub_category',

        'products' => 'product_listing',
        'product.detail' => 'product_detail',

        'shopping-cart' => 'cart',

        'about-us' => 'about',
        'why-us' => 'why_choose_us',
        'contact-us' => 'contact',

        'awards' => 'awards',

        'blogs' => 'blog',
        'faqs' => 'faq',

        'recycling-pledge' => 'recycling',

        'engraving-gallery' => 'engraving',
        'personalised-engraving' => 'personalised_engraving',

        'membership' => 'b2b_membership',
        'vendors' => 'vendors',
        'bulk-order' => 'bulk_order',
    ];

    // Get mapped key (fallback = home)
    $key = $map[$route] ?? 'home';

    // Fetch SEO data
    return SeoPage::where('page_key', $key)->first();
}