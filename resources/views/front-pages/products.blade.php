
@extends('layouts.app')

@if ($category)
@section('meta_title', $category->meta_title ?? $category->name)

@section('meta_description', $category->meta_description ?? $category->sub_title)
@endif

@section('content')

<!-- ===================== CATEGORY HERO SECTION ===================== -->
<!-- ===================== LIGHT PASTEL CATEGORY HERO SECTION ===================== -->
<section class="relative min-h-[380px] md:min-h-[420px] lg:min-h-[460px] flex items-center bg-gradient-to-br from-[#f8f4ed] via-[#f5f0fa] to-[#f0f9ff] overflow-hidden">
    
    <!-- Soft Pastel Background Pattern -->
    <div class="absolute inset-0 bg-[radial-gradient(#D4AF37_0.8px,transparent_1px)] [background-size:40px_40px] opacity-10"></div>

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-6 w-full z-10">
        <div class="max-w-2xl">
            
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-sm text-gray-600 mb-6">
                <a href="{{ url('/') }}" class="hover:text-gray-900 transition-colors">Home</a>
                <span class="text-gray-400">›</span>
                <a href="{{ url('categories') }}" class="hover:text-gray-900 transition-colors">Categories</a>
                <span class="text-gray-400">›</span>
                <span class="font-medium text-gray-900">{{ $category->name ?? 'Category' }}</span>
            </nav>

            <!-- Main Heading -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight tracking-tight text-gray-900 mb-6">
                {{ $category->name ?? 'Premium Outfits' }}
            </h1>

            <!-- Subtitle -->
            <p class="text-lg md:text-xl text-gray-700 max-w-lg leading-relaxed">
                {{ $category->sub_title ?? 'Discover our exclusive collection of premium outfits handcrafted with elegance and precision.' }}
            </p>

            <!-- CTA Button -->
            <div class="mt-10">
                <a href="#products"
                   class="inline-flex items-center gap-3 bg-gradient-to-r from-[#D4AF37] to-[#B8962E] text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
                    Explore Collection
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Bottom Soft Fade -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-white to-transparent"></div>
</section>
    <div class="max-w-7xl mx-auto px-3 md:px-6 py-10">

        <div class="flex flex-col lg:flex-row gap-2 md:gap-10">

            <!-- ==================== LEFT SIDEBAR ==================== -->
            <div class="lg:w-80 flex-shrink-0">
                <div class="lg:hidden mb-3 md:mb-6">
                    <button onclick="toggleCategoryDrawer()" 
                            class="w-full flex items-center justify-between bg-white border border-gray-300 px-6 py-4 rounded-2xl shadow-sm font-medium text-gray-800">
                        <span>Categories & Filters</span>
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                    <div id="categoryDrawer" 
                     class="lg:static fixed inset-y-0 left-0  w-80 bg-white shadow-2xl lg:shadow-none border-r border-gray-200 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 overflow-y-auto" style="z-index:9999;">

                    <!-- Mobile Drawer Header -->
                    <div class="lg:hidden flex items-center justify-between p-5 border-b bg-white sticky top-0 z-10">
                        <h2 class="font-bold text-2xl text-gray-800">Categories</h2>
                        <button onclick="toggleCategoryDrawer()" class="text-3xl text-gray-500 hover:text-gray-700">✕</button>
                    </div>

                    <!-- Sidebar Content -->
                    <div class="sidebar-card p-6 lg:p-0 ">
                        <h2 class="hidden lg:block font-bold text-2xl mb-6 text-gray-800">Categories</h2>

                        @foreach($categories as $cat)
                            <button 
   onclick="{{ $cat->children->count() ? 'toggleSub(this)' : "window.location='".route('products', ['subcategory' => $cat->slug])."'" }}"
    data-has-child="{{ $cat->children->count() }}"
    data-url="{{ route('products', ['subcategory' => $cat->slug]) }}"
    class="category-btn flex justify-between items-center w-full mt-6 py-3 px-4 rounded-xl hover:bg-gray-50 transition-colors {{ $parentCategory && $parentCategory->id == $cat->id ? 'active' : '' }}">

    {{ $cat->name }}

    @if($cat->children->count())
        <span class="text-xl transition-transform">›</span>
    @endif

