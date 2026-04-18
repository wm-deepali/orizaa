@extends('layouts.app')

@section('content')

    <section class="py-16 md:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                    Latest from <span class="text-[#D4AF37]">ORIZAA</span><span class="text-[#D4AF37]"> STYLE</span>
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    Insights, trends, and ideas to help your business choose the perfect corporate gifts
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach($blogs as $blog)
                    <div
                        class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">

                        <!-- IMAGE -->
                        <div class="h-56 bg-gray-200 overflow-hidden">
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>

                        <div class="p-6">

                            <!-- DATE (same UI structure) -->
                            <div class="flex items-center gap-3 text-xs text-gray-500 mb-3">
                                <span class="bg-orange-100 text-[#D4AF37] px-3 py-1 rounded-full">Blog</span>
                                <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}</span>
                            </div>

                            <!-- TITLE -->
                            <h3
                                class="text-xl font-semibold leading-tight mb-3 line-clamp-2 group-hover:text-[#D4AF37] transition-colors">
                                {{ $blog->title }}
                            </h3>

                            <!-- SHORT DESC -->
                            <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                {{ $blog->short_description }}
                            </p>

                            <!-- READ MORE -->
                            <a href="{{ route('blog.detail', $blog->slug) }}"
                                class="inline-flex items-center text-[#D4AF37] font-medium hover:text-[#B8962E] transition-colors">
                                Read Article →
                            </a>

                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>



@endsection