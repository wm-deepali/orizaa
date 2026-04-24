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
                    <li class="breadcrumb-item active">
                        Orders
                    </li>
                </ol>
            </div>
        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <h5>Orders</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">

                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
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

                                        <td>
                                            {{ $order->user->name ?? 'N/A' }}<br>
                                            <small>{{ $order->user->phone ?? '' }}</small>
                                        </td>

                                        <td>{{ $order->created_at->format('d M Y') }}</td>

                                        <td>
                                            <strong>₹{{ number_format($order->total_amount, 2) }}</strong>
                                        </td>

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
                                        <td colspan="7" class="text-center">No Orders Found</td>
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

@include('admin.footer')