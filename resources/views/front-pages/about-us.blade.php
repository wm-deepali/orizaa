@extends('layouts.app')

@section('content')

    <section class="about-hero py-8 md:py-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <p class="text-lg text-gray-600 mb-4">Crafting Elegance • Celebrating Every Woman</p>
        
        <h1 class="text-5xl md:text-6xl font-bold leading-tight text-gray-900 mb-6">
            About <span class="text-[#D4AF37]">Orizaa</span><span class="text-[#B8962E]"> Style</span>
        </h1>
        
        <p class="max-w-3xl mx-auto text-xl text-gray-700">
            At Orizaa Style, we bring you exclusive ladies suits, bridal wear, and premium ethnic fashion designed with
            elegance, craftsmanship, and attention to detail. From timeless classics to modern couture, we create styles
            that make every woman feel confident, graceful, and truly special.
        </p>

        <div class="mt-10">
            <a href="javascript:void(0)" onclick="openGlobalDrawer('Explore Our Collection', 'about_page')"
                class="inline-block bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
                Explore Our Collection
            </a>
        </div>
    </div>
</section>

    <!-- Stats Section -->
    <section class="py-8 md:py-24 bg-white border-t border-b">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-10 text-center">

                <div class="stats-card bg-white p-8 rounded-3xl shadow-sm">
                    <h3 class="text-2xl md:text-4xl font-bold text-[#D4AF37] mb-2">2000+</h3>
                    <p class="text-gray-600 font-medium">Happy Customer</p>
                </div>

                <div class="stats-card bg-white p-8 rounded-3xl shadow-sm">
                    <h3 class="text-2xl md:text-4xl font-bold text-[#B8962E] mb-2">6,500+</h3>
                    <p class="text-gray-600 font-medium">Products Delivered</p>
                </div>

                <div class="stats-card bg-white p-8 rounded-3xl shadow-sm">
                    <h3 class="text-2xl md:text-4xl font-bold text-[#C9A227] mb-2">1200+</h3>
                    <p class="text-gray-600 font-medium">Premium Products</p>
                </div>

                <div class="stats-card bg-white p-8 rounded-3xl shadow-sm">
                    <h3 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">30</h3>
                    <p class="text-gray-600 font-medium">Cities Across India</p>
                </div>

            </div>
        </div>
    </section>

    <section class="py-16 md:py-24 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left Image -->
                <div class="relative">
                    <div class="absolute -inset-4 bg-gradient-to-br from-[#D4AF37]/10 to-[#B8962E]/10 rounded-3xl"></div>
                    <img src="{{ asset('images/oriza-brand-story.webp') }}" alt="Our Journey"
                        class="relative rounded-3xl shadow-2xl w-full h-full object-cover">
                </div>

                <!-- Right Content -->
                <div>
    <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Brand Story</h2>
    <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
        <p>
            Orizaa Style was founded with a passion to redefine elegance in women’s ethnic fashion — bringing together timeless craftsmanship and modern design.
        </p>
        <p>
            What began as a vision to create exclusive and high-quality ladies suits has evolved into a brand that celebrates individuality, style, and confidence. From everyday elegance to bridal couture, each piece is thoughtfully designed to make every woman feel special.
        </p>
        <p>
            Today, Orizaa Style is growing as a trusted destination for premium ethnic wear, offering curated collections, handcrafted designs, and customized creations that reflect beauty, grace, and sophistication.
        </p>
    </div>
</div>
            </div>
        </div>
    </section>

    <!-- ==================== BRAND PROMISE SECTION ==================== -->
    <section class="py-16 md:py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Brand Promise</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                We don’t just create outfits — we craft elegance, confidence, and timeless style for every woman.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div
                class="brand-promise-card p-8 bg-white border border-gray-100 rounded-3xl hover:border-[#D4AF37] transition-all group">
                <div
                    class="w-14 h-14 bg-[#D4AF37]/10 text-[#D4AF37] rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                    ✨
                </div>
                <h3 class="font-semibold text-2xl mb-3">Premium Quality</h3>
                <p class="text-gray-600">
                    We use high-quality fabrics and fine craftsmanship to ensure every piece reflects luxury, comfort, and durability.
                </p>
            </div>

            <div
                class="brand-promise-card p-8 bg-white border border-gray-100 rounded-3xl hover:border-[#B8962E] transition-all group">
                <div
                    class="w-14 h-14 bg-[#B8962E]/10 text-[#B8962E] rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                    🎨
                </div>
                <h3 class="font-semibold text-2xl mb-3">Exclusive Designs</h3>
                <p class="text-gray-600">
                    From everyday elegance to bridal couture, our collections are thoughtfully curated to offer unique and stylish designs.
                </p>
            </div>

            <div
                class="brand-promise-card p-8 bg-white border border-gray-100 rounded-3xl hover:border-[#C9A227] transition-all group">
                <div
                    class="w-14 h-14 bg-[#C9A227]/10 text-[#C9A227] rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                    🤝
                </div>
                <h3 class="font-semibold text-2xl mb-3">Customer Commitment</h3>
                <p class="text-gray-600">
                    We are dedicated to delivering a seamless shopping experience with attention to detail, reliability, and care.
                </p>
            </div>
        </div>
    </div>
