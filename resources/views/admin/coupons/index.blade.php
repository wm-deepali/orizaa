@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Manage Coupons
                    </li>
                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Coupon
                </a>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Usage</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($coupons as $coupon)

                                    <tr id="row{{ $coupon->id }}">

                                        <td>{{ $coupon->id }}</td>

                                        <td><strong>{{ $coupon->code }}</strong></td>

                                        <td>{{ ucfirst($coupon->type) }}</td>

                                        <td>{{ $coupon->value }}</td>

                                        <td>
                                            {{ $coupon->used_count }} /
                                            {{ $coupon->usage_limit ?? '∞' }}
                                        </td>

                                        <td>
                                            @if($coupon->is_active)
                                                <span class="badge badge-primary">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>

                                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}"
                                                class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteCoupon({{ $coupon->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            No Coupons Found
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

<script>
function deleteCoupon(id) {
    Swal.fire({
        title: 'Delete Coupon?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "{{ url('admin/coupons') }}/" + id,
                type: "DELETE",
                data: { _token: "{{ csrf_token() }}" },

                success: function (res) {
                    Swal.fire('Deleted!', res.message, 'success');

                    $("#row" + id).fadeOut(400, function () {
                        $(this).remove();
                    });
                }
            });

        }

    });
}
</script>