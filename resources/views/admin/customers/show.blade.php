@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <!-- Breadcrumb -->
        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.customers.index') }}">Customers</a>
                    </li>
                    <li class="breadcrumb-item active">
                        {{ $customer->name }}
                    </li>
                </ol>
            </div>
        </div>

        <div class="content-wrapper pb-4">

            <!-- CUSTOMER INFO -->
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $customer->name }}</h5>
                    <p>Email: {{ $customer->email }}</p>
                    <p>Phone: {{ $customer->phone }}</p>
                </div>
            </div>

            <!-- TABS -->
            <div style="display:flex; gap:20px;">

                <!-- SIDEBAR -->
                <div class="sidebar" style="width:200px; background:#fff; padding:15px; border-radius:8px;">
                    <a onclick="showSection('orders')" class="active">Orders</a>
                    <a onclick="showSection('reviews')">Reviews</a>
                </div>

                <!-- CONTENT -->
                <div style="flex:1;">

                    <!-- ================= ORDERS ================= -->
                    <div id="orders" class="section active">

                        <div class="card">
                            <div class="card-body">

                                <h5>Orders</h5>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">

                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Payment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @forelse($orders as $order)

                                                <!-- MAIN ROW -->
                                                <tr>
                                                    <td>#{{ $order->order_id ?? $order->id }}</td>
                                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                                    <td><strong>₹{{ number_format($order->total_amount, 2) }}</strong></td>

                                                    <td>
                                                        <span
                                                            class="badge badge-{{ $order->status == 'paid' ? 'success' : 'warning' }}">
                                                            {{ ucfirst($order->status) }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : 'secondary' }}">
                                                            {{ ucfirst($order->payment_status ?? 'pending') }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                                            class="btn btn-sm btn-outline-primary">
                                                            View
                                                        </a>
                                                    </td>
                                                </tr>


                                            @empty

                                                <tr>
                                                    <td colspan="6" class="text-center">No Orders Found</td>
                                                </tr>

                                            @endforelse

                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- ================= REVIEWS ================= -->
                    <div id="reviews" class="section">

                        <div class="card">
                            <div class="card-body">

                                <h5>Reviews</h5>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">

                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Rating</th>
                                                <th>Review</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            @forelse($reviews as $r)

                                                <tr>
                                                    <td>{{ $r->product->name ?? '' }}</td>

                                                    <td style="color:#f4d03f;">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            {{ $i <= $r->rating ? '★' : '☆' }}
                                                        @endfor
                                                    </td>

                                                    <td>{{ $r->review }}</td>

                                                    <td>{{ $r->created_at->format('d M Y') }}</td>
                                                </tr>

                                            @empty

                                                <tr>
                                                    <td colspan="4" class="text-center">No Reviews</td>
                                                </tr>

                                            @endforelse

                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')


<!-- JS -->
<script>
    function showSection(id) {
        document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
        document.getElementById(id).classList.add('active');

        document.querySelectorAll('.sidebar a').forEach(a => a.classList.remove('active'));
        event.target.classList.add('active');
    }
</script>

<!-- CSS -->
<style>
    .section {
        display: none;
    }

    .section.active {
        display: block;
    }

    .sidebar a {
        display: block;
        padding: 10px;
        cursor: pointer;
        border-radius: 6px;
        margin-bottom: 5px;
        color: #333;
        text-decoration: none;
    }

    .sidebar a.active,
    .sidebar a:hover {
        background: #007bff;
        color: #fff;
    }
</style>