</section>

    <!-- Vision & Mission -->
    <section class="py-8 md:py-24 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-10">

            <!-- Vision -->
            <div class="bg-white p-4 md:p-10 rounded-3xl shadow-sm">
                <h2 class="text-3xl font-semibold mb-6 text-gray-800">Our Vision</h2>
                <p class="text-gray-700 leading-relaxed text-lg">
                    To become a trusted name in premium ethnic fashion, known for elegance, craftsmanship, and designs that celebrate the beauty and confidence of every woman.
                </p>
            </div>

            <!-- Mission -->
            <div class="bg-white p-4 md:p-10 rounded-3xl shadow-sm">
                <h2 class="text-3xl font-semibold mb-6 text-gray-800">Our Mission</h2>
                <p class="text-gray-700 leading-relaxed text-lg">
                    To create high-quality, stylish, and thoughtfully designed outfits that blend tradition with modern trends, offering every woman a unique expression of her style and personality.
                </p>
            </div>

        </div>
    </div>
</section>

    <!-- Leadership / Team -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
    <h2 class="text-4xl font-bold text-gray-900">Meet the Vision Behind Orizaa Style</h2>
    <p class="text-gray-600 mt-3 text-lg">
        Passionate minds dedicated to creating timeless ethnic fashion that celebrates elegance, craftsmanship, and individuality.
    </p>
</div>

            <div class="grid md:grid-cols-3 gap-4 md:gap-10">


                @foreach($teams as $team)
                    <div class="leadership-card bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm">

                        <div class="h-80 bg-gray-200">
                            <img src="{{ $team->image ? asset('storage/' . $team->image) : 'https://via.placeholder.com/600x600' }}"
                                alt="{{ $team->name }}" class="w-full h-full object-cover">
                        </div>

                        <div class="p-8">
                            <h3 class="font-semibold text-2xl">
                                {{ $team->name }}
                            </h3>

                            <p class="text-[#D4AF37] font-medium">
                                {{ $team->designation }}
                            </p>

                            <p class="mt-4 text-gray-600">
                                {{ $team->description }}
                            </p>
                        </div>

                    </div>
                @endforeach



            </div>
        </div>
    </section>

    <!-- Connecting Section -->
    <section class="py-8 md:py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                <div class="grid md:grid-cols-2">
                    <!-- Left Image -->
                    <div class="bg-gray-900 p-12 flex items-center justify-center">
                        <img src="{{ asset('images/orizaa-about-us.webp') }}" alt="Orizaa Style"
                            class="max-w-full rounded-2xl shadow-2xl">
                    </div>

                    <!-- Right Content -->
                    <div class="p-4 md:p-16 flex flex-col justify-center">
    <h2 class="text-3xl font-semibold mb-6">Crafting Elegance for Every Occasion</h2>
    
    <p class="text-gray-700 leading-relaxed text-lg">
        At Orizaa Style, every outfit is designed to tell a story of grace, confidence, and individuality. 
        From everyday elegance to bridal couture, our collections are thoughtfully curated to celebrate 
        every moment with style, sophistication, and timeless beauty.
    </p>

    <div class="mt-10 flex flex-col sm:flex-col gap-4">
        <a href="#"
            class="px-8 py-4 bg-[#D4AF37] text-white text-center rounded-2xl font-semibold">
            Customise Your Style
        </a>
        
        <a href="{{ route('products') }}"
            class="px-8 py-4 border border-gray-300 text-center hover:border-[#D4AF37] rounded-2xl font-semibold transition-colors">
            Explore Our Collection
        </a>
    </div>
</div>
                </div>
            </div>
        </div>
    </section>



@endsection