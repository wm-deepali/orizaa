@extends('layouts.app')

@section('content')

    <style>
        /* ✅ YOUR SAME CSS (UNCHANGED) */
        body {
            margin: 0;
            padding: 0;
            background: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
        }

        .checkout-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        h2 {
            margin-bottom: 20px;
            font-size: 22px;
            border-left: 4px solid #c9a55c;
            padding-left: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .order-total {
            font-weight: bold;
            font-size: 16px;
            margin-top: 15px;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        .checkout-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #c9a55c, #f4d03f);
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 15px;
        }

        .coupon-box {
            display: flex;
            gap: 10px;
            margin: 15px 0;
        }

        .coupon-box input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .apply-btn {
            padding: 10px 15px;
            background: #c9a55c;
            border: none;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
        }

        .apply-btn:hover {
            opacity: 0.9;
        }

        .text-success {
            color: #28a745;
            font-weight: 500;
        }

        .terms-box {
            margin-top: 12px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .terms-box a {
            color: #c9a55c;
            text-decoration: none;
        }

        .address-box {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 10px;
            cursor: pointer;
            position: relative;
            transition: 0.2s;
        }

        .address-box.active {
            border: 2px solid #28a745;
            background: #f4fff6;
        }

        .selected-label {
            display: none;
            position: absolute;
            top: 8px;
            right: 10px;
            background: #28a745;
            color: #fff;
            padding: 2px 8px;
            font-size: 11px;
            border-radius: 4px;
        }

        .address-box.active .selected-label {
            display: block;
        }
    </style>

    <div class="checkout-container">

        <!-- LEFT: BILLING -->
        <div class="card">
            <h2>Billing Details</h2>

            @foreach($addresses as $addr)

                <div class="address-box" data-id="{{ $addr->id }}" onclick="selectAddress(this, {{ json_encode($addr) }})">

                    <strong>{{ $addr->first_name }} {{ $addr->last_name }}</strong><br>

                    {{ $addr->address }},
                    {{ $addr->city->name ?? '' }},
                    {{ $addr->state->name ?? '' }} -
                    {{ $addr->pincode }}<br>

                    {{ $addr->phone }}

                    <div class="selected-label">Selected</div>

                </div>

            @endforeach

            <form method="POST" action="#">
                @csrf

                <div class="grid-2">
                    <div class="form-group">
                        <input type="text" name="first_name"
                            value="{{ explode(' ', auth('customer')->user()->name)[0] ?? '' }}" placeholder="First Name"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" placeholder="Last Name">
                    </div>
                </div>

                <div class="form-group">
                    <input type="email" name="email" value="{{ auth('customer')->user()->email }}"
                        placeholder="Email Address" required>
                </div>

                <div class="form-group">
                    <input type="tel" name="phone" value="{{ auth('customer')->user()->phone }}" placeholder="Phone Number"
                        required>
                </div>

                <div class="form-group">
                    <textarea name="address" placeholder="Full Address" rows="3" required></textarea>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <select name="city" id="city" required>
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="pincode" placeholder="Pincode" required>
                    </div>
                </div>

                <div class="form-group">
                    <select name="state" id="state" required>
                        <option value="">Select State</option>
                        @foreach($states as $state)
                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                        @endforeach
                    </select>
                </div>

            </form>
        </div>

        <!-- RIGHT: ORDER SUMMARY -->
        <div class="card">
            <h2>Your Order</h2>

            {{-- PRODUCTS --}}
            @foreach($cartItems as $item)
                <div class="order-item">
                    <span>{{ $item->product->name }} x{{ $item->quantity }}</span>
                    <span>₹{{ $item->total }}</span>
                </div>
            @endforeach

            {{-- COUPON --}}
            <div class="coupon-box">
                <input type="text" id="coupon_code" placeholder="Enter Coupon Code">
                <button id="applyCouponBtn" class="apply-btn">Apply</button>
            </div>
            @if(session('coupon'))
                <div class="text-success" style="display:flex; justify-content:space-between; margin-top:5px;">
                    <span>{{ session('coupon.code') }} applied</span>
                    <button id="removeCouponBtn" style="border:none; background:none; color:red; cursor:pointer;">
                        Remove
                    </button>
                </div>
            @endif


            {{-- PRICING --}}
            <div class="order-item">
                <span>Subtotal</span>
                <span>₹{{ $subtotal }}</span>
            </div>

            @if($discount > 0)
                <div class="order-item text-success">
                    <span>Discount</span>
                    <span>- ₹{{ $discount }}</span>
                </div>
            @endif

            <div class="order-item">
                <span>CGST</span>
                <span>₹{{ $cgstAmount }}</span>
            </div>

            <div class="order-item">
                <span>SGST</span>
                <span>₹{{ $sgstAmount }}</span>
            </div>

            <div class="order-total">
                <div class="order-item">
                    <span>Total Payable</span>
                    <span>₹{{ $grandTotal }}</span>
                </div>
            </div>

            {{-- PLACE ORDER --}}
            <button class="checkout-btn" id="placeOrderBtn">Place Order</button>

            <div class="terms-box">
                <input type="checkbox" id="terms">
                <label for="terms">
                    I agree to the <a href="#">Terms & Conditions</a>
                </label>
            </div>
        </div>

    </div>


    <script>

        function selectAddress(element, addr) {

            // remove active from all
            document.querySelectorAll('.address-box')
                .forEach(el => el.classList.remove('active'));

            // add active to selected
            element.classList.add('active');

            // store selected id
            window.selectedAddressId = addr.id;

            // fill form
            document.querySelector('[name="first_name"]').value = addr.first_name || '';
            document.querySelector('[name="last_name"]').value = addr.last_name || '';
            document.querySelector('[name="email"]').value = addr.email || '';
            document.querySelector('[name="phone"]').value = addr.phone || '';
            document.querySelector('[name="address"]').value = addr.address || '';
            document.querySelector('[name="pincode"]').value = addr.pincode || '';

            document.getElementById('state').value = addr.state_id;

            fetch('/get-cities/' + addr.state_id)
                .then(res => res.json())
                .then(data => {

                    let cityDropdown = document.getElementById('city');
                    cityDropdown.innerHTML = '<option value="">Select City</option>';

                    data.forEach(city => {
                        let selected = city.id == addr.city_id ? 'selected' : '';
                        cityDropdown.innerHTML +=
                            `<option value="${city.id}" ${selected}>${city.name}</option>`;
                    });

                });
        }

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

                    if (typeof Swal !== "undefined") {
                        Swal.fire({
                            icon: data.status ? 'success' : 'error',
                            text: data.message,
                            timer: 1200,
                            showConfirmButton: false
                        });
                    } else {
                        alert(data.message);
                    }

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

        // LOAD CITIES
        document.getElementById('state').addEventListener('change', function () {

            let stateId = this.value;

            fetch('/get-cities/' + stateId)
                .then(res => res.json())
                .then(data => {

                    let cityDropdown = document.getElementById('city');
                    cityDropdown.innerHTML = '<option value="">Select City</option>';

                    data.forEach(city => {
                        cityDropdown.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                    });

                });
        });


        // PLACE ORDER AJAX
        let placeOrderBtn = document.getElementById('placeOrderBtn');

        placeOrderBtn.addEventListener('click', function () {

            // 🚫 prevent double click
            if (placeOrderBtn.disabled) return;

            let terms = document.getElementById('terms').checked;

            if (!terms) {
                alert('Please accept Terms & Conditions');
                return;
            }

            // ✅ disable button + show loading
            placeOrderBtn.disabled = true;
            placeOrderBtn.innerText = "Processing...";

            let data = {
                address_id: window.selectedAddressId || null, // ✅ NEW

                first_name: document.querySelector('[name="first_name"]').value,
                last_name: document.querySelector('[name="last_name"]').value,
                email: document.querySelector('[name="email"]').value,
                phone: document.querySelector('[name="phone"]').value,
                address: document.querySelector('[name="address"]').value,
                city: document.querySelector('[name="city"]').value,
                state: document.querySelector('[name="state"]').value,
                pincode: document.querySelector('[name="pincode"]').value,
            };

            fetch("{{ route('place.order') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            })
                .then(res => res.json())
                .then(data => {

                    if (data.status) {
                        window.location.href = data.payment_link;
                    } else {
                        alert(data.message);

                        // ❗ enable again if failed
                        placeOrderBtn.disabled = false;
                        placeOrderBtn.innerText = "Place Order";
                    }

                })
                .catch(() => {
                    placeOrderBtn.disabled = false;
                    placeOrderBtn.innerText = "Place Order";
                });
        });

    </script>

@endsection