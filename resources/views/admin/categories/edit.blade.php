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
                        Edit Category
                    </li>
                </ol>
            </div>
        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">
                <div class="card-header">
                    <strong>Edit Category</strong>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- BASIC --}}
                        <div class="card p-3 mb-3">
                            <h5><b>Basic Info</b></h5>

                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control"
                                required>

                            <label class="mt-2">Slug</label>
                            <input type="text" name="slug" id="slug" value="{{ $category->slug }}" class="form-control">

                            <label class="mt-2">Sub Title</label>
                            <input type="text" name="sub_title" value="{{ $category->sub_title }}" class="form-control">

                            <label class="mt-2">Parent Category</label>
                            <select name="parent_id" class="form-control">
                                <option value="">Parent Category</option>

                                @foreach($parents as $parent)
                                    <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>

                            <label class="mt-2">Sort Order</label>
<input type="number" name="sort_order" value="{{ $category->sort_order }}" class="form-control">

                        </div>

                        {{-- MEDIA --}}
                        <div class="card p-3 mb-3">
                            <h5><b>Media</b></h5>

                            <label>Image</label>
                            <input type="file" name="image" class="form-control">

                            @if($category->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $category->image) }}" width="80" class="rounded">
                                </div>
                            @endif

                        </div>

                        {{-- SEO --}}
                        <div class="card p-3 mb-3">
                            <h5><b>SEO</b></h5>

                            <label>Meta Title</label>
                            <input type="text" name="meta_title" value="{{ $category->meta_title }}"
                                class="form-control">

                            <label class="mt-2">Meta Description</label>
                            <textarea name="meta_description"
                                class="form-control">{{ $category->meta_description }}</textarea>

                        </div>

                        {{-- SETTINGS --}}
                        <div class="card p-3 mb-3">
                            <h5><b>Settings</b></h5>

                            <label>Popular</label>
                            <select name="is_popular" class="form-control">
                                <option value="0" {{ !$category->is_popular ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $category->is_popular ? 'selected' : '' }}>Yes</option>
                            </select>

                            <label class="mt-2">Featured</label>
                            <select name="is_featured" class="form-control">
                                <option value="0" {{ !$category->is_featured ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $category->is_featured ? 'selected' : '' }}>Yes</option>
                            </select>

                            <label class="mt-2">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ $category->status ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$category->status ? 'selected' : '' }}>Inactive</option>
                            </select>

                        </div>

                        {{-- BUTTONS --}}
                        <div class="mt-3">
                            <button type="submit" id="updateBtn" class="btn btn-success">
                                <i class="fa fa-save"></i> Update Category
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

    // Disable button on submit
    document.querySelector('form').addEventListener('submit', function () {
        let btn = document.getElementById('updateBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating...';
    });
</script>