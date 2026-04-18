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

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.gifting-occasions.index') }}">Gifting Occasions</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit Occasion
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Occasion</strong>
                </div>

                <div class="card-body">

                    <form method="POST"
                          action="{{ route('admin.gifting-occasions.update', $occasion->id) }}"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Title *</label>
                            <input type="text" name="title" id="title"
                                   value="{{ $occasion->title }}"
                                   class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label>Slug</label>
                            <input type="text" name="slug" id="slug"
                                   value="{{ $occasion->slug }}"
                                   class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>Sub Title</label>
                            <input type="text" name="sub_title"
                                   value="{{ $occasion->sub_title }}"
                                   class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>Short Description</label>
                            <textarea name="short_description"
                                      class="form-control">{{ $occasion->short_description }}</textarea>
                        </div>

                        <div class="form-group mt-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">

                            @if($occasion->image)
                                <img src="{{ asset('storage/'.$occasion->image) }}"
                                     width="80" class="mt-2">
                            @endif
                        </div>

                        <div class="form-group mt-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title"
                                   value="{{ $occasion->meta_title }}"
                                   class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description"
                                      class="form-control">{{ $occasion->meta_description }}</textarea>
                        </div>

                       <!-- Status -->
                        <div class="form-group mt-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ $occasion->status ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$occasion->status ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mt-4">

                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Update Occasion
                            </button>

                            <a href="{{ route('admin.gifting-occasions.index') }}"
                               class="btn btn-secondary">
                                Cancel
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>
// slug auto
document.getElementById('title').addEventListener('keyup', function () {

    let slug = this.value
        .toLowerCase()
        .replace(/ /g, '-')
        .replace(/[^\w-]+/g, '');

    document.getElementById('slug').value = slug;

});

</script>