<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomePageController extends Controller
{
    public function index()
    {
        $sections = [

            [
                'title' => 'Sliders Section',
                'route' => route('admin.home.sliders.index'),
                'type' => 'multiple'
            ],

            [
                'title' => 'Why Choose Us',
                'route' => route('admin.home.why.index'),
                'type' => 'multiple'
            ],

            [
                'title' => 'Offer & Product Banners',
                'route' => route('admin.home.banners.index'),
                'type' => 'multiple'
            ],
            [
                'title' => 'Feature Cards Section',
                'route' => route('admin.home.features.index'),
                'type' => 'multiple'
            ],

            [
                'title' => 'Category Video Section',
                'route' => route('admin.home.category-videos.index'),
                'type' => 'multiple'
            ],

        ];

        return view('admin.home.index', compact('sections'));
    }
}