@extends('layouts.app')

@section('content')

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fa;
        }

        .dashboard {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        /* SIDEBAR (WHITE CARD) */
        .sidebar {
            width: 240px;
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .sidebar h2 {
            color: #c9a55c;
            margin-bottom: 15px;
            border-bottom: 1px solid gray;
            font-size: 22px;
            font-weight: 600;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 5px;
            cursor: pointer;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background: #c9a55c;
            color: #fff;
        }

        /* CONTENT */
        .content {
            flex: 1;
        }

        .section {
            display: none;
        }

        .section.active {
            display: block;
        }

        /* CARD */
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
        }

        /* GRID */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        /* INPUT */
        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        /* BUTTON */
        .btn {
            background: linear-gradient(135deg, #c9a55c, #f4d03f);
            border: none;
            padding: 10px 15px;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-outline {
            border: 1px solid #c9a55c;
            padding: 8px 12px;
            background: transparent;
            color: #c9a55c;
            border-radius: 6px;
        }

        /* ORDER CARDS */
        .order-card {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 10px;
        }

        .order-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .paid {
            background: #e6f7ee;
            color: #28a745;
        }

        .pending {
            background: #fff3cd;
            color: #856404;
        }

        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            /* 🔥 increase */
        }

        .modal-content {
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            width: 420px;
            max-width: 95%;
            z-index: 10000;
            /* 🔥 above everything */
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .modal-content h3 {
            margin-bottom: 20px;
        }

        .modal-content input,
        .modal-content textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            /* 🔥 spacing fix */
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .modal-content textarea {
            resize: none;
        }

        /* GRID spacing */
        .modal-content .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            /* 🔥 better gap */
            margin-bottom: 10px;
        }

        /* BUTTON ALIGN */
        .modal-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }


        /* STAR */
        .stars i {
            font-size: 20px;
            cursor: pointer;
            color: #ccc;
        }

        .stars i.active {
            color: #f4d03f;
        }

        /* RESPONSIVE */
        @media(max-width:768px) {
            .dashboard {
                flex-direction: column;
            }
        }

        .profile-card h3 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
            border-bottom: 1px solid #f9f9f9;
        }

        .card h3 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
            border-bottom: 1px solid #f9f9f9;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #c9a55c;
            outline: none;
            box-shadow: 0 0 0 2px rgba(201, 165, 92, 0.2);
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .action-btns {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }

        /* MOBILE */
        @media(max-width:768px) {
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }

        .order-products p {
            margin: 4px 0;
            font-size: 14px;
        }

        .order-price {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            font-size: 14px;
        }

        .discount {
            color: #28a745;
            font-weight: 500;
        }



        .invoice-card {
            /*max-width: 800px;*/
            margin: auto;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header img {
            height: 60px;
        }

        .invoice-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .text-right {
            text-align: right;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .invoice-table th {
            background: #f4f4f4;
        }

        .invoice-summary {
            text-align: right;
        }

        .invoice-summary p {
            margin: 5px 0;
        }

        .invoice-summary .discount {
            color: #28a745;
        }

        .invoice-footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        /* EMPTY STATE */
        .wishlist-empty {
            border: 2px dashed #ddd;
            padding: 40px;
            text-align: center;
            border-radius: 10px;
            color: #888;
            margin-bottom: 20px;
        }

        /* GRID */
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        /* ITEM CARD */
        .wishlist-item {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            transition: 0.3s;
        }

        .wishlist-item:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .wishlist-item img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .wishlist-item h4 {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .price {
            color: #c9a55c;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .address-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .address-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }

        .address-card {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 15px;
            position: relative;
            transition: 0.3s;
        }

        .address-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .address-card.active {
            border: 2px solid #c9a55c;
        }

        .badge-default {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #c9a55c;
            color: #fff;
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 20px;
        }

        .address-card h4 {
            margin-bottom: 5px;
        }

        .address-card p {
            font-size: 13px;
            margin: 3px 0;
        }

        .address-actions {
            margin-top: 10px;
            display: flex;
            gap: 8px;
        }

        /* MODAL SIZE */
        .modal-content.large {
            width: 400px;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* LIST */
        .review-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        /* CARD */
        .review-card {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 15px;
            transition: 0.3s;
        }

        .review-card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        /* TOP */
        .review-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .review-date {
            font-size: 12px;
            color: #888;
        }

        /* STARS */
        .review-stars {
            color: #f4d03f;
            margin-bottom: 8px;
            font-size: 14px;
        }

        /* TEXT */
        .review-text {
            font-size: 14px;
            color: #555;
        }


        /* RESPONSIVE */
        @media(max-width:768px) {
            .address-grid {
                grid-template-columns: 1fr;
            }
        }


        /* RESPONSIVE */
        @media(max-width:768px) {
            .wishlist-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width:480px) {
            .wishlist-grid {
                grid-template-columns: 1fr;
            }
        }

        .order-meta {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            color: #666;
            margin: 8px 0;
        }

        .order-date {
            font-size: 12px;
            color: #888;
        }

        /* PRICE BOX */
        .order-price-box {
            margin-top: 10px;
            border-top: 1px dashed #ddd;
            padding-top: 10px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .price-row.discount {
            color: #28a745;
        }

        .price-row.total {
            border-top: 1px solid #eee;
            margin-top: 8px;
            padding-top: 8px;
            font-size: 15px;
        }

        .od-wrapper {
            /*padding: 20px;*/
            /*background: #f5f7fa;*/
        }

        .od-card {
            /*max-width: 850px;*/
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        /* HEADER */
        .od-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .od-logo img {
            height: 60px;
        }

        .od-title h2 {
            margin: 0;
        }

        .od-title p {
            font-size: 13px;
            color: #666;
        }

        /* TOP */
        .od-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            gap: 20px;
        }

        .od-box h4 {
            margin-bottom: 5px;
        }

        .od-box p {
            font-size: 13px;
            margin: 3px 0;
        }

        .od-right {
            text-align: right;
        }

        /* META */
        .od-meta {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* TABLE */
        .od-table {
            width: 100%;
            border-collapse: collapse;
        }

        .od-table th,
        .od-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .od-table th {
            background: #f4f4f4;
        }

        /* SUMMARY */
        .od-summary {
            margin-top: 20px;
            text-align: right;
        }

        .od-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .od-discount {
            color: green;
        }

        .od-total {
            border-top: 1px solid #ddd;
            margin-top: 10px;
            padding-top: 10px;
            font-size: 16px;
        }

        /* FOOTER */
        .od-footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        /* BUTTON */
        .od-action {
            text-align: center;
            margin-top: 20px;
        }

        .od-action button {
            background: linear-gradient(135deg, #c9a55c, #f4d03f);
            border: none;
            padding: 10px 18px;
            color: #fff;
            border-radius: 6px;
            cursor: pointer;
        }

        /* MOBILE */
        @media(max-width:768px) {
            .od-top {
                flex-direction: column;
            }

            .od-meta {
                flex-direction: column;
                gap: 5px;
            }

            .od-right {
                text-align: left;
            }
        }


        /* PRINT */
        @media print {
            button {
                display: none;
            }
        }

        /* MOBILE VIEW */
        @media(max-width:768px) {

            .sidebar {
                display: flex;
                flex-direction: row;
                overflow-x: auto;
                gap: 10px;
                padding: 10px;
                width: 100%;
                white-space: nowrap;
                border-radius: 10px;
            }

            .sidebar h2 {
                display: none;
                /* hide title in mobile */
            }

            .sidebar a {
                flex: 0 0 auto;
                padding: 8px 14px;
                font-size: 14px;
                border-radius: 20px;
                background: #f1f1f1;
            }

            .sidebar a.active {
                background: #c9a55c;
                color: #fff;
            }

            /* Scrollbar hide (optional clean UI) */
            .sidebar::-webkit-scrollbar {
                display: none;
            }
        }
    </style>

    <div class="dashboard">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <h2>My Account</h2>

            <a onclick="showSection('profile')" class="active">Profile</a>
            <a onclick="showSection('orders')">Orders</a>
            <a onclick="showSection('wishlist')">Wishlist</a>
            <a onclick="showSection('address')">Address</a>
            <a onclick="showSection('reviews')">Reviews</a>

            <!-- ✅ Logout -->
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <!-- CONTENT -->
        <div class="content">

            <!-- PROFILE -->
            <div id="profile" class="section active">
                <div class="card profile-card">

                    <h3>Profile Details</h3>

                    <form method="POST" action="{{ route('user.profile.update') }}">
                        @csrf

                        @php
                            $user = auth('customer')->user();
                            $states = \App\Models\State::all();
                        @endphp

                        <!-- NAME -->
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" value="{{ $user->name }}">
                        </div>

                        <!-- EMAIL + MOBILE -->
                        <div class="grid-2">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" name="email" value="{{ $user->email }}">
                            </div>

                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="text" name="phone" value="{{ $user->phone }}">
                            </div>
                        </div>

                        <!-- ALT MOBILE -->
                        <div class="form-group">
                            <label>Alternate Mobile Number</label>
                            <input type="text" name="alt_phone" value="{{ $user->alt_phone }}">
                        </div>

                        <!-- ADDRESS -->
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address">{{ $user->address }}</textarea>
                        </div>

                        <!-- CITY + PIN -->
                        <div class="grid-2">

                            <!-- CITY -->
                            <div class="form-group">
                                <label>City</label>
                                <select name="city" id="city">
                                    <option value="">Select City</option>
                                </select>
                            </div>

                            <!-- PINCODE -->
                            <div class="form-group">
                                <label>Pincode</label>
                                <input type="text" name="pincode" value="{{ $user->pincode }}">
                            </div>

                        </div>

                        <!-- STATE -->
                        <div class="form-group">
                            <label>State</label>
                            <select name="state" id="state">
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ $user->state_id == $state->id ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- BUTTON -->
                        <button class="btn">Update Profile</button>

                    </form>

                </div>
            </div>

            <!-- ORDERS -->
            <div id="orders" class="section">

                @forelse($orders as $order)

                            <div class="order-card">

                                <!-- TOP -->
                                <div class="order-top">
                                    <div>
                                        <strong>#{{ $order->order_id }}</strong>
                                        <p class="order-date">
                                            {{ $order->created_at->format('d M Y') }}
                                        </p>
                                    </div>

                                    <span style="height:30px;" class="badge {{ $order->status == 'paid' ? 'paid' : 'pending' }}">
                                        {{ $order->status == 'paid' ? 'Paid' : 'Pending' }}
                                    </span>
                                </div>

                                <!-- ORDER META -->
                                <div class="order-meta">
                                    <p>
                                        <strong>Invoice No:</strong>
                                        {{ $order->invoice_no ?? 'N/A' }}
                                    </p>

                                    <p>
                                        <strong>Payment:</strong>
                                        {{ $order->payment_status ?? 'Pending' }} (Online)
                                    </p>
                                </div>

                                <!-- PRODUCTS -->
                                <div class="order-products">
                                    @forelse($order->items as $item)

                                        @php
                                            $alreadyReviewed = \App\Models\Review::where('user_id', auth('customer')->id())
                                                ->where('product_id', $item->product_id)
                                                ->exists();
                                        @endphp

                                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:5px;">

                                            <p style="margin:0;">
                                                🎁 {{ $item->product_name }} x{{ $item->quantity }}
                                            </p>

                                            @if(!$alreadyReviewed)
                                                <button class="btn-outline"
                                                    onclick="openReviewModal({{ $item->product_id }}, '{{ $item->product_name }}')">
                                                    Review
                                                </button>
                                            @else
                                                <span style="font-size:12px; color:green;">Reviewed</span>
                                            @endif

                                        </div>

                                    @empty
                                        <p>No items found</p>
                                    @endforelse
                                </div>

                                <!-- PRICE BREAKDOWN -->
                                <div class="order-price-box">

                                    <!-- Subtotal -->
                                    <div class="price-row">
                                        <span>Subtotal</span>
                                        <span>₹{{ number_format($order->subtotal, 2) }}</span>
                                    </div>

                                    <!-- Discount -->
                                    @if($order->discount > 0)
                                        <div class="price-row discount">
                                            <span>Discount (Coupon)</span>
                                            <span>-₹{{ number_format($order->discount, 2) }}</span>
                                        </div>
                                    @endif

                                    <!-- Shipping -->
                                    <div class="price-row">
                                        <span>Shipping</span>
                                        <span>₹{{ number_format($order->shipping ?? 0, 2) }}</span>
                                    </div>

                                    <!-- GST -->
                                    <div class="price-row">
                                        <span>GST</span>
                                        <span>
                                            ₹{{ number_format(
                        ($order->cgst_amount ?? 0) +
                        ($order->sgst_amount ?? 0) +
                        ($order->igst_amount ?? 0),
                        2
                    ) }}
                                        </span>
                                    </div>

                                    <!-- TOTAL -->
                                    <div class="price-row total">
                                        <strong>Total</strong>
                                        <strong>₹{{ number_format($order->total_amount, 2) }}</strong>
                                    </div>

                                </div>

                                <!-- ACTION -->
                                <button class="btn" onclick='showOrderDetail(@json($order))'>
                                    View Details
                                </button>

                            </div>

                @empty

                    <div class="wishlist-empty">
                        <p>No orders found</p>
                    </div>

                @endforelse

            </div>


            <!-- ORDER DETAIL -->
            <div id="orderDetail" class="section">
                <div class="od-wrapper">
                    <div class="od-card">

                        <!-- HEADER -->
                        <div class="od-header">
                            <div class="od-logo">
                                <img src="{{ asset('images/oriza-logo1.jpeg') }}" alt="Logo">
                            </div>

                            <div class="od-title">
                                <h2>Order Details</h2>
                                <p><strong>Invoice No:</strong> <span id="od-invoice"></span></p>
                            </div>
                        </div>

                        <!-- TOP -->
                        <div class="od-top">

                            <!-- BILL -->
                            <div class="od-box">
                                <h4 id="od-name"></h4>
                                <p id="od-address"></p>
                                <p id="od-phone"></p>
                                <p id="od-email"></p>
                            </div>

                            <!-- COMPANY -->
                            <div class="od-box od-right">
                                <h4>ORIZAA STYLE</h4>
                                <p>510A, iThum Tower – B</p>
                                <p>Sector 62, Noida</p>
                                <p>GSTIN: 09ABCDE1234F1Z5</p>
                                <p>service@b2bgiftsindia.com</p>
                            </div>

                        </div>

                        <!-- ORDER META -->
                        <div class="od-meta">
                            <p><strong>Order ID:</strong> <span id="od-order-id"></span></p>
                            <p><strong>Date:</strong> <span id="od-date"></span></p>
                            <p><strong>Status:</strong> <span id="od-status"></span></p>
                            <p><strong>Payment:</strong> <span id="od-payment"></span></p>
                        </div>

                        <!-- TABLE -->
                        <div class="od-table-wrap">
                            <table class="od-table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="od-items"></tbody>

                            </table>
                        </div>

                        <!-- SUMMARY -->
                        <div class="od-summary">

                            <div class="od-row">
                                <span>Subtotal</span>
                                <span id="od-subtotal"></span>
                            </div>

                            <div class="od-row od-discount">
                                <span>Discount</span>

                                <span id="od-discount"></span>
                            </div>

                            <div class="od-row">
                                <span>Shipping</span>

                                <span id="od-shipping"></span>
                            </div>

                            <div class="od-row">
                                <span>GST (18%)</span>
                                <span id="od-gst"></span>

                            </div>

                            <div class="od-row od-total">
                                <strong>Total</strong>
                                <span id="od-total"></span>
                            </div>
                        </div>

                        <!-- FOOTER -->
                        <div class="od-footer">
                            <p>
                                This is a system-generated order invoice. All disputes are subject to jurisdiction.
                                Products once delivered will not be returned unless defective.
                            </p>
                        </div>

                        <!-- ACTION -->
                        <div class="od-action">
                            <button onclick="window.print()">Download Invoice</button>
                        </div>

                    </div>
                </div>

            </div>


            <!-- WISHLIST -->
            <div id="wishlist" class="section">
                <div class="card">
                    <h3>My Wishlist</h3>
                    
                    <!-- PRODUCTS (SHOW WHEN DATA AVAILABLE) -->
                    @if($wishlistItems->isEmpty())

                        <!-- EMPTY -->
                        <div class="wishlist-empty">
                            <p>No items added in wishlist</p>
                        </div>

                    @else

                        <div class="wishlist-grid">

                            @foreach($wishlistItems as $item)

                                <div class="wishlist-item">

                                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">

                                    <h4>{{ $item->product->name }}</h4>

                                    <p class="price">
                                        ₹{{ number_format($item->product->price) }}
                                    </p>

                                    <!-- ACTIONS -->
                                    <div style="display:flex; gap:8px; justify-content:center;">

                                        <!-- ADD TO CART -->
                                        <button class="btn add-to-cart" data-id="{{ $item->product->id }}">
                                            Add to Cart
                                        </button>

                                        <!-- REMOVE -->
                                        <form method="POST" action="{{ route('wishlist.remove') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                            <button class="btn-outline">Remove</button>
                                        </form>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>
            </div>


            <!-- ADDRESS -->
            <div id="address" class="section">
                <div class="card">
                    <div class="address-header">
                        <h3>Address Book</h3>
                        <button class="btn" onclick="openAddressModal()">+ Add Address</button>
                    </div>

                    <div class="address-grid">

                        @forelse($addresses as $address)

                            <div class="address-card {{ $address->is_default ? 'active' : '' }}">

                                @if($address->is_default)
                                    <span class="badge-default">Default</span>
                                @endif

                                <h4>{{ $address->label ?? 'Address' }}</h4>

                                <p>{{ $address->first_name }} {{ $address->last_name }}</p>

                                <p>
                                    {{ $address->address }},
                                    {{ $address->city->name ?? '' }},
                                    {{ $address->state->name ?? '' }} -
                                    {{ $address->pincode }}
                                </p>

                                <p>{{ $address->phone }}</p>

                                <div class="address-actions">

                                    @if(!$address->is_default)
                                        <form method="POST" action="{{ route('address.default', $address->id) }}">
                                            @csrf
                                            <button class="btn-outline">Set Default</button>
                                        </form>
                                    @endif

                                    <button class="btn-outline" onclick='editAddress(@json($address))'>
                                        Edit
                                    </button>
                                    <form method="POST" action="{{ route('address.delete', $address->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-outline">Remove</button>
                                    </form>

                                </div>
                            </div>

                        @empty
                            <p>No addresses found</p>
                        @endforelse

                    </div>
                </div>
            </div>

            <div class="modal" id="addressModal">
                <div class="modal-content large">

                    <h3 id="addressModalTitle">Add New Address</h3>

                    <form method="POST" action="{{ route('address.store') }}" id="addressForm">
                        @csrf
                        <input type="hidden" name="id" id="address_id">

                        <!-- NAME -->
                        <div class="grid-2">
                            <input name="first_name" placeholder="First Name" required>
                            <input name="last_name" placeholder="Last Name">
                        </div>

                        <!-- CONTACT -->
                        <div class="grid-2">
                            <input name="phone" placeholder="Mobile Number" required>
                            <input name="email" placeholder="Email">
                        </div>

                        <!-- ADDRESS -->
                        <textarea name="address" placeholder="Full Address" rows="3" required></textarea>

                        <!-- STATE + CITY -->
                        <div class="grid-2"> <select name="state" id="addr_state" required>
                                <option value="">Select State
                                </option>
                                @foreach(\App\Models\State::all() as $state)
                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                @endforeach
                            </select>

                            <select name="city" id="addr_city" required>
                                <option value="">Select City</option>
                            </select>
                        </div>

                        <!-- PINCODE -->
                        <input name="pincode" placeholder="Pincode" required>

                        <br><br>

                        <div class="modal-actions">
                            <button class="btn">Save Address</button>
                            <button type="button" onclick="closeAddressModal()">Cancel</button>
                        </div>

                    </form>

                </div>
            </div>


            <!-- REVIEWS -->
            <div id="reviews" class="section">
                <div class="card">

                    <div class="review-header">
                        <h3>Feedback & Reviews</h3>
                    </div>

                    <!-- REVIEW LIST -->
                    <div class="review-list">

                        @forelse($reviews as $review)

                            <div class="review-card">

                                <!-- TOP -->
                                <div class="review-top">
                                    <strong>{{ $review->user->name }}</strong>
                                    <span class="review-date">
                                        {{ $review->created_at->format('d M Y') }}
                                    </span>
                                </div>

                                <!-- PRODUCT NAME -->
                                <p style="font-size:13px; color:#888;">
                                    Product: {{ $review->product->name ?? 'N/A' }}
                                </p>

                                <!-- STARS -->
                                <div class="review-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        {{ $i <= $review->rating ? '★' : '☆' }}
                                    @endfor
                                </div>

                                <!-- TEXT -->
                                <p class="review-text">
                                    {{ $review->review }}
                                </p>

                            </div>

                        @empty

                            <div class="wishlist-empty">
                                <p>No reviews yet</p>
                            </div>

                        @endforelse

                    </div>

                </div>
            </div>


        </div>
    </div>

    <!-- MODAL -->
    <div class="modal" id="reviewModal">
        <div class="modal-content">

            <h4 id="reviewProductName">Rate Product</h4>

            <form method="POST" action="{{ route('review.store') }}">
                @csrf

                <input type="hidden" name="product_id" id="review_product_id">
                <input type="hidden" name="rating" id="rating_input">

                <!-- STARS -->
                <div class="stars">
                    <i onclick="rate(1)">★</i>
                    <i onclick="rate(2)">★</i>
                    <i onclick="rate(3)">★</i>
                    <i onclick="rate(4)">★</i>
                    <i onclick="rate(5)">★</i>
                </div>

                <!-- TEXT -->
                <textarea name="review" placeholder="Write review..." style="margin-top:10px;"></textarea>

                <br><br>
                <button class="btn">Submit</button>
                <button type="button" onclick="closeModal()">Close</button>

            </form>

        </div>
    </div>

    <script>

        window.addEventListener('load', function () {

            let hash = window.location.hash.replace('#', '');

            if (hash) {
                showSection(hash);

                // also highlight sidebar
                document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));

                let target = document.querySelector(`.sidebar a[onclick="showSection('${hash}')"]`);
                if (target) target.classList.add('active');
            }
        });

        function showSection(id) {
            document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
            document.getElementById(id).classList.add('active');

            document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
            event.target.classList.add('active');
        }

        function openReviewModal(productId, productName) {

            document.getElementById('reviewModal').style.display = 'flex';

            document.getElementById('review_product_id').value = productId;

            document.getElementById('reviewProductName').innerText =
                'Review: ' + productName;
        }


        function rate(num) {
            let stars = document.querySelectorAll('#reviewModal .stars i');

            stars.forEach((s, i) => {
                s.classList.toggle('active', i < num);
            });

            document.getElementById('rating_input').value = num;
        }

        function closeModal() {
            document.getElementById('reviewModal').style.display = 'none';
        }



        function openAddressModal() {

            document.getElementById('addressModal').style.display = 'flex';

            // reset form
            document.getElementById('addressForm').reset();

            document.getElementById('addressModalTitle').innerText = 'Add New Address';

            document.getElementById('addressForm').action = "{{ route('address.store') }}";
        }

        function closeAddressModal() {
            document.getElementById('addressModal').style.display = 'none';
        }


        document.getElementById('state').addEventListener('change', function () {

            let stateId = this.value;

            fetch('/get-cities/' + stateId)
                .then(res => res.json())
                .then(data => {

                    let cityDropdown = document.getElementById('city');
                    cityDropdown.innerHTML = '<option value="">Select City</option>';

                    data.forEach(city => {
                        cityDropdown.innerHTML +=
                            `<option value="${city.id}">${city.name}</option>`;
                    });

                });
        });

        // preload city
        window.addEventListener('load', function () {

            let stateId = "{{ $user->state_id }}";
            let selectedCity = "{{ $user->city_id }}";

            if (stateId) {
                fetch('/get-cities/' + stateId)
                    .then(res => res.json())
                    .then(data => {

                        let cityDropdown = document.getElementById('city');

                        data.forEach(city => {
                            let selected = city.id == selectedCity ? 'selected' : '';
                            cityDropdown.innerHTML +=
                                `<option value="${city.id}" ${selected}>${city.name}</option>`;
                        });

                    });
            }
        });

        function showOrderDetail(order) {

            // switch section
            document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
            document.getElementById('orderDetail').classList.add('active');

            // fill basic data
            document.getElementById('od-invoice').innerText = order.invoice_no ?? 'N/A';
            document.getElementById('od-order-id').innerText = '#' + order.order_id;
            document.getElementById('od-date').innerText = new Date(order.created_at).toLocaleDateString();
            document.getElementById('od-status').innerText = order.status;
            document.getElementById('od-payment').innerText = order.payment_status ?? 'Pending';

            // address
            if (order.address) {
                document.getElementById('od-name').innerText = order.address.name ?? '';
                document.getElementById('od-address').innerText = order.address.address ?? '';
                document.getElementById('od-phone').innerText = order.address.phone ?? '';
                document.getElementById('od-email').innerText = order.address.email ?? '';
            }

            // items
            let itemsHtml = '';
            if (order.items) {
                order.items.forEach(item => {
                    itemsHtml += `
                                                                            <tr>
                                                                                <td>${item.product_name}</td>
                                                                                <td>${item.quantity}</td>
                                                                                <td>₹${item.price}</td>
                                                                                <td>₹${item.total}</td>
                                                                            </tr>
                                                                        `;
                });
            }
            document.getElementById('od-items').innerHTML = itemsHtml;

            // pricing
            document.getElementById('od-subtotal').innerText = '₹' + (order.subtotal ?? 0);
            document.getElementById('od-discount').innerText = '-₹' + (order.discount ?? 0);
            document.getElementById('od-shipping').innerText = '₹' + (order.shipping ?? 0);

            let gst = (parseFloat(order.cgst_amount || 0) +
                parseFloat(order.sgst_amount || 0) +
                parseFloat(order.igst_amount || 0));

            document.getElementById('od-gst').innerText = '₹' + gst;
            document.getElementById('od-total').innerText = '₹' + (order.total_amount ?? 0);
        }


        document.getElementById('addr_state').addEventListener('change', function () {

            let stateId = this.value;

            fetch('/get-cities/' + stateId)
                .then(res => res.json())
                .then(data => {

                    let cityDropdown = document.getElementById('addr_city');
                    cityDropdown.innerHTML = '<option value="">Select City</option>';

                    data.forEach(city => {
                        cityDropdown.innerHTML +=
                            `<option value="${city.id}">${city.name}</option>`;
                    });

                });
        });


        function editAddress(address) {

            // open modal
            document.getElementById('addressModal').style.display = 'flex';

            // title
            document.getElementById('addressModalTitle').innerText = 'Edit Address';

            // form action
            document.getElementById('addressForm').action = '/address/update/' + address.id;

            // target ONLY modal form
            let form = document.getElementById('addressForm');

            // fill fields safely
            form.querySelector('[name="first_name"]').value = address.first_name || '';
            form.querySelector('[name="last_name"]').value = address.last_name || '';
            form.querySelector('[name="phone"]').value = address.phone || '';
            form.querySelector('[name="email"]').value = address.email || '';
            form.querySelector('[name="address"]').value = address.address || '';
            form.querySelector('[name="pincode"]').value = address.pincode || '';

            // set state (important delay)
            let stateDropdown = document.getElementById('addr_state');
            stateDropdown.value = address.state_id;

            // load cities AFTER state set
            fetch('/get-cities/' + address.state_id)
                .then(res => res.json())
                .then(data => {

                    let cityDropdown = document.getElementById('addr_city');
                    cityDropdown.innerHTML = '<option value="">Select City</option>';

                    data.forEach(city => {
                        let selected = (city.id == address.city_id) ? 'selected' : '';
                        cityDropdown.innerHTML +=
                            `<option value="${city.id}" ${selected}>${city.name}</option>`;
                    });

                });
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
@endsection