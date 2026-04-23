@extends('layouts.app')

@section('meta_title', $product->meta_title ?? $product->name)

@section('meta_description', $product->meta_description ?? $product->sub_title)

<style>
    .action-btn {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .action-btn:active {
        transform: scale(0.97);
    }

    /* Responsive Grid Adjustment */
    @media (max-width: 640px) {
        .action-btn {
            padding: 18px 20px;
            font-size: 1.05rem;
        }
    }
</style>

@section('content')


    <div class="max-w-7xl mx-auto px-6 py-12">

        <div class="text-sm text-gray-500 mb-6 flex flex-wrap gap-1 items-center">

            <a href="/" class="hover:text-black">Home</a>

            @if($product->categories && $product->categories->count())
                @php $cat = $product->categories->first(); @endphp
                <span>/</span>
                <a href="#" class="hover:text-black">{{ $cat->name }}</a>
            @endif

            @if($product->subcategories && $product->subcategories->count())
                @php $sub = $product->subcategories->first(); @endphp
                <span>/</span>
                <a href="#" class="hover:text-black">{{ $sub->name }}</a>
            @endif

            <span>/</span>
            <span class="text-gray-800 font-medium">{{ $product->name }}</span>

        </div>

        <div class="grid lg:grid-cols-2 gap-12">

            <!-- ==================== LEFT: IMAGE SLIDER ==================== -->
            <div>
                <div>
                    <!-- Main Slider -->
                    <div class="product-slider h-[300px] lg:h-[520px] bg-gray-100 relative" id="mainSlider">

                        @php
                            $images = [];

                            // main image
                            if ($product->image) {
                                $images[] = $product->image;
                            }

                            // future support (if you add multiple images)
                            if (isset($product->images)) {
                                foreach ($product->images as $img) {
                                    $images[] = $img->image;
                                }
                            }
                        @endphp

                        @if(count($images))
                            @foreach($images as $key => $img)
                                <img src="{{ asset('storage/' . $img) }}"
                                    class="slide {{ $key == 0 ? 'active' : '' }} w-full h-full object-cover"
                                    alt="{{ $product->name }}">
                            @endforeach
                        @else
                            <img src="/default-product.png" class="w-full h-full object-cover">
                        @endif

                    </div>

                    <!-- Thumbnail Strip -->
                    <div class="flex gap-4 mt-6">
                        @foreach($images as $key => $img)
                            <img onclick="changeSlide({{ $key }})" src="{{ asset('storage/' . $img) }}"
                                class="thumb w-20 h-20 object-cover rounded-2xl cursor-pointer {{ $key == 0 ? 'active' : '' }}">
                        @endforeach
                    </div>

                </div>

            </div>

            <!-- ==================== RIGHT: PRODUCT INFO ==================== -->
            <div>

                <div class="flex items-center justify-between">

                    <h1 class="text-4xl font-bold leading-tight text-gray-900">
                        {{ $product->name }}
                    </h1>

                    <!-- ❤️ WISHLIST ICON -->
                    <div class="cursor-pointer wishlist-btn" data-id="{{ $product->id }}">

                        @php
                            $inWishlist = auth('customer')->check()
                                ? \App\Models\Wishlist::where('user_id', auth('customer')->id())
                                    ->where('product_id', $product->id)
                                    ->exists()
                                : false;
                        @endphp

                        <i class="fa{{ $inWishlist ? 's' : 'r' }} fa-heart text-2xl 
                {{ $inWishlist ? 'text-red-500' : 'text-gray-400' }}">
                        </i>

                    </div>

                </div>
                <div class="flex gap-2 flex-wrap mt-2">


                    @if($product->new_arrival)
                        <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded">New Arrivals</span>
                    @endif



                    @if($product->sale)
                        <span class="bg-red-100 text-red-700 text-xs px-2 py-1 rounded">On Sale</span>
                    @endif


                </div>
                <hr class="mt-3 mb-3">
                <p class="text-gray-500 text-lg">{{ $product->sub_title }}</p>
                <div class=" text-sm text-gray-600 mt-3  gap-4" style="display:flex; align-items:center;">

                    @if($product->brand)
                        <p class="m-0"><span class="font-medium text-gray-800">Brand:</span> {{ $product->brand->name }}</p>
                    @endif

                    @if($product->sku)
                        <p class="m-0"><span class="font-medium text-gray-800">SKU:</span> {{ $product->sku }}</p>
                    @endif

                    @if($product->product_code)
                        <p class="m-0"><span class="font-medium text-gray-800">Product Code:</span> {{ $product->product_code }}
                        </p>
                    @endif

                </div>

                @php
                    $price = (float) $product->price;
                    $mrp = (float) $product->mrp;

                    $hasDiscount = $mrp > $price && $price > 0;

                    $discountAmount = $mrp - $price;
                    $discountPercent = $mrp > 0 ? round(($discountAmount / $mrp) * 100) : 0;
                @endphp

                <div class="mt-6">

                    @if($price > 0)

                        <!-- NORMAL PRICE -->
                        <div class="flex items-center gap-3">
                            <span class="text-4xl font-bold text-gray-800">₹{{ $price }}</span>

                            @if($hasDiscount)
                                <span class="text-gray-400 line-through text-lg">₹{{ $mrp }}</span>
                            @endif
                        </div>

                        @if($hasDiscount)
                            <div class="mt-2 text-green-600 font-medium text-sm">
                                @if($product->discount_type == 'percentage')
                                    You Save {{ $discountPercent }}%
                                @else
                                    You Save ₹{{ $discountAmount }}
                                @endif
                            </div>
                        @endif

                    @else

                        <!-- ✅ PRICE HIDDEN -->
                        <p class="text-sm text-gray-500 font-medium">
                            For Price Contact Us
                        </p>

                    @endif

                </div>

                @if($product->customizations && $product->customizations->count())
                    <div class="mt-8">
                        <h3 class="font-semibold mb-3">Customization Options</h3>
                        <div class="flex gap-3">
                            @foreach($product->customizations as $custom)
                                <button class="px-6 py-3 border-2 border-[#D4AF37] text-[#D4AF37] rounded-2xl font-medium">
                                    {{ $custom->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif



                @if($product->summary)
                    <div class="mt-10">
                        <h3 class="font-semibold mb-4 text-gray-800">Product Summary</h3>

                        <div id="summary-text" class="text-gray-600 leading-relaxed">
                            {{ $product->summary }}
                        </div>

                        @if(strlen($product->summary) > 50)
                            <button onclick="toggleReadMore(this)" id="read-more-btn"
                                class=" text-[#D4AF37] font-medium flex items-center gap-2 hover:text-[#e07a5f] transition-colors">
                                Read More
                                <i class="fas fa-chevron-down text-sm transition-transform"></i>
                            </button>
                        @endif
                    </div>
                @endif
                @if($product->occasions && $product->occasions->count())
                    <div class="mt-5">
                        <h3 class="font-semibold mb-4 text-gray-800">Suitable For</h3>

                        <div class="flex flex-wrap gap-2">
                            @foreach($product->occasions as $o)
                                <span class="px-3 py-2 bg-gray-100 rounded-full text-sm">
                                    {{ $o->title }}
                                </span>
                            @endforeach
                        </div>


                    </div>



                @endif

                <div class="mt-10 grid grid-cols-2 gap-4">
                    @if($product->min_qty)
                        <div>
                            <p class="text-sm text-gray-500">Minimum Order Quantity</p>
                            <p class="font-semibold text-xl">{{ $product->min_qty }} Pieces</p>
                        </div>
                    @endif
                    @if($product->delivery_time)
                        <div>
                            <p class="text-sm text-gray-500">Delivery Time</p>
                            <p class="font-semibold text-xl">{{ $product->delivery_time }}</p>
                        </div>
                    @endif
                </div>


                <hr class="mt-3 mb-3">
                <div class="flex gap-2 flex-wrap mt-2">

                    @if($product->featured)
                        <span class="bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded">Featured Products</span>
                    @endif



                    @if($product->best_seller)
                        <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded">Best Seller</span>
                    @endif



                    @if($product->is_premium)
                        <span class="bg-purple-100 text-purple-700 text-xs px-2 py-1 rounded">Premium Gifting</span>
                    @endif



                    @if($product->gift_hamper)
                        <span class="bg-pink-100 text-pink-700 text-xs px-2 py-1 rounded">Gifting</span>
                    @endif

                    @if($product->is_engraving)
                        <span class="bg-indigo-100 text-indigo-700 text-xs px-2 py-1 rounded">Engraving Available</span>
                    @endif


                </div>

                <!-- Action Buttons -->
                <!-- ===================== PRODUCT ACTION BUTTONS ===================== -->
                <div class="mt-12">
                    <div
                        class="grid grid-cols-1 sm:grid-cols-{{ $product->cart && $product->whatsapp && $product->call ? '3' : ($product->cart && $product->whatsapp || $product->cart && $product->call || $product->whatsapp && $product->call ? '2' : '1') }} gap-4">

                        <!-- Add to Cart Button -->
                        @if($product->cart)
                            <button data-id="{{ $product->id }}"
                                class="action-btn add-to-cart flex items-center justify-center gap-3 py-5 rounded-3xl text-lg font-semibold bg-gradient-to-r from-[#D4AF37] to-[#e07a5f] text-white shadow-lg hover:shadow-xl transition-all active:scale-[0.98]">
                                <i class="fa-solid fa-cart-plus"></i>
                                Add to Cart
                            </button>
                        @endif

                        <!-- WhatsApp Button -->
                        @if($product->whatsapp)
                            <a href="https://wa.me/919876543210" target="_blank"
                                class="action-btn whatsapp-btn flex items-center justify-center gap-3 py-5 rounded-3xl text-lg font-semibold bg-[#25D366] hover:bg-[#20ba5a] text-white shadow-lg hover:shadow-xl transition-all active:scale-[0.98]">
                                <i class="fa-brands fa-whatsapp text-2xl"></i>
                                WhatsApp
                            </a>
                        @endif

                        <!-- Call Now Button -->
                        @if($product->call)
                            <a href="tel:919876543210"
                                class="action-btn call-btn flex items-center justify-center gap-3 py-5 rounded-3xl text-lg font-semibold border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white transition-all active:scale-[0.98]">
                                <i class="fa-solid fa-phone text-xl"></i>
                                Call Now
                            </a>
                        @endif

                    </div>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mt-2">
                    <div class="flex items-center gap-2 text-gray-600">
                        @if($product->pan_india)
                            <i class="fa-solid fa-truck"></i>
                            <span>Pan India Delivery</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        @if($product->quality)
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Quality Guaranteed</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        @if($product->bulk_available)
                            <i class="fa-solid fa-dolly"></i>
                            <span>Bulk Orders</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-2 text-gray-600">
                        @if($product->ready_to_ship)
                            <i class="fa-solid fa-truck-fast"></i>
                            <span>Ready to Ship</span>
                        @endif
                    </div>


                </div>



            </div>

        </div>

    </div>
    <section class="max-w-7xl mx-auto px-6 py-12">
        <div class="mt-10 pt-6">

            <!-- ITEM 2 -->
            @if($product->details)
                <div class="border-b py-4">
                    <button onclick="toggleAccordion(this)"
                        class="w-full flex justify-between items-center font-semibold text-lg">
                        Product Details
                        <span class="text-xl">+</span>
                    </button>

                    <div class="hidden mt-3 text-gray-600 leading-relaxed">
                        {!! $product->details !!}
                    </div>
                </div>
            @endif

            <!-- ITEM 3 -->
            @if($product->delivery_returns)
                <div class="border-b py-4">
                    <button onclick="toggleAccordion(this)"
                        class="w-full flex justify-between items-center font-semibold text-lg">
                        Delivery & Returns
                        <span class="text-xl">+</span>
                    </button>

                    <div class="hidden mt-3 text-gray-600 leading-relaxed">
                        {!! $product->delivery_returns !!}
                    </div>
                </div>
            @endif

            @if($product->inclusions && $product->inclusions->count())
                <div class="border-b py-4">
                    <button onclick="toggleAccordion(this)"
                        class="w-full flex justify-between items-center font-semibold text-lg">
                        What's Included
                        <span class="text-xl">+</span>
                    </button>

                    <div class="hidden mt-3 text-gray-600">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($product->inclusions as $inc)
                                <li>{{ $inc->title ?? $inc->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- @if($product->occasions && $product->occasions->count())
            <div class="border-b py-4">
                <button onclick="toggleAccordion(this)"
                    class="w-full flex justify-between items-center font-semibold text-lg">
                    Suitable For
                    <span class="text-xl">+</span>
                </button>

                <div class="hidden mt-3 text-gray-600">
                    <div class="flex flex-wrap gap-2">
                        @foreach($product->occasions as $o)
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">
                            {{ $o->title }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            --}}

        </div>
    </section>

    @if($newArrivals->count())
        <section class="py-16 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-10">New Arrivals</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($newArrivals as $item)
                        @php $price = (float) $item->price; @endphp

                        <a href="{{ route('product.detail', $item->slug) }}" class="block">

                            <div class="product-card bg-white rounded-3xl overflow-hidden">
                                <img src="{{ asset('storage/' . $item->image) }}"
                                    class="w-full  h-[350px] md:h-[350px] object-cover">

                                <div class="p-5">
                                    <h3 class="font-semibold">{{ \Illuminate\Support\Str::words($item->name, 7, '...') }}</h3>
                                    <p class="text-gray-500 text-sm">{{ $item->sub_title }}</p>

                                    @if($price > 0)
                                        <p class="font-bold mt-2">₹{{ $price }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ==================== RELATED PRODUCTS SECTION ==================== -->
    @if($relatedProducts->count())
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-6">
                <h2 class="text-3xl font-bold text-center mb-10">Related Products</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $item)
                        @php $price = (float) $item->price; @endphp
                        <a href="{{ route('product.detail', $item->slug) }}" class="block">
                            <div class="product-card bg-white rounded-3xl overflow-hidden">
                                <img src="{{ asset('storage/' . $item->image) }}"
                                    class="w-full h-[350px] md:h-[350px] object-cover">

                                <div class="p-5">
                                    <h3 class="font-semibold">{{ \Illuminate\Support\Str::words($item->name, 7, '...') }}</h3>
                                    <p class="text-gray-500 text-sm">{{ $item->sub_title }}</p>
                                    @if($price > 0)
                                        <p class="font-bold mt-2">₹{{ $price }}</p>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');

        function changeSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            slides[n].classList.add('active');

            // Update active thumbnail
            document.querySelectorAll('.thumb').forEach((thumb, i) => {
                thumb.classList.toggle('active', i === n);
            });

            currentSlide = n;
        }

        // Auto slide every 5 seconds
        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            changeSlide(currentSlide);
        }, 5000);

        function addToQuote() {
            alert("Product added to your quote request! Our team will contact you shortly.");
        }

        function toggleAccordion(el) {
            const content = el.nextElementSibling;
            const icon = el.querySelector('span');

            content.classList.toggle('hidden');

            if (content.classList.contains('hidden')) {
                icon.innerText = '+';
            } else {
                icon.innerText = '−';
            }
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
        function toggleReadMore(btn) {
            const textDiv = document.getElementById('summary-text');
            const icon = btn.querySelector('i');

            if (textDiv.classList.contains('line-clamp-3')) {
                // Show full text
                textDiv.classList.remove('line-clamp-3');
                btn.innerHTML = `Read Less <i class="fas fa-chevron-up text-sm transition-transform"></i>`;
            } else {
                // Collapse back
                textDiv.classList.add('line-clamp-3');
                btn.innerHTML = `Read More <i class="fas fa-chevron-down text-sm transition-transform"></i>`;
            }
        }

        // Initial setup - limit to 3 lines if long text
        document.addEventListener('DOMContentLoaded', function () {
            const summaryText = document.getElementById('summary-text');
            if (summaryText && summaryText.textContent.length > 50) {
                summaryText.classList.add('line-clamp-3');
            }
        });


        document.addEventListener('click', function (e) {

            let btn = e.target.closest('.wishlist-btn');
            if (!btn) return;

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
                        icon.classList.add('far', 'text-gray-400');
                    }

                });

        });
    </script>

@endsection