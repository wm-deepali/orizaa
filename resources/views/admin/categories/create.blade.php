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
                        <a href="{{ route('admin.categories.index') }}">Manage Categories</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Add Category
                    </li>
                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">
                <div class="card-header">
                    <strong>Add Category</strong>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- BASIC --}}
                        <div class="card p-3 mb-3">
                            <h5><b>Basic Info</b></h5>

                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" required>

                            <label class="mt-2">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control">

                            <label class="mt-2">Sub Title</label>
                            <input type="text" name="sub_title" class="form-control">

                            <label class="mt-2">Parent Category</label>
                            <select name="parent_id" class="form-control">
                                <option value="">Parent Category</option>
                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>

                            <label class="mt-2">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" placeholder="0">

                        </div>

                        {{-- MEDIA --}}
                        <div class="card p-3 mb-3">
                            <h5><b>Media</b></h5>

                            <label>Image</label>
                            <input type="file" name="image" class="form-control">

                        </div>

                        {{-- SEO --}}
                        <div class="card p-3 mb-3">
                            <h5><b>SEO</b></h5>

                            <label>Meta Title</label>
                            <input type="text" name="meta_title" class="form-control">

                            <label class="mt-2">Meta Description</label>
                            <textarea name="meta_description" class="form-control"></textarea>

                        </div>

                        {{-- SETTINGS --}}
                        <div class="card p-3 mb-3">
                            <h5><b>Settings</b></h5>

                            <label>Popular</label>
                            <select name="is_popular" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>

                            <label class="mt-2">Featured</label>
                            <select name="is_featured" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>

                            <label class="mt-2">Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>

                        </div>

                        {{-- BUTTONS --}}
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save"></i> Save Category
                            </button>

                            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
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

<style>
    .card {
        border-radius: 10px;
    }
</style>

<script>
    let manualSlug = false;

    $('#slug').on('keyup', function () {
        manualSlug = true;
    });

    $('#name').on('keyup', function () {
        if (!manualSlug) {
            let slug = $(this).val()
                .toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');

            $('#slug').val(slug);
        }
    });
</script>