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
                        Customers
                    </li>
                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th width="60">ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th width="140">Phone</th>
                                    <th width="100">Orders</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($customers as $customer)

                                    <tr id="row{{ $customer->id }}">

                                        <td>{{ $customer->id }}</td>

                                        <td>
                                            <strong>{{ $customer->name }}</strong>
                                        </td>

                                        <td>{{ $customer->email }}</td>

                                        <td>{{ $customer->phone }}</td>

                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $customer->orders()->count() }}
                                            </span>
                                        </td>

                                        <td>

                                            <a href="{{ route('admin.customers.show', $customer->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            No Customers Found
                                        </td>
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