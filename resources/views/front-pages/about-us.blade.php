@extends('layouts.app')

@section('content')

    <section class="about-hero py-8 md:py-20">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <p class="text-lg text-gray-600 mb-4">Empowering Businesses • Creating Memorable Experiences</p>
            <h1 class="text-5xl md:text-6xl font-bold leading-tight text-gray-900 mb-6">
                About <span class="text-[#D4AF37]">Oriza</span><span class="text-[#B8962E]"> Style</span><span
                    class="text-[#C9A227]"></span>
            </h1>
            <p class="max-w-3xl mx-auto text-xl text-gray-700">
                Premium corporate gifting solutions that help Indian businesses strengthen relationships, appreciate
                employees,
                and create lasting impressions with clients and partners.
            </p>

            <div class="mt-10">
                <a href="javascript:void(0)" onclick="openGlobalDrawer('Speak With Our Expert', 'about_page')"
                    class="inline-block bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
                    Speak With Our Expert
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-8 md:py-24 bg-white border-t border-b">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-10 text-center">

                <div class="stats-card bg-white p-8 rounded-3xl shadow-sm">
                    <h3 class="text-2xl md:text-4xl font-bold text-[#D4AF37] mb-2">5000+</h3>
                    <p class="text-gray-600 font-medium">Happy Corporate Clients</p>
                </div>

                <div class="stats-card bg-white p-8 rounded-3xl shadow-sm">
                    <h3 class="text-2xl md:text-4xl font-bold text-[#B8962E] mb-2">1,25,000+</h3>
                    <p class="text-gray-600 font-medium">Gifts Delivered</p>
                </div>

                <div class="stats-card bg-white p-8 rounded-3xl shadow-sm">
                    <h3 class="text-2xl md:text-4xl font-bold text-[#C9A227] mb-2">350+</h3>
                    <p class="text-gray-600 font-medium">Premium Products</p>
                </div>

                <div class="stats-card bg-white p-8 rounded-3xl shadow-sm">
                    <h3 class="text-2xl md:text-4xl font-bold text-gray-800 mb-2">18</h3>
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
                    <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg" alt="Our Journey"
                        class="relative rounded-3xl shadow-2xl w-full h-full object-cover">
                </div>

                <!-- Right Content -->
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Our Brand Story</h2>
                    <div class="space-y-6 text-lg text-gray-700 leading-relaxed">
                        <p>
                            Founded in 2022 with a simple yet powerful vision — to transform the way Indian businesses
                            express gratitude and appreciation.
                        </p>
                        <p>
                            What started as a small team passionate about meaningful gifting has grown into one of India’s
                            most trusted corporate gifting partners.
                            We believe that every gift has the power to strengthen relationships and create lasting
                            memories.
                        </p>
                        <p>
                            Today, B2B Gifts India proudly serves over 5000+ corporate clients across 18 cities, delivering
                            not just products, but experiences that reflect the values and aspirations of the organizations
                            we serve.
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
                    We don’t just sell gifts — we help you build stronger, more meaningful business relationships.
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
                        Only the finest products from trusted artisans and brands. We never compromise on quality.
                    </p>
                </div>

                <div
                    class="brand-promise-card p-8 bg-white border border-gray-100 rounded-3xl hover:border-[#B8962E] transition-all group">
                    <div
                        class="w-14 h-14 bg-[#B8962E]/10 text-[#B8962E] rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        🎨
                    </div>
                    <h3 class="font-semibold text-2xl mb-3">Creative Customization</h3>
                    <p class="text-gray-600">
                        From logo engraving to personalized packaging — we make every gift uniquely yours.
                    </p>
                </div>

                <div
                    class="brand-promise-card p-8 bg-white border border-gray-100 rounded-3xl hover:border-[#C9A227] transition-all group">
                    <div
                        class="w-14 h-14 bg-[#C9A227]/10 text-[#C9A227] rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        🤝
                    </div>
                    <h3 class="font-semibold text-2xl mb-3">Exceptional Service</h3>
                    <p class="text-gray-600">
                        From consultation to timely delivery — we are with you at every step of your gifting journey.
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
                        To become India’s most trusted and preferred corporate gifting partner, known for premium quality,
                        creative customization, and exceptional service that helps businesses build stronger relationships.
                    </p>
                </div>

                <!-- Mission -->
                <div class="bg-white p-4 md:p-10 rounded-3xl shadow-sm">
                    <h2 class="text-3xl font-semibold mb-6 text-gray-800">Our Mission</h2>
                    <p class="text-gray-700 leading-relaxed text-lg">
                        To deliver thoughtful, high-quality, and beautifully crafted corporate gifts that create memorable
                        moments
                        and reflect the values of the organizations we serve.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Leadership / Team -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900">Meet Our Leadership</h2>
                <p class="text-gray-600 mt-3 text-lg">Passionate professionals dedicated to redefining corporate gifting in
                    India</p>
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
                        <img src="https://via.placeholder.com/600x500?text=Corporate+Gifting+India" alt="B2B Gifts India"
                            class="max-w-full rounded-2xl shadow-2xl">
                    </div>

                    <!-- Right Content -->
                    <div class="p-4 md:p-16 flex flex-col justify-center">
                        <h2 class="text-3xl font-semibold mb-6">Connecting Businesses Through Thoughtful Gifting</h2>
                        <p class="text-gray-700 leading-relaxed text-lg">
                            At B2B Gifts India, we believe every gift tells a story. We help organizations express
                            gratitude, celebrate milestones,
                            and strengthen professional relationships with carefully curated corporate gifts.
                        </p>

                        <div class="mt-10 flex flex-col sm:flex-col gap-4">
                            <a href="#" class="px-8 py-4 bg-[#D4AF37] text-white text-center rounded-2xl font-semibold">For
                                Corporates</a>
                            <a href="{{ route('products') }}"
                                class="px-8 py-4 border border-gray-300 text-center hover:border-[#D4AF37] rounded-2xl font-semibold transition-colors">Explore
                                Our Collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection