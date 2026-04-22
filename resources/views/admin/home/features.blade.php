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
                        Feature Cards Section
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            {{-- ================= ADD FORM ================= --}}
            <div class="card mb-4">
                <div class="card-body">

                    <h5 class="mb-3">Add New Feature Card</h5>

                    {{-- SUCCESS --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- ERRORS --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.home.features.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            {{-- TITLE --}}
                            <div class="col-md-4 mb-3">
                                <label>Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                    required>
                            </div>

                            {{-- SUB TITLE --}}
                            <div class="col-md-4 mb-3">
                                <label>Sub Title</label>
                                <input type="text" name="sub_title" value="{{ old('sub_title') }}" class="form-control">
                            </div>

                            {{-- BUTTON TEXT --}}
                            <div class="col-md-4 mb-3">
                                <label>Button Text</label>
                                <input type="text" name="button_text" value="{{ old('button_text') }}"
                                    class="form-control">
                            </div>

                            {{-- LINK --}}
                            <div class="col-md-6 mb-3">
                                <label>Link</label>
                                <input type="text" name="link" value="{{ old('link') }}" class="form-control"
                                    placeholder="https://example.com">
                            </div>

                            {{-- IMAGE --}}
                            <div class="col-md-6 mb-3">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus"></i> Add Card
                        </button>

                    </form>

                </div>
            </div>

            {{-- ================= TABLE ================= --}}
            <div class="card">
                <div class="card-body">

                    <h5 class="mb-3">Feature Cards List</h5>

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th width="80">ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Sub Title</th>
                                    <th>Button</th>
                                    <th>Link</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($cards as $card)

                                    <tr id="row{{ $card->id }}">

                                        <td>{{ $card->id }}</td>

                                        <td>
                                            @if($card->image)
                                                <img src="{{ asset('storage/' . $card->image) }}" width="70"
                                                    class="border rounded">
                                            @endif
                                        </td>

                                        <td>{{ $card->title }}</td>

                                        <td>{{ $card->sub_title }}</td>

                                        <td>{{ $card->button_text }}</td>

                                        <td>
                                            @if($card->link)
                                                <a href="{{ $card->link }}" target="_blank">View</a>
                                            @endif
                                        </td>


                                        <td>

                                            <button class="btn btn-sm btn-outline-primary" onclick="openEditCardModal(
                                            {{ $card->id }},
                                            '{{ $card->title }}',
                                            '{{ $card->sub_title }}',
                                            '{{ $card->button_text }}',
                                            '{{ $card->link }}',
                                            '{{ asset('storage/' . $card->image) }}'
                                        )">
                                                <i class="fa fa-edit"></i>
                                            </button>

                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteCard({{ $card->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>


                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            No Feature Cards Found
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

<!-- EDIT CARD MODAL -->
<div class="modal fade" id="editCardModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="editCardForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5>Edit Feature Card</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_id">

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Sub Title</label>
                        <input type="text" name="sub_title" id="edit_sub_title" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Button Text</label>
                        <input type="text" name="button_text" id="edit_button_text" class="form-control">
                    </div>

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
                        <img id="edit_image_preview" width="100" class="border rounded">
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
    function openEditCardModal(id, title, sub_title, button_text, link, image) {

        $('#edit_id').val(id);
        $('#edit_title').val(title);
        $('#edit_sub_title').val(sub_title);
        $('#edit_button_text').val(button_text);
        $('#edit_link').val(link);
        $('#edit_image_preview').attr('src', image);

        $('#editCardForm').attr('action', '/admin/home-features/' + id);

        $('#editCardModal').modal('show');
    }

    $('input[name="image"]').on('change', function (e) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#edit_image_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    function deleteCard(id) {
        Swal.fire({
            title: 'Delete Card?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('admin/home-features') }}/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function () {

                        Swal.fire('Deleted!', 'Card removed successfully', 'success');

                        $("#row" + id).fadeOut(400, function () {
                            $(this).remove();
                        });

                    }
                });

            }

        });
    }
</script>