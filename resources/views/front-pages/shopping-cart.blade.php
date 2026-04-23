@extends('layouts.app')

@section('content')

    <style>
        .input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            outline: none;
            transition: 0.2s;
            font-size: 14px;
            background: #fafafa;
        }

        .input:focus {
            border-color: #000;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
        }
    </style>

    <div class="max-w-7xl mx-auto px-6 py-12">

        <h1 class="text-2xl md:text-4xl font-bold text-gray-900 mb-2">Your Cart</h1>
        <p class="text-gray-600">Review your selected products before requesting a final quote</p>

        <div class="grid lg:grid-cols-12 gap-10 mt-10">

            <!-- CART ITEMS -->
            <div class="lg:col-span-8">

                @forelse($cartItems as $item)
                    <div
                        class="cart-item flex flex-col sm:flex-row gap-2 md:gap-6 bg-white border border-gray-100 rounded-3xl p-3 md:p-6 mb-6">

                        <div class="w-100 h-100 md:w-32 md:h-32 bg-gray-100 rounded-2xl overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1">
                            <div class="flex flex-col sm:flex-row justify-between">
                                <div class="mb-2">
                                    <h3 class="font-semibold text-xl">{{ $item->product->name }}</h3>
                                    <p class="text-gray-500">Quantity: {{ $item->quantity }}</p>
                                </div>

                                <button class="remove-item bg-red-50 py-2 px-3 rounded text-red-500 text-sm"
                                    data-id="{{ $item->id }}">
                                    Remove
                                </button>
                            </div>

                            <div class="mt-6 flex justify-between items-end">
                                <div>
                                    @if($item->price > 0)
                                        <span class="text-2xl font-bold">₹{{ $item->price }}</span>
                                        <span class="text-sm text-gray-400">per piece</span>
                                    @else
                                        <p class="text-xs text-[#e07a5f] font-medium">For Price Contact Us</p>
                                    @endif
                                </div>

                                <div class="text-right">
                                    <p class="text-gray-600">Subtotal</p>
                                    <p class="text-2xl font-semibold text-gray-800">₹{{ $item->total }}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Your cart is empty</p>
                @endforelse

            </div>

            <!-- ORDER SUMMARY -->
            <div class="lg:col-span-4">
                <div class="bg-white border border-gray-100 rounded-3xl p-4 md:p-8 sticky top-24">

                    <h3 class="font-semibold text-2xl mb-6">Order Summary</h3>

                    <div class="space-y-4 text-gray-600">

                        <div class="flex justify-between">
                            <span>Subtotal ({{ $totalItems }} items)</span>
                            <span class="font-medium">₹{{ $subtotal }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Shipping Charges</span>
                            <span class="text-green-600">
                                {{ $shipping == 0 ? 'Free' : '₹' . $shipping }}
                            </span>
                        </div>

                        {{-- COUPON --}}
                        @if($discount > 0)
                            <div class="flex justify-between text-green-600">
                                <span>Discount</span>
                                <span>- ₹{{ $discount }}</span>
                            </div>
                        @endif

                        {{-- GST --}}
                        @if($gstType == 'cgst_sgst')
                            <div class="flex justify-between">
                                <span>CGST</span>
                                <span>₹{{ $cgstAmount }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span>SGST</span>
                                <span>₹{{ $sgstAmount }}</span>
                            </div>
                        @else
                            <div class="flex justify-between">
                                <span>IGST</span>
                                <span>₹{{ $igstAmount }}</span>
                            </div>
                        @endif

                    </div>

                    <div class="border-t border-gray-200 my-6"></div>

                    {{-- COUPON INPUT --}}
                    <div class="mb-4">
                        <div class="flex gap-2">
                            <input type="text" id="coupon_code" placeholder="Coupon code" class="input">
                            <button id="applyCouponBtn" class="bg-black text-white px-3 rounded">
                                Apply
                            </button>
                        </div>

                        @if(session('coupon'))
                            <div class="text-green-600 text-sm mt-2 flex justify-between">
                                <span>{{ session('coupon.code') }} applied</span>
                                <button id="removeCouponBtn" class="text-red-500 text-xs">Remove</button>
                            </div>
                        @endif
                    </div>

                    <div class="flex justify-between text-xl font-semibold">
                        <span>Total Estimated Amount</span>
                        <span>₹{{ $grandTotal }}</span>
                    </div>

                    <p class="text-xs text-gray-500 mt-8 text-center">
                        Prices are just for reference. Actual price will be shared in final quote.
                    </p>

                    @if(auth('customer')->check())
                        <a href="{{ route('checkout') }}"
                            class="quote-btn w-full mt-8 text-lg bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-center block">
                            Checkout
                        </a>
                    @else
                        <a href="{{ route('user-login') }}"
                            class="quote-btn w-full mt-8 text-lg bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-center block"
                            onclick="event.preventDefault(); window.location='{{ route('user-login') }}';">
                            Login to Checkout
                        </a>
                    @endif
                    <p class="text-center text-xs text-gray-500 mt-6">
                        Our team will review your cart and send you a detailed customized quote within 24 hours.
                    </p>

                </div>
            </div>

        </div>
    </div>

    <script>
        // REMOVE ITEM
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function () {

                let itemId = this.getAttribute('data-id');

                fetch("{{ route('cart.remove') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ item_id: itemId })
                })
                    .then(res => res.json())
                    .then(data => {

                        Swal.fire({
                            icon: 'success',
                            title: 'Removed!',
                            text: data.message,
                            timer: 1200,
                            showConfirmButton: false
                        });

                        this.closest('.cart-item').remove();

                        setTimeout(() => location.reload(), 800);

                    });

            });
        });


        // APPLY COUPON
        document.getElementById('applyCouponBtn')?.addEventListener('click', function () {

            let code = document.getElementById('coupon_code').value;

            fetch("{{ route('cart.applyCoupon') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ code: code })
            })
                .then(res => res.json())
                .then(data => {

                    Swal.fire({
                        icon: data.status ? 'success' : 'error',
                        text: data.message,
                        timer: 1200,
                        showConfirmButton: false
                    });

                    if (data.status) {
                        setTimeout(() => location.reload(), 800);
                    }
                });

        });

        // REMOVE COUPON
        document.getElementById('removeCouponBtn')?.addEventListener('click', function () {

            fetch("{{ route('cart.removeCoupon') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }).then(() => location.reload());

        });
    </script>

@endsection