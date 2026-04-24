@extends('layouts.app')

@section('content')

   <section class="py-20 md:py-28 bg-gradient-to-br from-[#f8f4f0] to-white"> 
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">
            Exhibitions & Showcases
        </h1>
        
        <p class="max-w-2xl mx-auto text-xl text-gray-600">
            Showcasing Orizaa Style at leading exhibitions and fashion showcases. 
            Explore our journey of presenting premium designs, connecting with customers, and bringing our collections to life.
        </p>
    </div>
</section>

    <!-- Awards Grid -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">

                <!-- Award 1 -->
                @foreach($awards as $award)
                    <div class="award-card bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm">

                        <div class="h-64 bg-gray-100 flex items-center justify-center p-8">
                            <img src="{{ $award->image ? asset('storage/' . $award->image) : 'https://via.placeholder.com/400x300' }}"
                                alt="{{ $award->title }}" class="max-h-full object-contain">
                        </div>

                        <div class="p-8">
                            <div class="award-year inline-block px-5 py-2 rounded-full text-sm mb-4">
                                {{ $award->year }}
                            </div>

                            <h3 class="text-2xl font-semibold mb-3">
                                {{ $award->title }}
                            </h3>

                            <p class="text-gray-600 leading-relaxed">
                                {{ $award->description }}
                            </p>
                        </div>

                    </div>
                @endforeach

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
            Every exhibition gives us the opportunity to present our collections, connect with customers, and understand evolving fashion trends. 
            It reflects our commitment to quality, craftsmanship, and creating designs that truly resonate.
        </p>
    </div>
</section>


@endsection