@extends('layouts.app')


<style>
    .trusted-brand::-webkit-scrollbar{
        display:none;
    }
</style>
@section('content')

<section class="py-8 md:py-28 bg-gradient-to-br from-[#F5E6B3]/40 to-white">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
   Why Choose <span class="text-[#D4AF37]">ORIZAA</span><span class="text-[#B8962E]"> STYLE</span>
</h1>
<p class="max-w-3xl mx-auto text-xl text-gray-600">
    We don’t just create outfits — we bring you elegance, confidence, and timeless ethnic fashion designed for every occasion.
</p>
    </div>
</section>

<!-- Key Benefits Grid -->
<section class="py-8 md:py-20 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            <!-- Benefit 1 -->
            <div class="why-card bg-white border border-gray-100 rounded-3xl p-4 md:p-10 hover:border-[#D4AF37] hover:shadow-[0_10px_30px_rgba(212,175,55,0.15)] transition-all">
                <div class="benefit-icon mb-6 text-4xl">🎨</div>
                <h3 class="text-2xl font-semibold mb-4">Premium Quality & Craftsmanship</h3>
<p class="text-gray-600 leading-relaxed">
    Every outfit is crafted using high-quality fabrics and fine detailing to ensure elegance, comfort, and long-lasting wear.
</p>
            </div>

            <!-- Benefit 2 -->
            <div class="why-card bg-white border border-gray-100 rounded-3xl p-4 md:p-10 hover:border-[#D4AF37] hover:shadow-[0_10px_30px_rgba(212,175,55,0.15)] transition-all">
                <div class="benefit-icon mb-6 text-4xl">🚚</div>
                <h3 class="text-2xl font-semibold mb-4">Exclusive & Trendy Designs</h3>
<p class="text-gray-600 leading-relaxed">
    From everyday wear to bridal couture, our collections feature unique, stylish, and thoughtfully curated designs that stand out.
</p>
            </div>

            <!-- Benefit 3 -->
            <div class="why-card bg-white border border-gray-100 rounded-3xl p-4 md:p-10 hover:border-[#D4AF37] hover:shadow-[0_10px_30px_rgba(212,175,55,0.15)] transition-all">
                <div class="benefit-icon mb-6 text-4xl">🌱</div>
                <h3 class="text-2xl font-semibold mb-4">Handcrafted Elegance</h3>
<p class="text-gray-600 leading-relaxed">
    Many of our pieces are handcrafted with intricate work like chikankari and detailed embroidery, making every outfit special.
</p>
            </div>

            <!-- Benefit 4 -->
            <div class="why-card bg-white border border-gray-100 rounded-3xl p-4 md:p-10 hover:border-[#D4AF37] hover:shadow-[0_10px_30px_rgba(212,175,55,0.15)] transition-all">
                <div class="benefit-icon mb-6 text-4xl">💰</div>
                <h3 class="text-2xl font-semibold mb-4">Value for Premium Fashion</h3>
<p class="text-gray-600 leading-relaxed">
    We offer premium designs at competitive prices, ensuring you get the best value without compromising on style or quality.
</p>
            </div>

            <!-- Benefit 5 -->
            <div class="why-card bg-white border border-gray-100 rounded-3xl p-4 md:p-10 hover:border-[#D4AF37] hover:shadow-[0_10px_30px_rgba(212,175,55,0.15)] transition-all">
                <div class="benefit-icon mb-6 text-4xl">🛡️</div>
                <h3 class="text-2xl font-semibold mb-4">Trusted Quality Assurance</h3>
<p class="text-gray-600 leading-relaxed">
    Each product goes through quality checks to ensure it meets our standards of design, fabric, and finishing.
</p>
            </div>

            <!-- Benefit 6 -->
            <div class="why-card bg-white border border-gray-100 rounded-3xl p-4 md:p-10 hover:border-[#D4AF37] hover:shadow-[0_10px_30px_rgba(212,175,55,0.15)] transition-all">
                <div class="benefit-icon mb-6 text-4xl">🤝</div>
                <h3 class="text-2xl font-semibold mb-4">Customer-First Experience</h3>
<p class="text-gray-600 leading-relaxed">
    From selection to delivery, we focus on providing a smooth and reliable shopping experience with dedicated support.
</p>
            </div>

        </div>
    </div>
</section>

  @if (count($brands) > 0)

    <!-- Our Partners / Trusted Brands Section -->
    <section class="bg-white py-8 md:py-24 border-t border-gray-100">
      <div class="max-w-7xl mx-auto px-6 text-center">
        <!-- Heading & Description -->
        <h2 class="text-3xl md:text-4xl font-bold tracking-tight mb-4">
  Our Style & Craft Partners
</h2>
<p class="text-lg text-gray-600 max-w-3xl mx-auto mb-12">
  We collaborate with skilled artisans, designers, and trusted suppliers to bring you premium fabrics, handcrafted designs, and exclusive ethnic wear collections.
</p>

        <!-- Logo Trail -->
        <div class="overflow-x-auto scrollbar-hide trusted-brand">
          <div class="flex items-center justify-center gap-12 md:gap-16 lg:gap-20 min-w-max py-6 px-4">

            @foreach($brands as $brand)
              <div class="flex flex-col items-center min-w-[100px]">
                <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}"
                  class="h-10 md:h-12 grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
              </div>
            @endforeach

          </div>
        </div>

        <!-- Optional subtle scroll hint for mobile -->
        <div class="text-center text-sm text-gray-400 mt-4 md:hidden">
          ← Scroll to see more partners →
        </div>
      </div>
    </section>

  @endif

<!-- Final CTA -->
<section class="py-20 bg-gradient-to-r from-[#f4a261] to-[#e07a5f] text-white">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold mb-6">Ready to Elevate Your Style?</h2>
<p class="text-xl mb-10 opacity-90">
    Discover premium ethnic wear designed to make every moment special — from everyday elegance to bridal celebrations.
</p>

<a href="{{ route('products') }}" 
   class="px-10 py-5 bg-white text-[#e07a5f] font-semibold rounded-2xl text-lg hover:bg-gray-100 transition-all">
    Explore Our Collection
</a>

<a href="javascript:void(0)" onclick="openGlobalDrawer('Customise Your Outfit', 'why_us_page')"
   class="px-10 py-5 border-2 border-white font-semibold rounded-2xl text-lg hover:bg-white hover:text-[#e07a5f] transition-all">
    Customise Your Style
</a>
        </div>
    </div>
</section>


@endsection