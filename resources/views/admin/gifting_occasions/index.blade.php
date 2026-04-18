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
                        Gifting Occasions
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.gifting-occasions.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Occasion
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
                                    <th width="60">ID</th>
                                    <th width="120">Image</th>
                                    <th>Title</th>
                                    <th width="120">Status</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($occasions as $item)

                                    <tr id="row{{ $item->id }}">

                                        <td>{{ $item->id }}</td>

                                        <td>
                                            @if($item->image)
                                                <img src="{{ asset('storage/'.$item->image) }}" width="70">
                                            @endif
                                        </td>

                                        <td>
                                            <strong>{{ $item->title }}</strong>
                                        </td>

                                        <td>
                                            @if($item->status)
                                                <span class="badge badge-primary">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>

                                            <a href="{{ route('admin.gifting-occasions.edit', $item->id) }}"
                                               class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <button class="btn btn-sm btn-outline-danger"
                                                    onclick="deleteItem({{ $item->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No Data Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                         <div class="mt-3">
                            {{ $occasions->links('pagination::bootstrap-4') }}
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
        title: 'Delete Occasion?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "{{ url('admin/gifting-occasions') }}/" + id,
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