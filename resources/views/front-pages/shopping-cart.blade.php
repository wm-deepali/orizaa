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

            <!-- Cart Items -->
            <div class="lg:col-span-8">

                @forelse($cartItems as $item)
                    <div class="cart-item flex flex-col sm:flex-row  gap-2 md:gap-6 bg-white border border-gray-100 rounded-3xl p-3 md:p-6 mb-6">

                        <div class="w-100 h-100 md:w-32 md:h-32 bg-gray-100 rounded-2xl overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                        </div>

                        <div class="flex-1">
                            <div class=" flex flex-col sm:flex-row justify-between">
                                <div class="mb-2">
                                    <h3 class="font-semibold text-xl">{{ $item->product->name }}</h3>
                                    <p class="text-gray-500">
                                        Quantity: {{ $item->quantity }}
                                    </p>
                                </div>
                                <button class="remove-item bg-red-50 py-2 px-3 rounded content-fit text-red-500 hover:text-red-600 text-sm" data-id="{{ $item->id }}">
                                    Remove
                                </button>
                            </div>

                            <div class="mt-6 flex justify-between items-end">
                                <div>
                                    <span class="text-2xl font-bold">
                                        ₹{{ $item->price }}
                                    </span>
                                    <span class="text-sm text-gray-400">per piece</span>
                                </div>

                                <div class="text-right">
                                    <p class="text-gray-600">Subtotal</p>
                                    <p class="text-2xl font-semibold text-gray-800">
                                        ₹{{ $item->total }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Your cart is empty</p>
                @endforelse

            </div>

            <!-- Order Summary Sidebar -->
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

                        <!-- <div class="flex justify-between">
                                                <span>Customization Charges</span>
                                                <span>₹{{ $customization }}</span>
                                            </div> -->
                    </div>

                    <div class="border-t border-gray-200 my-6"></div>

                    <div class="flex justify-between text-xl font-semibold">
                        <span>Total Estimated Amount</span>
                        <span>₹{{ $grandTotal }}</span>
                    </div>

                    <p class="text-xs text-gray-500 mt-8 text-center">
                        Prices are just for reference. Actual price will be shared in final quote.
                    </p>

                    <!-- Request Final Quote Button -->
                    <button onclick="openEnquiryModal()" class="quote-btn w-full mt-8 text-lg bg-gradient-to-r from-[#B8962E] to-[#D4AF37]">
                        Request a Final Quote
                    </button>

                    <p class="text-center text-xs text-gray-500 mt-6">
                        Our team will review your cart and send you a detailed customized quote within 24 hours.
                    </p>

                </div>
            </div>

        </div>
    </div>

    <!-- ENQUIRY MODAL -->
    <div id="enquiryModal"
        class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 transition-opacity duration-300">

        <div id="modalContent"
            class="bg-white w-full max-w-2xl p-10 rounded-3xl shadow-2xl transform scale-95 opacity-0 transition-all duration-300">

            <!-- Header -->
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Submit Enquiry</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-red-500 text-xl">✕</button>
            </div>

            <!-- FORM -->
            <form id="enquiryForm" class="space-y-5">

                <!-- Row 1 -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-600">Business Name</label>
                        <input type="text" name="business_name" class="input mt-1" required>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Owner Name</label>
                        <input type="text" name="owner_name" class="input mt-1" required>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input type="email" name="email" class="input mt-1" required>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Mobile</label>
                        <input type="text" name="mobile" class="input mt-1" required>
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label class="text-sm text-gray-600">Full Address</label>
                    <textarea name="address" rows="3" class="input mt-1" required></textarea>
                </div>

                <!-- State + City -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-600">State</label>
                        <select name="state" id="state" class="input mt-1" required>
                            <option value="">Select State</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">City</label>
                        <select name="city" id="city" class="input mt-1" required>
                            <option value="">Select City</option>
                        </select>
                    </div>
                </div>

                <!-- CAPTCHA -->
                <div>
                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                </div>

                <!-- Submit -->
                <button id="submitBtn"
                    class="w-full bg-black text-white py-3 rounded-xl font-semibold hover:bg-gray-800 transition flex items-center justify-center gap-2">

                    <span id="btnText">Submit Enquiry</span>
                    <svg id="loader" class="animate-spin h-5 w-5 hidden" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                </button>

            </form>
        </div>
    </div>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>

        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function () {

                let itemId = this.getAttribute('data-id');

                fetch("{{ route('cart.remove') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        item_id: itemId
                    })
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

                        // ✅ Remove item from UI instantly
                        this.closest('.cart-item').remove();

                        // ✅ Reload page (to update totals + header count)
                        setTimeout(() => {
                            location.reload();
                        }, 800);

                    });

            });
        });


        function openEnquiryModal() {
            let modal = document.getElementById('enquiryModal');
            let content = document.getElementById('modalContent');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 50);

            if (typeof grecaptcha !== 'undefined') {
                grecaptcha.reset();
            }
        }

        function closeModal() {
            let modal = document.getElementById('enquiryModal');
            let content = document.getElementById('modalContent');

            content.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }


        // STATE → CITY
        let cityDropdown = document.getElementById('city');
        cityDropdown.disabled = true;

        document.getElementById('state').addEventListener('change', function () {

            let stateId = this.value;
            cityDropdown.disabled = false;

            fetch(`/get-cities/${stateId}`)
                .then(res => res.json())
                .then(data => {

                    cityDropdown.innerHTML = '<option value="">Select City</option>';

                    data.forEach(item => {
                        cityDropdown.innerHTML += `<option value="${item.id}">${item.name}</option>`;
                    });

                });
        });


        // SUBMIT FORM
        document.getElementById('enquiryForm').addEventListener('submit', function (e) {
            e.preventDefault();

            let btn = document.getElementById('submitBtn');
            let loader = document.getElementById('loader');
            let text = document.getElementById('btnText');

            let formData = new FormData(this);

            let recaptcha = grecaptcha.getResponse();

            if (recaptcha.length === 0) {
                Swal.fire('Error', 'Please verify captcha', 'error');
                return;
            }

            formData.append('g-recaptcha-response', recaptcha);

            // 🔥 LOADING STATE
            btn.disabled = true;
            loader.classList.remove('hidden');
            text.innerText = "Submitting...";

            fetch("{{ route('enquiry.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
                .then(res => res.json())
                .then(data => {

                    btn.disabled = false;
                    loader.classList.add('hidden');
                    text.innerText = "Submit Enquiry";

                    if (data.status) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: data.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        setTimeout(() => {
                            window.location.href = data.redirect;
                        }, 1500);
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(() => {
                    btn.disabled = false;
                    loader.classList.add('hidden');
                    text.innerText = "Submit Enquiry";

                    Swal.fire('Error', 'Something went wrong', 'error');
                });
        });

    </script>
@endsection