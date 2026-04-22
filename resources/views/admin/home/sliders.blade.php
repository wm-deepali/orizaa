@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        {{-- Breadcrumb --}}
        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home-page.index') }}">Manage Home Page</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Home Sliders
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            {{-- ================= ADD FORM ================= --}}
            <div class="card mb-4">
                <div class="card-body">

                    <h5 class="mb-3">Add New Slider</h5>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.home.sliders.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>Link</label>
                                <input type="text" name="link" value="{{ old('link') }}" class="form-control"
                                    placeholder="https://example.com">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus"></i> Add Slider
                        </button>

                    </form>

                </div>
            </div>

            {{-- ================= TABLE ================= --}}
            <div class="card">
                <div class="card-body">

                    <h5 class="mb-3">Slider List</h5>

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th width="80">ID</th>
                                    <th>Image</th>
                                    <th>Link</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($sliders as $slider)

                                                            <tr id="row{{ $slider->id }}">

                                                                <td>{{ $slider->id }}</td>

                                                                <td>
                                                                    <img src="{{ asset('storage/' . $slider->image) }}" width="80"
                                                                        class="border rounded">
                                                                </td>

                                                                <td>
                                                                    @if($slider->link)
                                                                        <a href="{{ $slider->link }}" target="_blank">
                                                                            View
                                                                        </a>
                                                                    @endif
                                                                </td>

                                                                <td>
                                                                    <button class="btn btn-sm btn-outline-primary" onclick="openEditModal(
                                        {{ $slider->id }},
                                        '{{ $slider->link }}',
                                        '{{ asset('storage/' . $slider->image) }}'
                                    )">
                                                                        <i class="fa fa-edit"></i>
                                                                    </button>

                                                                    <button class="btn btn-sm btn-outline-danger"
                                                                        onclick="deleteBanner({{ $slider->id }})">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>

                                                            </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No Sliders Found
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

<!-- EDIT MODAL -->
<div class="modal fade" id="editBannerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="editBannerForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5>Edit Slider</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="banner_id">

                    <div class="mb-3">
                        <label>Link</label>
                        <input type="text" name="link" id="edit_link" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Current Image</label><br>
                        <img id="edit_preview" width="120" class="border rounded">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>

@include('admin.footer')

{{-- DELETE SCRIPT --}}
<script>
function openEditModal(id, link, image) {

    $('#banner_id').val(id);
    $('#edit_link').val(link);
    $('#edit_preview').attr('src', image);

    // dynamic form action
    $('#editBannerForm').attr('action', '/admin/home-sliders/' + id);

    $('#editBannerModal').modal('show');
}
</script>
<script>
    function deleteBanner(id) {
        Swal.fire({
            title: 'Delete Slider?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('admin/home-sliders') }}/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (res) {

                        Swal.fire('Deleted!', 'Slider removed successfully', 'success');

                        $("#row" + id).fadeOut(400, function () {
                            $(this).remove();
                        });

                    }
                });

            }

        });
    }
</script>