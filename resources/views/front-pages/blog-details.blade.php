@extends('layouts.app')

@section('content')


    <section class="pt-8 pb-12 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-4xl mx-auto px-6">

            <!-- Category & Date -->
            <div class="flex items-center gap-4 text-sm mb-6">
                <span
                    class="bg-orange-100 text-[#f4a261] px-5 py-2 rounded-full font-medium">{{ $blog->category ?? 'Blog' }}</span>
                <span class="text-gray-500">• {{ \Carbon\Carbon::parse($blog->created_at)->format('F d, Y') }}</span>
                @php
                    $wordCount = str_word_count(strip_tags($blog->content));
                    $readTime = max(1, ceil($wordCount / 200));
                @endphp
                <span class="text-gray-500">• {{ $readTime }} min read</span>
            </div>

            <!-- Blog Title -->
            <h1 class="text-4xl md:text-5xl font-bold leading-tight text-gray-900 mb-8">
                {{ $blog->title }}
            </h1>

            <!-- Author Info -->
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-gray-200 rounded-2xl overflow-hidden">
                    <img src="https://plus.unsplash.com/premium_photo-1720744786849-a7412d24ffbf?q=80&w=809&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="Author" class="w-full h-full object-cover">
                </div>
                <div>
                    <p class="font-semibold text-gray-800">B2B Gifts India Team</p>
                    <p class="text-sm text-gray-500">Marketing & Insights</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Image -->
    <div class="max-w-5xl mx-auto px-6 -mt-6 relative z-10">
        <img src="{{ $blog->image ? asset('storage/' . $blog->image) : asset('default.jpg') }}" alt="{{ $blog->title }}"
            class="w-full rounded-3xl shadow-2xl object-cover">
    </div>

    <!-- Main Content -->
    <section class="max-w-4xl mx-auto px-6 py-16">
        <div class="blog-content prose prose-lg max-w-none">
            {!! $blog->content !!}
        </div>

        <!-- Tags -->
        <div class="mt-12 flex flex-wrap gap-3">
            <span
                class="bg-gray-100 hover:bg-gray-200 transition-colors text-gray-700 px-5 py-2 rounded-3xl text-sm cursor-pointer">#CorporateGifting</span>
            <span
                class="bg-gray-100 hover:bg-gray-200 transition-colors text-gray-700 px-5 py-2 rounded-3xl text-sm cursor-pointer">#Sustainability</span>
            <span
                class="bg-gray-100 hover:bg-gray-200 transition-colors text-gray-700 px-5 py-2 rounded-3xl text-sm cursor-pointer">#EmployeeEngagement</span>
            <span
                class="bg-gray-100 hover:bg-gray-200 transition-colors text-gray-700 px-5 py-2 rounded-3xl text-sm cursor-pointer">#2026Trends</span>
        </div>

        <!-- Share Buttons -->
        <div class="mt-10 border-t border-gray-200 pt-8">
            <p class="text-gray-600 font-medium mb-4">Share this article</p>
            <div class="flex gap-5 text-3xl text-gray-400">
                @php
                    $url = url()->current();
                    $title = urlencode($blog->title);
                @endphp

                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $url }}" target="_blank"><i
                        class="fa-brands fa-linkedin"></i></a>
                <a href="https://twitter.com/intent/tweet?url={{ $url }}&text={{ $title }}" target="_blank"><i
                        class="fa-brands fa-twitter"></i></a>

                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $url }}" target="_blank"><i
                        class="fa-brands fa-facebook"></i></a>
                <a href="https://wa.me/?text={{ $title }}%20{{ $url }}" target="_blank"><i
                        class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-6xl mx-auto px-6">
            <h3 class="text-2xl font-semibold mb-8">Related Articles</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedBlogs as $item)
                    <a href="{{ route('blog.detail', $item->slug) }}">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-all">

                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('default.jpg') }}"
                                class="w-full h-44 object-cover">

                            <div class="p-5">
                                <h4 class="font-semibold leading-tight mb-2">
                                    {{ $item->title }}
                                </h4>
                                <p class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}
                                </p>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>


@endsection