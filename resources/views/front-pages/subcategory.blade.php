@extends('layouts.app')

@section('meta_title', $category->meta_title ?? $category->name)
@section('meta_description', $category->meta_description ?? $category->sub_title)

@section('content')


    <div class="bg-gray-50 py-4 border-b">
        <div class="max-w-7xl mx-auto px-6">
            <nav class="text-sm text-gray-500 flex items-center gap-2">
                <a href="{{ url('/') }}" class="hover:text-[#f4a261]">Home</a>
                <span>›</span>
                <a href="{{ url('/category') }}" class="hover:text-[#f4a261]">Categories</a>
                <span>›</span>
                <span class="text-gray-800 font-medium">{{ $category->name }}</span>
            </nav>
        </div>
    </div>

    <!-- Page Header -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4"> {{ $category->name }}</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                {{ $category->sub_title }}
            </p>
            <p class="mt-4 text-gray-500"> Showing {{ $totalProducts }} products in this category</p>
        </div>
    </section>

    <!-- Sub Categories Grid -->
    <section class="py-8 md:py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-8">

                @foreach($subcategories as $sub)
                    <a href="{{ route('products', ['subcategory' => $sub->slug]) }}" class="subcat-card bg-white group">

                        <div class="relative h-40 md:h-auto overflow-hidden">
                            <img src="{{ asset('storage/' . $sub->image) }}" alt="{{ $sub->name }}" class="subcat-img w-full h-[330px] md:h-[360px]">

                            <div
                                class="absolute top-4 right-4 bg-white text-[#f4a261] text-xs font-bold px-4 py-1.5 rounded-2xl shadow">
                                {{ $sub->subcategory_products_count }} Products
                            </div>
                        </div>

                        <div class="p-3 md:p-6">
                            <h3 class="text-sm md:text-2xl font-semibold text-gray-800">
                                {{ $sub->name }}
                            </h3>

                            <p class="text-gray-500 mt-2">
                                {{ Str::limit($sub->sub_title, 60) }}
                            </p>
                        </div>

                    </a>
                @endforeach

            </div>

            <div class="mt-10 flex justify-center">
                {{ $subcategories->links() }}
            </div>
        </div>
    </section>

@endsection