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
                    Category Video Section
                </li>

            </ol>
        </div>
    </div>

    <div class="content-wrapper pb-4">

        {{-- ================= ADD FORM ================= --}}
        <div class="card mb-4">
            <div class="card-body">

                <h5 class="mb-3">Add New Video Card</h5>

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

                <form method="POST" action="{{ route('admin.home.category-videos.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <div class="col-md-3 mb-3">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Link (optional)</label>
                            <input type="text" name="link" class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Order</label>
                            <input type="number" name="order" class="form-control">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label>Video</label>
                            <input type="file" name="video" class="form-control" required>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-plus"></i> Add Video
                    </button>

                </form>

            </div>
        </div>

        {{-- ================= TABLE ================= --}}
        <div class="card">
            <div class="card-body">

                <h5 class="mb-3">Video List</h5>

                <div class="table-responsive">

                    <table class="table table-striped table-hover">

                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Video</th>
                                <th>Title</th>
                                <th>Link</th>
                                <th>Order</th>
                                <th width="120">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($videos as $video)

                                <tr id="row{{ $video->id }}">

                                    <td>{{ $video->id }}</td>

                                    <td>
                                        <video width="100" height="70" controls>
                                            <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                                        </video>
                                    </td>

                                    <td>{{ $video->title }}</td>

                                    <td>
                                        @if($video->link)
                                            <a href="{{ $video->link }}" target="_blank">View</a>
                                        @endif
                                    </td>

                                    <td>{{ $video->order }}</td>

                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"
                                            onclick="openEditModal(
                                                {{ $video->id }},
                                                '{{ $video->title }}',
                                                '{{ $video->link }}',
                                                '{{ $video->order }}',
                                                '{{ asset('storage/'.$video->video) }}'
                                            )">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <button class="btn btn-sm btn-outline-danger"
                                            onclick="deleteVideo({{ $video->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        No Videos Found
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

{{-- ================= EDIT MODAL ================= --}}
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5>Edit Video</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" id="edit_title" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Link</label>
                        <input type="text" name="link" id="edit_link" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Order</label>
                        <input type="number" name="order" id="edit_order" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Video</label>
                        <input type="file" name="video" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Current Video</label><br>
                        <video id="edit_preview" width="150" controls></video>
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

{{-- ================= SCRIPTS ================= --}}
<script>
function openEditModal(id, title, link, order, video) {

    $('#edit_title').val(title);
    $('#edit_link').val(link);
    $('#edit_order').val(order);
    $('#edit_preview').attr('src', video);

    $('#editForm').attr('action', '/admin/home-category-videos/' + id);

    $('#editModal').modal('show');
}

function deleteVideo(id) {

    Swal.fire({
        title: 'Delete Video?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "{{ url('admin/home-category-videos') }}/" + id,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function () {

                    Swal.fire('Deleted!', 'Video removed successfully', 'success');

                    $("#row" + id).fadeOut(400, function () {
                        $(this).remove();
                    });

                }
            });

        }

    });
}
</script>