<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SeoPage;

class SeoPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run()
    {
        $pages = [
            ['key' => 'home', 'name' => 'Home'],

            ['key' => 'category', 'name' => 'Category Page'],            // /categories

            ['key' => 'product_listing', 'name' => 'Product Listing Page'], // /products

            ['key' => 'cart', 'name' => 'Cart Page'],                    // /shopping-cart

            ['key' => 'about', 'name' => 'About Us'],                    // /about-us
            ['key' => 'why_choose_us', 'name' => 'Why Choose Us'],       // /why-us
            ['key' => 'contact', 'name' => 'Contact Us'],                // /contact-us

            ['key' => 'exhibitions', 'name' => 'Exhibitions & Showcases'],   

            ['key' => 'blog', 'name' => 'Blog Listing Page'],            // /blogs
            ['key' => 'faq', 'name' => 'FAQ Page'],                      // /faqs

            ['key' => 'limited_edition', 'name' => 'Limited Edition'],   

            ['key' => 'bespoke_creation', 'name' => 'Bespoke Creation'],     
            ['key' => 'signature_collection', 'name' => 'Signature Collection'],

            ['key' => 'membership', 'name' => 'B2B Membership'],     // /membership
            ['key' => 'vendors', 'name' => 'Vendors'],                   // /vendors
            ['key' => 'bulk_order', 'name' => 'Bulk Order'],             // /bulk-order
        ];

        foreach ($pages as $p) {
            SeoPage::updateOrCreate(
                ['page_key' => $p['key']],
                ['page_name' => $p['name']]
            );
        }
    }
}
