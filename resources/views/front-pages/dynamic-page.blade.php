@extends('layouts.app')

@section('meta_title', $page->meta_title ?? $page->heading)

@section('meta_description', $page->meta_description ?? '')

@section('content')

<!-- Breadcrumb -->
<div class="bg-gray-50 py-4 border-b">
    <div class="max-w-7xl mx-auto px-6">
        <nav class="text-sm text-gray-500 flex items-center gap-2">
            <a href="{{ url('/') }}" class="hover:text-[#f4a261]">Home</a>
            <span>›</span>
            <span class="text-gray-800 font-medium">
                {{ $page->heading ?? $page->page_name }}
            </span>
        </nav>
    </div>
</div>

<!-- Page Content -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-6">

        <!-- Title -->
        <h1 class="text-4xl font-bold text-gray-900 mb-6">
            {{ $page->heading ?? $page->page_name }}
        </h1>

        <!-- Content -->
        <div class="prose max-w-none text-gray-700">
            {!! $page->content !!}
        </div>

    </div>
</section>

@endsection