</button>
                            
                            <div class="sub-category pl-6 space-y-2 mt-1 {{ $parentCategory && $parentCategory->id == $cat->id ? '' : 'hidden' }}">
                                @foreach($cat->children as $sub)
                                    <a href="{{ route('products', ['subcategory' => $sub->slug]) }}"
                                        class="block py-2 hover:text-[#D4AF37] {{ request('subcategory') == $sub->slug ? 'text-[#D4AF37] font-semibold' : '' }}">
                                        {{ $sub->name }}
                                    </a>
                                @endforeach
                            </div>
                        @endforeach

                        <!-- Filters -->
                        <form method="GET" class="mt-12">
                            <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">

                            <h3 class="font-semibold text-lg mb-5 text-gray-800">Filters</h3>

                            <!-- Price Range -->
                            <div class="mb-8">
                                <h4 class="font-medium mb-3">Price Range</h4>
                                <div class="flex gap-3">
                                    <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl text-sm">
                                    <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-2xl text-sm">
                                </div>
                            </div>

                            <!-- Customization -->
                            <div class="mb-8">
                                <h4 class="font-medium mb-3">Customization</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($customizations as $custom)
                                        <label>
                                            <input type="checkbox" name="customization[]" value="{{ $custom->id }}" class="hidden"
                                                {{ in_array($custom->id, request('customization', [])) ? 'checked' : '' }}>
                                            <span onclick="this.classList.toggle('active')"
                                                class="filter-chip {{ in_array($custom->id, request('customization', [])) ? 'active' : '' }}">
                                                {{ $custom->name }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Gifting Occasions -->
                            <div class="mb-8">
                                <h4 class="font-medium mb-3">Gifting Occasion</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($occasions as $occ)
                                        <label>
                                            <input type="checkbox" name="occasion[]" value="{{ $occ->slug }}" class="hidden"
                                                {{ in_array($occ->slug, request('occasion', [])) ? 'checked' : '' }}>
                                            <span onclick="this.classList.toggle('active')"
                                                class="filter-chip {{ in_array($occ->slug, request('occasion', [])) ? 'active' : '' }}">
                                                {{ $occ->title }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Brand -->
                            <div class="mb-8">
                                <h4 class="font-medium mb-3">Brand</h4>
                                @foreach($brands as $brand)
                                    <label class="flex items-center gap-2 mb-2">
                                        <input type="checkbox" name="brand[]" value="{{ $brand->id }}"
                                            {{ in_array($brand->id, request('brand', [])) ? 'checked' : '' }}>
                                        {{ $brand->name }}
                                    </label>
                                @endforeach
                            </div>

                            <!-- Delivery -->
                            <div class="mb-8">
                                <h4 class="font-medium mb-3">Delivery</h4>
                                <label class="flex items-center gap-2 mb-2">
                                    <input type="checkbox" class="accent-[#D4AF37]" name="pan_india" value="1" {{ request('pan_india') ? 'checked' : '' }}>
                                    Pan India Delivery
                                </label>
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" name="ready_to_ship" value="1" {{ request('ready_to_ship') ? 'checked' : '' }}>
                                    Ready to Ship
                                </label>
                            </div>

                            <!-- Special -->
                            <div>
                                <h4 class="font-medium mb-3">Special</h4>
                                <label class="flex items-center gap-2 mb-2">
                                    <input type="checkbox" class="accent-[#D4AF37]" name="new_arrival" value="1" {{ request('new_arrival') ? 'checked' : '' }}>
                                    New Arrivals
                                </label>
                                <label class="flex items-center gap-2 mb-2">
                                    <input type="checkbox" class="accent-[#D4AF37]" name="featured" value="1" {{ request('featured') ? 'checked' : '' }}>
                                    Featured Products
                                </label>
                                <label class="flex items-center gap-2 mb-2">
                                    <input type="checkbox" name="best_seller" value="1" {{ request('best_seller') ? 'checked' : '' }}>
                                    Best Seller
                                </label>
                                <label class="flex items-center gap-2 mb-2">
                                    <input type="checkbox" name="sale" value="1" {{ request('sale') ? 'checked' : '' }}>
                                    On Sale
                                </label>
                                <label class="flex items-center gap-2 mb-2">
                                    <input type="checkbox" name="is_premium" value="1" {{ request('is_premium') ? 'checked' : '' }}>
                                    Premium
                                </label>
                                <label class="flex items-center gap-2 mb-2">
                                    <input type="checkbox" name="gift_hamper" value="1" {{ request('gift_hamper') ? 'checked' : '' }}>
                                    Gift Hampers
                                </label>
                                <label class="flex items-center gap-2 mb-2">
    <input type="checkbox" name="bulk_available" value="1" {{ request('bulk_available') ? 'checked' : '' }}>
    Bulk Available
</label>
  <label class="flex items-center gap-2 mb-2">
    <input type="checkbox" name="is_engraving" value="1" {{ request('is_engraving') ? 'checked' : '' }}>
   Bespoke Creation
</label>
  <label class="flex items-center gap-2 mb-2">
    <input type="checkbox" name="is_personalized_engraving" value="1" {{ request('is_personalized_engraving') ? 'checked' : '' }}>
   Signature Collection
</label>
  <label class="flex items-center gap-2 ">
    <input type="checkbox" name="is_limited_edition" value="1" {{ request('is_limited_edition') ? 'checked' : '' }}>
   Limited Edition
</label>
                            </div>

                            <button type="submit"
                                class="w-full mt-8 bg-gradient-to-r from-[#D4AF37] to-[#B8962E] text-white py-3.5 rounded-2xl font-medium">
                                Apply Filters
                            </button>
                        </form>
                    </div>
                </div>
                </div>
                
                <div class="sidebar-card lg:block hidden">

                    <h2 class="font-bold text-2xl mb-6 text-gray-800">Categories</h2>

                    @foreach($categories as $cat)
                       <button 
    onclick="{{ $cat->children->count() ? 'toggleSub(this)' : "window.location='".route('products', ['subcategory' => $cat->slug])."'" }}"
    class="category-btn flex justify-between items-center mt-6 
    {{ $parentCategory && $parentCategory->id == $cat->id ? 'active' : '' }}">

    {{ $cat->name }}

    @if($cat->children->count())
        <span class="text-xl transition-transform">›</span>
    @endif

</button>

                        <div
                            class="sub-category pl-4 space-y-2 mt-2 
                                                                        {{ $parentCategory && $parentCategory->id == $cat->id ? '' : 'hidden' }}">

                            @foreach($cat->children as $sub)
                                <a href="{{ route('products', ['subcategory' => $sub->slug]) }}"
                                    class="block py-1 hover:text-[#D4AF37] 
                                                                                                                       {{ request('subcategory') == $sub->slug ? 'text-[#D4AF37] font-semibold' : '' }}">

                                    {{ $sub->name }}
                                </a>
                            @endforeach

                        </div>
                    @endforeach

                    <!-- Filters -->
                    <form method="GET" class="mt-12">

                        <input type="hidden" name="subcategory" value="{{ request('subcategory') }}">

                        <h3 class="font-semibold text-lg mb-5 text-gray-800">Filters</h3>

                        <!-- Price Range -->
                        <div class="mb-8">
                            <h4 class="font-medium mb-3">Price Range</h4>
                            <div class="flex gap-3">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-2xl text-sm">

                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-2xl text-sm">
                            </div>
                        </div>

                        <!-- Customization -->
                        <div class="mb-8">
                            <h4 class="font-medium mb-3">Customization</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($customizations as $custom)
                                    <label>
                                        <input type="checkbox" name="customization[]" value="{{ $custom->id }}" class="hidden"
                                            {{ in_array($custom->id, request('customization', [])) ? 'checked' : '' }}>

                                        <span onclick="this.classList.toggle('active')"
                                            class="filter-chip 
                                                      {{ in_array($custom->id, request('customization', [])) ? 'active' : '' }}">

                                            {{ $custom->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Gifting Occasions -->
<div class="mb-8">
    <h4 class="font-medium mb-3">Gifting Occasion</h4>

    <div class="flex flex-wrap gap-2">
        @foreach($occasions as $occ)
            <label>
                <input type="checkbox" name="occasion[]" value="{{ $occ->slug }}" class="hidden"
                    {{ in_array($occ->slug, request('occasion', [])) ? 'checked' : '' }}>

                <span onclick="this.classList.toggle('active')"
                    class="filter-chip 
                    {{ in_array($occ->slug, request('occasion', [])) ? 'active' : '' }}">
                    
                    {{ $occ->title }}
                </span>
            </label>
        @endforeach
    </div>
</div>

<div class="mb-8">
    <h4 class="font-medium mb-3">Brand</h4>

    @foreach($brands as $brand)
        <label class="flex items-center gap-2 mb-2">
            <input type="checkbox" name="brand[]" value="{{ $brand->id }}"
                {{ in_array($brand->id, request('brand', [])) ? 'checked' : '' }}>
            {{ $brand->name }}
        </label>
    @endforeach
</div>

                        <!-- Delivery -->
                        <div class="mb-8">
                            <h4 class="font-medium mb-3">Delivery</h4>
                            <label class="flex items-center gap-2 mb-2">
                                <input type="checkbox" class="accent-[#D4AF37]" name="pan_india" value="1" {{ request('pan_india') ? 'checked' : '' }}>
                                Pan India Delivery
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="ready_to_ship" value="1"
    {{ request('ready_to_ship') ? 'checked' : '' }}>Ready to Ship
                            </label>
                        </div>

                        <!-- New & Featured -->
                        <div>
                            <h4 class="font-medium mb-3">Special</h4>
                            <label class="flex items-center gap-2 mb-2">
                                <input type="checkbox" class="accent-[#D4AF37]" name="new_arrival" value="1" {{ request('new_arrival') ? 'checked' : '' }}>
                                New Arrivals
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" class="accent-[#D4AF37]" name="featured" value="1" {{ request('featured') ? 'checked' : '' }}>
                                Featured Products
                            </label>
                            <label class="flex items-center gap-2 mb-2">
    <input type="checkbox" name="best_seller" value="1" {{ request('best_seller') ? 'checked' : '' }}>
    Best Seller
</label>

<label class="flex items-center gap-2 mb-2">
    <input type="checkbox" name="sale" value="1" {{ request('sale') ? 'checked' : '' }}>
    On Sale
</label>

<label class="flex items-center gap-2 mb-2">
    <input type="checkbox" name="is_premium" value="1" {{ request('is_premium') ? 'checked' : '' }}>
    Premium
</label>

<label class="flex items-center gap-2 mb-2">
    <input type="checkbox" name="gift_hamper" value="1" {{ request('gift_hamper') ? 'checked' : '' }}>
    Gift Hampers
</label>
    <label class="flex items-center gap-2 mb-2">
    <input type="checkbox" name="bulk_available" value="1" {{ request('bulk_available') ? 'checked' : '' }}>
    Bulk Available
</label>

  <label class="flex items-center gap-2 mb-2">
    <input type="checkbox" name="is_engraving" value="1" {{ request('is_engraving') ? 'checked' : '' }}>
   Bespoke Creation
</label>
  <label class="flex items-center gap-2 mb-2">
    <input type="checkbox" name="is_personalized_engraving" value="1" {{ request('is_personalized_engraving') ? 'checked' : '' }}>
   Signature Collection
</label>
  <label class="flex items-center gap-2 mb-2">
    <input type="checkbox" name="is_limited_edition" value="1" {{ request('is_limited_edition') ? 'checked' : '' }}>
   Limited Edition
</label>
                        </div>

                        <button type="submit"
                            class="w-full mt-6 bg-gradient-to-r from-[#D4AF37] to-[#B8962E] text-white py-3 rounded-2xl font-medium">
                            Apply Filters
                        </button>
                    </form>

                </div>
            </div>

            <!-- ==================== RIGHT SIDE - PRODUCTS ==================== -->
            <div class="flex-1">

                <!-- Top Bar -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                    <div class="lg:block hidden">
                        <span class="text-gray-600">Showing</span>
                        <span class="font-semibold text-gray-800">{{ $products->total() }} Products</span>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="text-gray-600 whitespace-nowrap">Sort by:</span>
                        <select id="sortSelect" onchange="applySort(this.value)"
                            class="border border-gray-300 rounded-2xl px-6 py-3 focus:outline-none focus:border-[#D4AF37]">
                            <option value="best">Best Match</option>
                            <option value="low">Price: Low to High</option>
                            <option value="high">Price: High to Low</option>
                            <option value="new">Newest First</option>
                            <option value="popular">Most Popular</option>
                        </select>
                    </div>
                </div>
                <!-- Product Grid (3 Columns) -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

 @if($products->count() > 0)

                    @foreach($products as $product)
                        <div class="product-card bg-white">
                            <div class="relative">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="product-img w-full object-fill h-[250px] md:h-[300px]">

                                     <div class="absolute top-3 right-3 z-20 cursor-pointer wishlist-btn"
         data-id="{{ $product->id }}">

        @php
            $inWishlist = auth('customer')->check() 
                ? \App\Models\Wishlist::where('user_id', auth('customer')->id())
                    ->where('product_id', $product->id)
                    ->exists()
                : false;
        @endphp

        <i class="fa{{ $inWishlist ? 's' : 'r' }} fa-heart text-lg 
            {{ $inWishlist ? 'text-red-500' : 'text-white drop-shadow' }}">
        </i>

    </div>
    
                                {{-- Badge Logic --}}
                                @if($product->new_arrival)

                                    <span class="absolute top-3 left-3 bg-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                        New
                                    </span>
                                @elseif($product->featured)
                                    <span
                                        class="absolute top-3 left-3 bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full shadow">
                                        Featured
                                    </span>
                                @elseif($product->sale)
                                    <span
                                        class="absolute top-3 left-3 bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full shadow">
                                        Sale
                                    </span>
                                @endif
                            </div>

                            <div class="p-5">
                                <h3 class="font-semibold text-[16px]">{{ $product->name }}</h3>

                                <p class="text-gray-500 text-sm mt-1">
                                    {{ $product->sub_title }}
                                </p>

                              @if((float)$product->price > 0)
    <div class="mt-4 flex items-baseline justify-between">
        <div>
            <span class="text-3xl font-bold text-gray-800">
                ₹{{ $product->price }}
            </span>

            @if($product->mrp && $product->mrp > $product->price)
                <span class="text-sm text-gray-400 line-through ml-2">
                    ₹{{ $product->mrp }}
                </span>
            @endif
        </div>
    </div>
@endif

                                <div class="mt-6 flex gap-3">
                                    <a href="{{ route('product.detail', $product->slug) }}"
                                        class="flex-1 text-center py-3 border border-[#D4AF37] text-[#D4AF37] rounded-2xl font-medium hover:bg-[#D4AF37] hover:text-white transition-all">
                                        View Details
                                    </a>

                                    <button data-id="{{ $product->id }}"
                                        class="flex-1 py-3 bg-gradient-to-r from-[#D4AF37] to-[#B8962E] text-white rounded-2xl font-medium add-to-cart">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                      @else

                        {{-- 🔥 EMPTY STATE CARD --}}
                        <div class="col-span-3">
                            <div class="text-center p-10 border-2 border-dashed rounded-xl bg-gray-50">

                                @php
                                    $hasFilter = request()->hasAny([
                                        'min_price',
                                        'max_price',
                                        'customization',
                                        'occasion',
                                        'brand',
                                        'pan_india',
                                        'ready_to_ship',
                                        'new_arrival',
                                        'featured',
                                        'best_seller',
                                        'sale',
                                        'is_premium',
                                        'gift_hamper',
                                        'bulk_available'
                                    ]);
                                @endphp

                                {{-- ✅ FILTER / SEARCH CASE --}}
                                @if($hasFilter)

                                    <h3 class="text-lg font-semibold text-gray-700">
                                        No Products found under this filter option
                                    </h3>

                                    <a href="{{ url()->current() }}"
                                        class="inline-block mt-4 px-5 py-2 bg-[#f4a261] text-white rounded-lg hover:bg-[#e76f51]">
                                        Reset the Filter
                                    </a>

                                    {{-- ✅ PERSONALISED ENGRAVING PAGE --}}
                                @elseif(request()->is('personalised-engraving'))

                                    <h3 class="text-lg font-semibold text-gray-700">
                                        No Products found
                                    </h3>

                                    <p class="text-gray-500 mt-2">
                                        Please explore our product section
                                    </p>

                                    <a href="{{ route('products') }}"
                                        class="inline-block mt-4 px-5 py-2 bg-[#f4a261] text-white rounded-lg hover:bg-[#e76f51]">
                                        Explore Collection
                                    </a>

                                    {{-- ✅ NORMAL CATEGORY / SUBCATEGORY --}}
                                @else

                                    <h3 class="text-lg font-semibold text-gray-700">
                                        No Products Available
                                    </h3>

                                @endif

                            </div>
                        </div>

                    @endif

                </div>
                <div class="mt-10 flex justify-center">
    {{ $products->links() }}
</div>
            </div>
        </div>
    </div>
    <div id="drawerOverlay" onclick="toggleCategoryDrawer()" 
         class="lg:hidden fixed inset-0 bg-black/60 z-40 hidden"></div>

    <script>
        function toggleSub(btn) {
            const sub = btn.nextElementSibling;
            const isHidden = sub.classList.contains('hidden');

            document.querySelectorAll('.sub-category').forEach(el => {
                if (el !== sub) el.classList.add('hidden');
            });

            if (isHidden) {
                sub.classList.remove('hidden');
                document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            } else {
                sub.classList.add('hidden');
                btn.classList.remove('active');
            }
        }

        // Sort functionality (demo alert)
        document.getElementById('sortSelect').addEventListener('change', function () {
            const value = this.value;
            alert(`Sorted by: ${this.options[this.selectedIndex].text}`);
            // Here you can add actual sorting logic later
        });

        function applySort(value) {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', value);
            window.location.href = url.toString();
        }

        document.querySelectorAll('.add-to-cart').forEach(btn => {
            btn.addEventListener('click', function () {

                let productId = this.getAttribute('data-id');

                fetch("{{ route('cart.add') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        product_id: productId
                    })
                })
                    .then(res => res.json())
                    .then(data => {

                        // ✅ Update Cart Count
                        document.getElementById('cart-count').innerText = data.cart_count;

                        // ✅ Swal
                        Swal.fire({
                            icon: 'success',
                            title: 'Added!',
                            text: data.message,
                            showCancelButton: true,
                            confirmButtonText: 'Go to Cart',
                            cancelButtonText: 'Continue Shopping'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "{{ route('shopping-cart') }}";
                            }
                        });

                    });

            });
        });

    </script>


         
         <script>
function toggleCategoryDrawer() {
    const drawer = document.getElementById('categoryDrawer');
    const overlay = document.getElementById('drawerOverlay');
    
    if (drawer.classList.contains('-translate-x-full')) {
        drawer.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    } else {
        drawer.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
        document.body.style.overflow = 'visible';
    }
}


document.addEventListener('click', function(e) {

    let btn = e.target.closest('.wishlist-btn');
    if (!btn) return;

    // ✅ login check
    let isLoggedIn = {{ auth('customer')->check() ? 'true' : 'false' }};

    if (!isLoggedIn) {
        window.location.href = "/user-login";
        return;
    }

    let productId = btn.dataset.id;
    let icon = btn.querySelector('i');

    fetch("{{ route('wishlist.toggle') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(res => res.json())
    .then(data => {

        if (data.status === 'added') {
            icon.classList.remove('far');
            icon.classList.add('fas', 'text-red-500');
        } else {
            icon.classList.remove('fas', 'text-red-500');
            icon.classList.add('far', 'text-white');
        }

    });

});

</script>
@endsection


