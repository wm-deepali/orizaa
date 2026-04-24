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
                        Products
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Product
                </a>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <!-- SEARCH (optional but useful) -->
                    <form method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Search Product...">
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th width="60">ID</th>
                                    <th width="80">Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th width="120">Price</th>
                                    <th width="120">Status</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($products as $item)

                                    <tr id="row{{ $item->id }}">

                                        <td>{{ $item->id }}</td>

                                        <td>

                                            @if($item->display_image)
                                                <img src="{{ asset('storage/' . $item->display_image) }}" width="60" height="60"
                                                    style="object-fit:cover;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>

                                        <td>
                                            <strong>{{ $item->name }}</strong><br>
                                            <small class="text-muted">{{ $item->slug }}</small>
                                        </td>

                                        <td>
                                            <small>
                                                {{ $item->category_names ?? '-' }} <br>
                                                <span class="text-muted">
                                                    {{ $item->subcategory_names ?? '' }}
                                                </span>
                                            </small>
                                        </td>

                                        <td>
                                            ₹ {{ number_format($item->price, 2) }}
                                        </td>

                                        <td>
                                            @if($item->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>

                                            <!-- EDIT -->
                                            <a href="{{ route('admin.products.edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <!-- DELETE -->
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteItem({{ $item->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            No Products Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                        <!-- PAGINATION -->
                        <div class="mt-3">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>
    function deleteItem(id) {
        Swal.fire({
            title: 'Delete Product?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('admin/products') }}/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
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