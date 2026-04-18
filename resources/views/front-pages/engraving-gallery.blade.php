@extends('layouts.app')


@section('content')




<section class="py-24 md:py-32 bg-white">
    <div class="max-w-5xl mx-auto px-6 text-center">
        
        <p class="uppercase tracking-widest text-sm font-medium text-gray-500 mb-4">
            Premium Customization
        </p>
        
        <h1 class="text-5xl md:text-6xl font-bold leading-tight text-gray-900 mb-6">
            Engraving Gallery
        </h1>
        
        <p class="max-w-3xl mx-auto text-xl text-gray-600">
            Explore our finest laser engraving, debossing, and customization work on premium corporate gifts. 
            Every piece tells a unique story of craftsmanship and brand excellence.
        </p>

        <div class="mt-10">
            <a href="#" 
               class="inline-block bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
                Get Your Brand Engraved
            </a>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-12">
            <h2 class="text-3xl font-semibold text-gray-800">Our Finest Engraving & Customization Work</h2>
            <p class="text-gray-600 mt-3">Real projects • Premium finishes • Memorable branding</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- 1. Leather Diary -->
            <div class="gallery-img bg-white">
                <img src="https://images.unsplash.com/photo-1544947958-cf3f4a4e3c0b" 
                     alt="Engraved Leather Diary" 
                     class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="font-semibold text-lg">Premium Leather Journal</h3>
                    <p class="text-sm text-gray-500">Laser Engraving • Corporate Gifting</p>
                </div>
            </div>

            <!-- 2. Stainless Steel Bottle -->
            <div class="gallery-img bg-white">
                <img src="https://images.unsplash.com/photo-1602143407151-7111542de6e8" 
                     alt="Engraved Stainless Steel Bottle" 
                     class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="font-semibold text-lg">Engraved Steel Bottle</h3>
                    <p class="text-sm text-gray-500">Precision Laser Engraving • Employee Gifts</p>
                </div>
            </div>

            <!-- 3. Power Bank -->
            <div class="gallery-img bg-white">
                <img src="https://images.unsplash.com/photo-1586953208448-b95a79798f07" 
                     alt="Custom Engraved Power Bank" 
                     class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="font-semibold text-lg">Wireless Power Bank</h3>
                    <p class="text-sm text-gray-500">Logo Engraving • Tech Corporate Gifts</p>
                </div>
            </div>

            <!-- 4. Wooden Gift Box -->
            <div class="gallery-img bg-white">
                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a9c" 
                     alt="Engraved Wooden Box" 
                     class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="font-semibold text-lg">Custom Wooden Gift Box</h3>
                    <p class="text-sm text-gray-500">Laser Engraving • Executive Set</p>
                </div>
            </div>

            <!-- 5. Luxury Pen -->
            <div class="gallery-img bg-white">
                <img src="https://images.unsplash.com/photo-1585336261022-680e295ce3fe" 
                     alt="Engraved Luxury Pen" 
                     class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="font-semibold text-lg">Luxury Metal Pen Set</h3>
                    <p class="text-sm text-gray-500">Engraving + Branding • Client Gifting</p>
                </div>
            </div>

            <!-- 6. Trophy / Award -->
            <div class="gallery-img bg-white">
                <img src="https://images.unsplash.com/photo-1558618047-3c8c76ca5d12" 
                     alt="Engraved Crystal Trophy" 
                     class="w-full h-80 object-cover">
                <div class="p-6">
                    <h3 class="font-semibold text-lg">Crystal Award Trophy</h3>
                    <p class="text-sm text-gray-500">Deep Laser Engraving • Recognition Gifts</p>
                </div>
            </div>

        </div>

        <div class="text-center mt-16">
            <button onclick="alert('More engraving samples coming soon!')" 
                    class="px-10 py-4 border-2 border-[#D4AF37] text-[#D4AF37] font-semibold rounded-2xl hover:bg-[#D4AF37] hover:text-white transition-all">
                View More Engravings
            </button>
        </div>

    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-[#D4AF37] to-[#B8962E] text-white">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-semibold mb-4">Want Your Brand Engraved?</h2>
        <p class="text-lg opacity-90 mb-8">From diaries to drinkware — we make your logo look premium and memorable.</p>
        <a href="#" class="inline-block bg-white text-[#B8962E] px-12 py-5 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
            Start Your Customization Project
        </a>
    </div>
</section>

<script>
    function loadMoreImages() {
        alert("More engraving samples would load here in a real website.");
    }
</script>



@endsection