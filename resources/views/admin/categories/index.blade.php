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
                        Manage Categories
                    </li>
                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Category
                </a>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">
                <div class="card-body">

                 <form method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="search" value="{{ request('search') }}"
                                       class="form-control" placeholder="Search Product...">
                            </div>

                            <div class="col-md-2">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-responsive">

                        <table class="table table-hover align-middle">

                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th>Popular</th>
                                    <th>Sort</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($categories as $cat)

                                                            <tr id="row{{ $cat->id }}">

                                                                <td>{{ $cat->id }}</td>

                                                                <td>
                                                                    @if($cat->image)
                                                                        <img src="{{ asset('storage/' . $cat->image) }}" width="60" height="60"
                                                                            class="rounded" style="object-fit:cover;">
                                                                    @else
                                                                        <span class="text-muted">—</span>
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    <strong>{{ $cat->name }}</strong><br>

                                                                    <small class="text-muted">
                                                                        Total Products: {{ $cat->unique_products_count }}
                                                                    </small>
                                                                </td>

                                                                <td>
                                                                    {{ $cat->parent->name ?? 'Parent' }}
                                                                </td>

                                                                <td>
                                                                    {!! $cat->is_popular
                                    ? '<span class="badge badge-success">Yes</span>'
                                    : '<span class="badge badge-light">No</span>' !!}
                                                                </td>

                                                                <td>{{ $cat->sort_order }}</td>

                                                                <td>
                                                                    {!! $cat->status
                                    ? '<span class="badge badge-primary">Active</span>'
                                    : '<span class="badge badge-danger">Inactive</span>' !!}
                                                                </td>

                                                                <td>
                                                                    <a href="{{ route('admin.categories.edit', $cat->id) }}"
                                                                        class="btn btn-sm btn-outline-dark">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>

                                                                    <button class="btn btn-sm btn-outline-danger"
                                                                        onclick="deleteCategory({{ $cat->id }})">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>

                                                            </tr>

                                @empty

                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <h6 class="text-muted">No Categories Found</h6>
                                            <a href="{{ route('admin.categories.create') }}"
                                                class="btn btn-primary btn-sm mt-2">
                                                Add Category
                                            </a>
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>
                        </table>

                    </div>

                    {{-- 🔥 PAGINATION --}}
                    <div class="mt-3 d-flex justify-content-center">
                       {{ $categories->links('pagination::bootstrap-4') }}
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<style>
    .table td {
        vertical-align: middle;
    }

    .badge {
        font-size: 11px;
        margin-right: 3px;
    }

    .pagination {
        justify-content: center;
    }
</style>

<script>
    function deleteCategory(id) {
        Swal.fire({
            title: 'Delete Category?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('admin/categories') }}/" + id,
                    type: "DELETE",
                    data: { _token: "{{ csrf_token() }}" },

                    beforeSend: function () {
                        Swal.showLoading();
                    },

                    success: function (res) {

                        Swal.fire('Deleted!', res.message, 'success');

                        $("#row" + id).fadeOut(300, function () {
                            $(this).remove();
                        });
                    },

                    error: function () {
                        Swal.fire('Error!', 'Something went wrong', 'error');
                    }
                });

            }
        });
    }
</script>