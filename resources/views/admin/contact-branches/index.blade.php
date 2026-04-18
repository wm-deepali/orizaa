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
                        Manage Contact Branches
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.contact-branches.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Branch
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
                                    <th>Icon</th>
                                    <th>Branch Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($branches as $branch)
                                    <tr id="row{{ $branch->id }}">

                                        <td>{{ $branch->id }}</td>

                                        <td>
                                            @if($branch->icon)
                                                <img src="{{ asset('storage/'.$branch->icon) }}" width="50">
                                            @else
                                                <span class="text-muted">No Icon</span>
                                            @endif
                                        </td>

                                        <td>
                                            <strong>{{ $branch->title }}</strong><br>
                                            <small class="text-muted">{{ $branch->subtitle }}</small>
                                        </td>

                                        <td>{{ $branch->phone ?? '-' }}</td>

                                        <td>{{ $branch->email ?? '-' }}</td>

                                        <td>
                                            @if($branch->status)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.contact-branches.edit', $branch->id) }}"
                                               class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            {{-- DELETE --}}
                                            <button class="btn btn-sm btn-outline-danger"
                                                    onclick="deleteBranch({{ $branch->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="7" class="text-center text-muted">
                                            No Branches Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                        {{-- PAGINATION --}}
                        <div class="mt-3">
                            {{ $branches->links('pagination::bootstrap-4') }}
                        </div>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>
function deleteBranch(id) {

    Swal.fire({
        title: 'Delete Branch?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete'
    })
    .then((result) => {

        if (result.isConfirmed) {

            $.ajax({

                url: "{{ url('admin/contact-branches') }}/" + id,
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