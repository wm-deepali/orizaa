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

            ['key' => 'awards', 'name' => 'Awards & Recognitions'],      // /awards

            ['key' => 'blog', 'name' => 'Blog Listing Page'],            // /blogs
            ['key' => 'faq', 'name' => 'FAQ Page'],                      // /faqs

            ['key' => 'recycling', 'name' => 'Recycling Pledge'],        // /recycling-pledge

            ['key' => 'engraving', 'name' => 'Engraving Gallery'],       // /engraving-gallery
            ['key' => 'personalised_engraving', 'name' => 'Personalised Engraving'], // /personalised-engraving

            ['key' => 'b2b_membership', 'name' => 'B2B Membership'],     // /membership
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
