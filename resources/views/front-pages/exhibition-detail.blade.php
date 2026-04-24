@extends('layouts.app')

@section('content')

    <section class="py-20 md:py-28 bg-gradient-to-br from-[#f8f4f0] to-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
                {{ $exhibition->title ?? '' }}
            </h1>

            <p class="max-w-2xl mx-auto text-xl text-gray-600">
                {{ $exhibition->subtitle ?? ''}}
            </p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            <h2 class="text-3xl font-semibold text-center mb-12">
                Exhibition Gallery
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($exhibition->galleries as $img)

                    <div class="rounded-2xl overflow-hidden shadow-sm border">

                        <img src="{{ asset('storage/' . $img->image) }}"
                            class="w-full h-72 object-cover hover:scale-105 transition duration-300" alt="Gallery Image">

                    </div>

                @empty

                    <div class="col-span-3 text-center text-gray-500">
                        No gallery images available.
                    </div>

                @endforelse

            </div>

        </div>
    </section>

    <!-- Bottom Message -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-semibold mb-6 text-gray-800">
                Showcasing Our Style, Connecting with You
            </h2>

            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Every exhibition gives us the opportunity to present our collections, connect with customers, and understand
                evolving fashion trends.
                It reflects our commitment to quality, craftsmanship, and creating designs that truly resonate.
            </p>
        </div>
    </section>


@endsection