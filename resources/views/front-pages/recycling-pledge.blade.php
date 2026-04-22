@extends('layouts.app')


@section('content')


<section class="about-hero py-20 md:py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <p class="text-lg text-gray-600 mb-4">Empowering Businesses • Creating Memorable Experiences</p>
        <h1 class="text-5xl md:text-6xl font-bold leading-tight text-gray-900 mb-6">
            About <span class="text-[#D4AF37]">Orizaa</span><span class="text-[#2ec4b6]"></span><span class="text-[#B8962E]"> Style</span>
        </h1>
        <p class="max-w-3xl mx-auto text-xl text-gray-700">
            We help Indian businesses build stronger relationships through thoughtful, premium and beautifully customized corporate gifts.
        </p>

        <div class="mt-10">
            <a href="javascript:void(0)" onclick="openGlobalDrawer('Speak With Our Expert', 'recycling_pledge_page')"
               class="inline-block bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
                Speak With Our Expert
            </a>
        </div>
    </div>
</section>

<!-- ==================== ABOUT US SECTION ==================== -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">

            <!-- Left Side - Image -->
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1556761175-5973f0c0f7b8" 
                     alt="B2B Gifts India Team" 
                     class="rounded-3xl shadow-2xl w-full">
                
                <!-- Overlay Badge -->
                <div class="absolute -bottom-6 -right-6 bg-white rounded-3xl shadow-xl p-6 max-w-[220px]">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-[#D4AF37] text-white rounded-2xl flex items-center justify-center text-3xl">🎁</div>
                        <div>
                            <p class="font-semibold text-gray-800">Since 2018</p>
                            <p class="text-sm text-gray-500">Delivering Happiness Across India</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Content -->
            <div class="space-y-8">
                <div>
                    <span class="uppercase tracking-widest text-sm font-medium text-[#D4AF37]">Our Story</span>
                    <h2 class="text-4xl font-bold text-gray-900 mt-3 leading-tight">
                        Crafting Memorable Moments Through <span class="text-[#D4AF37]">Premium Corporate Gifting</span>
                    </h2>
                </div>

                <p class="text-gray-600 text-lg leading-relaxed">
                    At B2B Gifts India, we understand that every gift tells a story. Founded with a passion for quality and creativity, 
                    we have become one of India’s most trusted names in corporate gifting. Our mission is simple — to help businesses 
                    express gratitude and strengthen relationships through meaningful, beautifully crafted gifts.
                </p>

                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <h4 class="font-semibold text-xl text-gray-800 mb-2">Our Mission</h4>
                        <p class="text-gray-600">
                            To deliver thoughtful, high-quality and perfectly customized gifts that create lasting impressions and strengthen business relationships.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-xl text-gray-800 mb-2">Our Vision</h4>
                        <p class="text-gray-600">
                            To become India’s most preferred corporate gifting partner, known for excellence, innovation and unmatched customer experience.
                        </p>
                    </div>
                </div>

                <div class="pt-6">
                    <a href="#" 
                       class="inline-flex items-center gap-3 bg-gradient-to-r from-[#D4AF37] to-[#B8962E] text-white px-8 py-4 rounded-2xl font-semibold hover:shadow-lg transition-all">
                        Know Our Journey
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Trust Signals -->
                <div class="flex items-center gap-10 pt-8 border-t">
                    <div>
                        <p class="text-3xl font-bold text-gray-800">5000+</p>
                        <p class="text-sm text-gray-500">Happy Clients</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-800">1.25 Lakh+</p>
                        <p class="text-sm text-gray-500">Gifts Delivered</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-gray-800">18</p>
                        <p class="text-sm text-gray-500">Cities Served</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ==================== BRAND PROMISE SECTION ==================== -->
<section class="relative py-24 md:py-32 bg-cover bg-center bg-no-repeat" 
         style="background-image: url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622');">
    
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>

    <div class="relative max-w-7xl mx-auto px-6">
        
        <!-- Centered Card -->
        <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-2xl p-12 md:p-16 text-center">
            
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-8">
                Our Brand Promise
            </h2>

            <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                Gestures of appreciation and love are what makes a relationship more meaningful. 
                In a world where gifting is just an object being passed from one hand to another, 
                we at <span class="font-semibold text-[#D4AF37]">B2B Gifts India</span> believe that gifting 
                is a symbol of love being passed from one soul to another.
            </p>

            <!-- Decorative Line -->
            <div class="w-24 h-1 bg-gradient-to-r from-[#D4AF37] to-[#B8962E] mx-auto mt-10 rounded-full"></div>
        </div>

    </div>
</section>



@endsection