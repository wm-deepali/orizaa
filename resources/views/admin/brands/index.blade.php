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
                        Manage Brands
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Brand
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
                                    <th>Logo</th>
                                    <th>Brand Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($brands as $brand)
                                    <tr id="row{{ $brand->id }}">

                                        <td>{{ $brand->id }}</td>

                                        <td>
                                            @if($brand->logo)
                                                <img src="{{ asset('storage/'.$brand->logo) }}" width="60">
                                            @else
                                                <span class="text-muted">No Logo</span>
                                            @endif
                                        </td>

                                        <td>{{ $brand->name }}</td>

                                        <td>
                                            @if($brand->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>

                                              <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                                class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                             <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteBrand({{ $brand->id }})">

                                                <i class="fa fa-trash"></i>

                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            No Brands Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                        {{-- PAGINATION --}}
                        <div class="mt-3">
                            {{ $brands->links('pagination::bootstrap-4') }}
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>

    function deleteBrand(id) {
        Swal.fire({
            title: 'Delete Brand?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        })
            .then((result) => {

                if (result.isConfirmed) {

                    $.ajax({

                        url: "{{ url('admin/brands') }}/" + id,

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