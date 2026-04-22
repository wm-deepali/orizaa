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
                        <a href="{{ route('admin.enquiries.index') }}">Enquiries</a>
                    </li>

                    <li class="breadcrumb-item active">
                        View Enquiry
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="row">

                <!-- LEFT: CUSTOMER DETAILS -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="mb-3">Customer Details</h4>

                            <p><strong>Business:</strong> {{ $enquiry->business_name }}</p>
                            <p><strong>Owner:</strong> {{ $enquiry->owner_name }}</p>
                            <p><strong>Email:</strong> {{ $enquiry->email }}</p>
                            <p><strong>Mobile:</strong> {{ $enquiry->mobile }}</p>
                            <p><strong>Address:</strong> {{ $enquiry->address }}</p>
                            <p><strong>State:</strong> {{ $enquiry->state->name ?? '-' }}</p>
                            <p><strong>City:</strong> {{ $enquiry->city->name ?? '-' }}</p>
                            <p><strong>Date:</strong> {{ $enquiry->created_at->format('d M Y h:i A') }}</p>

                        </div>
                    </div>
                </div>

                <!-- RIGHT: PRODUCTS -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="mb-3">Enquiry Products</h4>

                            <div class="table-responsive">

                                <table class="table table-bordered">

                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach($enquiry->items as $item)

                                            <tr>
                                                <td>{{ $item->product->name ?? '-' }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>₹{{ $item->price }}</td>
                                                <td>₹{{ $item->total }}</td>
                                            </tr>

                                        @endforeach

                                    </tbody>
                                    <tfoot class="table-light">

                                        <tr>
                                            <td colspan="2" class="fw-semibold">
                                                Total Qty: {{ $enquiry->items->sum('quantity') }}
                                            </td>

                                            <td class="text-end fw-bold">
                                                Grand Total
                                            </td>

                                            <td class="text-end fw-bold text-success">
                                                ₹{{ number_format($enquiry->items->sum('total')) }}
                                            </td>
                                        </tr>

                                    </tfoot>
                                </table>

                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')