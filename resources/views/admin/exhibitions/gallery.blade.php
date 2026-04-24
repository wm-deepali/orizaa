@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        <!-- Breadcrumb -->
        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.exhibitions.index') }}">
                            Exhibitions
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Gallery
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <!-- Exhibition Info -->
            <div class="card mb-3">
                <div class="card-body d-flex align-items-center">

                    @if($exhibition->image)
                        <img src="{{ asset('storage/'.$exhibition->image) }}"
                             width="80" class="mr-3 rounded">
                    @endif

                    <div>
                        <h5 class="mb-1">{{ $exhibition->title }}</h5>
                        <small>{{ $exhibition->venue }}</small><br>
                        <small>{{ $exhibition->from_date }} - {{ $exhibition->to_date }}</small>
                    </div>

                </div>
            </div>

            <!-- Upload Form -->
            <div class="card mb-3">
                <div class="card-header">
                    <strong>Add Gallery Images</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('admin.exhibitions.gallery.store', $exhibition->id) }}"
                          enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <input type="file" name="images[]" multiple class="form-control" required>
                            <small class="text-muted">You can select multiple images</small>
                        </div>

                        <button class="btn btn-success">
                            <i class="fa fa-upload"></i> Upload
                        </button>

                    </form>

                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="card">
                <div class="card-header">
                    <strong>Gallery Images</strong>
                </div>

                <div class="card-body">

                    <div class="row">

                        @forelse($images as $img)

                            <div class="col-md-3 mb-3" id="img{{ $img->id }}">

                                <div class="border p-2 text-center position-relative">

                                    <img src="{{ asset('storage/'.$img->image) }}"
                                         class="img-fluid mb-2"
                                         style="height:150px; object-fit:cover;">

                                    <!-- Delete Button -->
                                    <button onclick="deleteImage({{ $img->id }})"
                                            class="btn btn-sm btn-danger position-absolute"
                                            style="top:5px; right:5px;">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                </div>

                            </div>

                        @empty

                            <div class="col-12 text-center text-muted">
                                No Images Found
                            </div>

                        @endforelse

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')


<script>
function deleteImage(id) {

    if(confirm('Delete this image?')){

        $.ajax({
            url: "{{ url('admin/exhibitions/gallery') }}/" + id,
            type: "DELETE",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(res){
                $("#img" + id).fadeOut(300, function(){
                    $(this).remove();
                });
            }
        });

    }
}
</script>