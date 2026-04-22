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
                        Why Choose Us
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            {{-- ================= SECTION FORM ================= --}}
            <div class="card mb-4">
                <div class="card-body">

                    <h5 class="mb-3">Section Content</h5>

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

                    <form method="POST" action="{{ route('admin.home.why.update') }}">
                        @csrf

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Heading</label>
                                <input type="text" name="heading" value="{{ old('heading', $why->heading ?? '') }}"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Sub Heading</label>
                                <input type="text" name="sub_heading"
                                    value="{{ old('sub_heading', $why->sub_heading ?? '') }}" class="form-control"
                                    required>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update Section
                        </button>

                    </form>

                </div>
            </div>

            {{-- ================= ADD CARD ================= --}}
            <div class="card mb-4">
                <div class="card-body">

                    <h5 class="mb-3">Add New Card</h5>

                    <form method="POST" action="{{ route('admin.home.why.card.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row">

                            <div class="col-md-4 mb-3">
                                <label>Title</label>
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control"
                                    required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Icon</label>
                                <input type="file" name="icon" class="form-control" required>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Content</label>
                                <input type="text" name="content" value="{{ old('content') }}" class="form-control">
                            </div>

                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-plus"></i> Add Card
                        </button>

                    </form>

                </div>
            </div>

            {{-- ================= CARDS TABLE ================= --}}
            <div class="card">
                <div class="card-body">

                    <h5 class="mb-3">Cards List</h5>

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th width="80">ID</th>
                                    <th>Icon</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($cards as $card)

                                    <tr id="row{{ $card->id }}">

                                        <td>{{ $card->id }}</td>

                                        <td>
                                            @if($card->icon)
                                                <img src="{{ asset('storage/' . $card->icon) }}" width="40">
                                            @endif
                                        </td>

                                        <td>{{ $card->title }}</td>

                                        <td>{{ $card->content }}</td>

                                        <td>

                                            {{-- EDIT --}}
                                            <button class="btn btn-sm btn-outline-primary"
                                                onclick="editCard({{ $card->id }})">
                                                <i class="fa fa-pencil"></i>
                                            </button>

                                            {{-- DELETE --}}
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteCard({{ $card->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No Cards Found
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
<div class="modal fade" id="editCardModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editCardForm" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Edit Card</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" id="editTitle" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Content</label>
                        <input type="text" name="content" id="editContent" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Icon</label>
                        <input type="file" name="icon" class="form-control">
                        <small class="text-muted">Leave empty to keep existing icon</small>
                    </div>

                    <div class="form-group mt-2">
                        <label>Current Icon</label>
                        <div id="currentIconPreview"></div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </div>

        </form>
    </div>
</div>

@include('admin.footer')

{{-- DELETE SCRIPT --}}
<script>

    function editCard(id) {

        $.get("{{ url('admin/home-why/card') }}/" + id, function (data) {

            $('#editTitle').val(data.title);
            $('#editContent').val(data.content);

            // ✅ SET FORM ACTION
            $('#editCardForm').attr('action', "/admin/home-why/card/" + id);

            // ✅ SHOW CURRENT ICON
            if (data.icon) {
                $('#currentIconPreview').html(
                    `<img src="/storage/${data.icon}" width="50" class="border rounded">`
                );
            } else {
                $('#currentIconPreview').html('<span class="text-muted">No icon</span>');
            }

            $('#editCardModal').modal('show');
        });
    }

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
                    url: "{{ url('admin/home-why/card') }}/" + id,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (res) {

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