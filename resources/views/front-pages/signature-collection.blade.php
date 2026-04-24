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
            Timeless - Iconic Designs
        </p>
        
        <h1 class="text-5xl md:text-6xl font-bold leading-tight text-gray-900 mb-6">
            Signature Collection
        </h1>
        
        <p class="max-w-3xl mx-auto text-xl text-gray-600">
            Discover our most iconic designs that define the essence of Orizaa Style. 
            Crafted with premium fabrics and elegant detailing, these timeless pieces are made to stand out for every occasion.
        </p>

        <div class="mt-12">
            <a href="{{ route('products') }}"
                class="inline-block bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
                Explore Signature Styles
            </a>
        </div>
    </div>
</section>

    <!-- ==================== DETAIL CONTENT ==================== -->
    <section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">The Essence of Our Signature Collection</h2>
        
        <p class="text-lg text-gray-600 leading-relaxed">
            Our Signature Collection represents the true identity of Orizaa Style � timeless designs crafted with premium fabrics and elegant detailing. 
            These are our most loved styles, created to offer sophistication, comfort, and effortless elegance for every occasion.
        </p>
    </div>
</section>
    <!-- ==================== PRODUCT SAMPLES ==================== -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-semibold text-center mb-12">Our Signature Collections</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @if($products->count() > 0)

                    @foreach($products as $product)

                        <div class="rounded-3xl overflow-hidden shadow-sm">

                            <img src="{{ $product->display_image ? asset('storage/' . $product->display_image) : asset('no-image.png') }}"alt="{{ $product->name }}"
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
                                No Outfit found
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
            <span class="uppercase text-sm font-medium text-gray-500">STYLE JOURNEY</span>
            <h2 class="text-4xl font-bold text-gray-900 mt-3">Find Your Signature Style</h2>
        </div>

        <div
            class="max-w-3xl mx-auto space-y-16 relative before:absolute before:left-6 before:top-8 before:bottom-8 before:w-0.5 before:bg-gradient-to-b before:from-[#D4AF37] before:to-[#B8962E]">

            <!-- Step 1 -->
            <div class="process-step flex gap-5 md:gap-10">
                <div
                    class="w-12 h-12 bg-[#D4AF37] text-white rounded-2xl flex items-center justify-center text-2xl font-bold flex-shrink-0">
                    1</div>
                <div class="flex-1 bg-white rounded-3xl p-8 shadow-sm">
                    <h3 class="text-2xl font-semibold mb-2">Explore the Collection</h3>
                    <p class="text-gray-600">Browse our signature designs crafted with elegance and timeless appeal.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="process-step flex gap-5 md:gap-10">
                <div
                    class="w-12 h-12 bg-[#2ec4b6] text-white rounded-2xl flex items-center justify-center text-2xl font-bold flex-shrink-0">
                    2</div>
                <div class="flex-1 bg-white rounded-3xl p-8 shadow-sm">
                    <h3 class="text-2xl font-semibold mb-2">Choose Your Style</h3>
                    <p class="text-gray-600">Select the design that matches your personality, occasion, and preference.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="process-step flex gap-5 md:gap-10">
                <div
                    class="w-12 h-12 bg-[#B8962E] text-white rounded-2xl flex items-center justify-center text-2xl font-bold flex-shrink-0">
                    3</div>
                <div class="flex-1 bg-white rounded-3xl p-8 shadow-sm">
                    <h3 class="text-2xl font-semibold mb-2">Place Your Order</h3>
                    <p class="text-gray-600">Secure your favorite outfit with a smooth and hassle-free checkout experience.</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="process-step flex gap-5 md:gap-10">
                <div
                    class="w-12 h-12 bg-gray-700 text-white rounded-2xl flex items-center justify-center text-2xl font-bold flex-shrink-0">
                    4</div>
                <div class="flex-1 bg-white rounded-3xl p-8 shadow-sm">
                    <h3 class="text-2xl font-semibold mb-2">Delivered with Care</h3>
                    <p class="text-gray-600">Receive your outfit with secure packaging, ready to wear and impress.</p>
                </div>
            </div>

        </div>
    </div>
</section>



@endsection