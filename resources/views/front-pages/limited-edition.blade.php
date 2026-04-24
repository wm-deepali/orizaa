@extends('layouts.app')

<style>
    .process-step {
        position: relative;
    }

    .process-line {
        position: absolute;
        left: 23px;
        top: 48px;
        bottom: -40px;
        width: 3px;
        background: linear-gradient(to bottom, #D4AF37, #B8962E);
    }
</style>

@section('content')

   <section class="about-hero py-20 md:py-20 bg-white">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <p class="uppercase tracking-widest text-sm font-medium text-gray-500 mb-4">
            Exclusive - Limited Pieces
        </p>
        
        <h1 class="text-5xl md:text-6xl font-bold leading-tight text-gray-900 mb-6">
            Limited Edition
        </h1>
        
        <p class="max-w-3xl mx-auto text-xl text-gray-600">
            Discover exclusive designs crafted in limited quantities for a truly unique style. 
            Once sold out, these pieces won't be restocked - making every outfit rare and special.
        </p>

        <div class="mt-12">
            <a href="{{ route('products') }}"
                class="inline-block bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
                For Upcoming Collections, Stay in touch
            </a>
        </div>
    </div>
</section>

    <!-- ==================== DETAIL CONTENT ==================== -->
   <section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Why Choose Limited Edition?</h2>
        
        <p class="text-lg text-gray-600 leading-relaxed">
            Our Limited Edition collection features exclusive designs crafted in small quantities, ensuring uniqueness and premium appeal. 
            Each piece is thoughtfully designed to make you stand out with rare styles that won't be restocked once sold out.
        </p>
    </div>
</section>
    <!-- ==================== PRODUCT SAMPLES ==================== -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-semibold text-center mb-12">Limited Edition Outfits</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @if($products->count() > 0)

                    @foreach($products as $product)

                        <div class="rounded-3xl overflow-hidden shadow-sm">

                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-80 object-cover">

                            <div class="p-5 bg-white">
                                <h3 class="font-semibold">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $product->sub_title }}
                                </p>
                            </div>

                        </div>

                    @endforeach

                @else

                    {{-- Orizaa --}}
                    <div class="col-span-3">
                        <div class="text-center p-10 border-2 border-dashed rounded-xl bg-gray-50">

                            <h3 class="text-lg font-semibold text-gray-700">
                                No Outfits found
                            </h3>

                            <p class="text-gray-500 mt-2">
                                Please explore our other categories for latest collections
                            </p>

                            <a href="{{ route('products') }}"
                                class="inline-block mt-4 px-6 py-2 bg-[#B8962E] text-white rounded-lg hover:bg-[#e76f51]">
                                Explore Collection
                            </a>

                        </div>
                    </div>

                @endif

            </div>
        </div>
    </section>

    <!-- ==================== STEP-BY-STEP GUIDE ==================== -->
  <section class="py-20 bg-gray-50">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center mb-16">
            <span class="uppercase text-sm font-medium text-gray-500">EXCLUSIVITY</span>
            <h2 class="text-4xl font-bold text-gray-900 mt-3">What Makes It Truly Exclusive</h2>
        </div>

        <div class="grid md:grid-cols-2 gap-8">

            <div class="bg-white rounded-3xl p-8 shadow-sm">
                <h3 class="text-2xl font-semibold mb-2">Limited Pieces Only</h3>
                <p class="text-gray-600">Each design is produced in small quantities, ensuring exclusivity and uniqueness.</p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm">
                <h3 class="text-2xl font-semibold mb-2">No Restocks</h3>
                <p class="text-gray-600">Once sold out, these styles are not repeated — making them truly rare.</p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm">
                <h3 class="text-2xl font-semibold mb-2">Premium Designs</h3>
                <p class="text-gray-600">Crafted with attention to detail, high-quality fabrics, and elegant finishes.</p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-sm">
                <h3 class="text-2xl font-semibold mb-2">Stand Out Style</h3>
                <p class="text-gray-600">Wear something unique that sets you apart at every occasion.</p>
            </div>

        </div>
    </div>
</section>



@endsection