@extends('layouts.app')

@section('content')

<style>
.success-container {
    max-width: 900px;
    margin: 60px auto;
    padding: 30px;
}

.success-card {
    background: #fff;
    border-radius: 12px;
    padding: 30px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    text-align: center;
}

.success-icon {
    font-size: 60px;
    margin-bottom: 15px;
}

.success-title {
    font-size: 26px;
    font-weight: bold;
    margin-bottom: 10px;
}

.success-subtitle {
    color: #666;
    margin-bottom: 25px;
}

.order-box {
    text-align: left;
    margin-top: 25px;
    border-top: 1px solid #eee;
    padding-top: 20px;
}

.order-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 14px;
}

.order-row strong {
    color: #333;
}

.badge-success {
    color: #28a745;
    font-weight: bold;
}

.badge-pending {
    color: #f39c12;
    font-weight: bold;
}

.action-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 20px;
    background: linear-gradient(135deg, #c9a55c, #f4d03f);
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
}
</style>

<div class="success-container">

    <div class="success-card">

        {{-- ✅ STATUS ICON --}}
        @if($order->status == 'paid')
            <div class="success-icon">✅</div>
            <div class="success-title">Payment Successful</div>
        @else
            <div class="success-icon">⏳</div>
            <div class="success-title">Payment Pending</div>
        @endif

        <div class="success-subtitle">
            Thank you for your order. Below are your order details.
        </div>

        {{-- ✅ ORDER DETAILS --}}
        <div class="order-box">

            <div class="order-row">
                <span>Order ID</span>
                <strong>{{ $order->order_id }}</strong>
            </div>

            <div class="order-row">
                <span>Amount</span>
                <strong>₹{{ number_format($order->amount, 2) }}</strong>
            </div>

            <div class="order-row">
                <span>Status</span>
                <strong class="{{ $order->status == 'paid' ? 'badge-success' : 'badge-pending' }}">
                    {{ ucfirst($order->status) }}
                </strong>
            </div>

            <div class="order-row">
                <span>Date</span>
                <strong>{{ $order->created_at->format('d M Y, h:i A') }}</strong>
            </div>

        </div>

        {{-- ✅ ADDRESS --}}
        @if($order->address)
        <div class="order-box">
            <h4>Billing Address</h4>

            <div class="order-row">
                <span>Name</span>
                <strong>{{ $order->address->first_name }} {{ $order->address->last_name }}</strong>
            </div>

            <div class="order-row">
                <span>Email</span>
                <strong>{{ $order->address->email }}</strong>
            </div>

            <div class="order-row">
                <span>Phone</span>
                <strong>{{ $order->address->phone }}</strong>
            </div>

            <div class="order-row">
                <span>Address</span>
                <strong>
                    {{ $order->address->address }},
                    {{ $order->address->city->name ?? '' }},
                    {{ $order->address->state->name ?? '' }} - 
                    {{ $order->address->pincode }}
                </strong>
            </div>
        </div>
        @endif

        {{-- ✅ ACTIONS --}}
        <a href="{{ route('user-dashboard') }}" class="action-btn">
            Go to Dashboard
        </a>

        <a href="{{ route('shopping-cart') }}" class="action-btn" style="background:#333;">
            Continue Shopping
        </a>

    </div>

</div>

@endsection