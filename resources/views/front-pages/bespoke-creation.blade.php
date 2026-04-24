@extends('layouts.app')


@section('content')


   <section class="py-24 md:py-32 bg-white">
    <div class="max-w-5xl mx-auto px-6 text-center">

        <p class="uppercase tracking-widest text-sm font-medium text-gray-500 mb-4">
            Custom Couture
        </p>

        <h1 class="text-5xl md:text-6xl font-bold leading-tight text-gray-900 mb-6">
            Bespoke Creations
        </h1>

        <p class="max-w-3xl mx-auto text-xl text-gray-600">
            Create outfits that are uniquely yours with our bespoke design experience. 
            From fabric selection to intricate detailing, every piece is tailored to match your style, fit, and occasion with perfection.
        </p>

        <div class="mt-10">
            <a href="javascript:void(0)" onclick="openGlobalDrawer('Start Your Custom Outfit', 'bespoke_creation')"
                class="inline-block bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
                Start Your Custom Outfit
            </a>
        </div>
    </div>
</section>
    <!-- Gallery Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">

           <div class="text-center mb-12">
    <h2 class="text-3xl font-semibold text-gray-800">Our Bespoke Outfit Gallery</h2>
    <p class="text-gray-600 mt-3">Explore custom-crafted designs tailored to unique styles and occasions.</p>
</div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @if($products->count() > 0)

                    @foreach($products as $product)
                        <!-- 1. Leather Diary -->
                        <div class="gallery-img bg-white">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-80 object-cover">
                            <div class="p-6">
                                <h3 class="font-semibold text-lg">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $product->sub_title }}
                                </p>
                            </div>
                        </div>

                    @endforeach

                @else

                    {{-- ðŸ”¥ EMPTY STATE --}}
                    <div class="col-span-3">
                        <div class="text-center p-10 border-2 border-dashed rounded-xl bg-gray-50">

                            <h3 class="text-lg font-semibold text-gray-700">
                                No Outfit Founds
                            </h3>

                            <p class="text-gray-500 mt-2">
                                Please explore our other categories to get the latest collections
                            </p>

                            <a href="{{ route('products') }}"
                                class="inline-block mt-4 px-6 py-2 bg-[#B8962E] text-white rounded-lg hover:bg-[#e76f51]">
                                Explore Collection
                            </a>

                        </div>
                    </div>

                @endif

            </div>

         <div class="text-center mt-16">
                <a href="{{ route('products', ['is_engraving' => 1]) }}"
                    class="inline-block  px-10 py-4 border-2 border-[#D4AF37] text-[#D4AF37] font-semibold rounded-2xl hover:bg-[#D4AF37] hover:text-white transition-all">
                    View More Collections
                </a>
            </div>

        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-[#D4AF37] to-[#B8962E] text-white">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold mb-4">Want Your Dream Outfit Designed?</h2>
        
        <p class="text-lg opacity-90 mb-8">
            From fabric selection to final detailing — we create outfits tailored to your style, fit, and occasion.
        </p>
        
        <a href="javascript:void(0)" onclick="openGlobalDrawer('Start Your Custom Outfit', 'bespoke_creation')"
            class="inline-block bg-white text-[#B8962E] px-12 py-5 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
            Start Your Custom Outfit
        </a>
    </div>
</section>

    <script>
        function loadMoreImages() {
            alert("More bespoke collections will load here.");
        }
    </script>



@endsection