@include('admin.top-header')

<style>
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

    .od-action a {
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
</style>

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="content-wrapper pb-4">

            <div class="od-wrapper">
                <div class="od-card">

                    <!-- HEADER -->
                    <div class="od-header">
                        <div class="od-logo">
                            <img src="{{ asset('images/oriza-logo1.jpeg') }}">
                        </div>

                        <div class="od-title">
                            <h2>Order Details</h2>
                            <p><strong>Invoice No:</strong> {{ $order->invoice_no ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- TOP -->
                    <div class="od-top">

                        <!-- CUSTOMER -->
                        <div class="od-box">
                            <h4>{{ $order->user->name ?? '' }}</h4>
                            <p>{{ $order->address->address ?? '' }}</p>
                            <p>{{ $order->user->phone ?? '' }}</p>
                            <p>{{ $order->user->email ?? '' }}</p>
                        </div>

                        <!-- COMPANY -->
                        <div class="od-box od-right">
                            <h4>ORIZAA STYLE</h4>
                            <p>DELHI</p>
                            <p>GSTIN: 09ACQPF1162Q1Z2</p>
                        </div>

                    </div>

                    <!-- META -->
                    <div class="od-meta">
                        <p><strong>Order ID:</strong> #{{ $order->order_id }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                        <p>
                            <strong>Payment:</strong>
                            {{ ucfirst($order->payment_method ?? 'cashfree') }}
                            ({{ ucfirst($order->payment_status) }})
                        </p>
                    </div>

                    <!-- ITEMS -->
                    <table class="od-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₹{{ number_format($item->price, 2) }}</td>
                                    <td>₹{{ number_format($item->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- SUMMARY -->
                    <div class="od-summary">

                        <div class="od-row">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($order->subtotal, 2) }}</span>
                        </div>

                        @if($order->discount > 0)
                            <div class="od-row od-discount">
                                <span>Discount</span>
                                <span>-₹{{ number_format($order->discount, 2) }}</span>
                            </div>
                        @endif

                        <div class="od-row">
                            <span>GST</span>
                            <span>₹{{ number_format($order->gst_total, 2) }}</span>
                        </div>

                        <div class="od-row od-total">
                            <strong>Total</strong>
                            <span>₹{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>

                    <!-- ACTION -->
                    <div class="od-action">
                        <a href="{{ route('admin.order.pdf', $order->id) }}">View Invoice</a>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

@include('admin.footer')