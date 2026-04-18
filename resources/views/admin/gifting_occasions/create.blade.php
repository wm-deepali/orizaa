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
                        Add Occasion
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Add Occasion</strong>
                </div>

                <div class="card-body">

                    <form id="form" method="POST"
                          action="{{ route('admin.gifting-occasions.store') }}"
                          enctype="multipart/form-data">

                        @csrf

                        <!-- Title -->
                        <div class="form-group">
                            <label>Title *</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>

                        <!-- Slug -->
                        <div class="form-group mt-3">
                            <label>Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control">
                        </div>

                        <!-- Sub Title -->
                        <div class="form-group mt-3">
                            <label>Sub Title</label>
                            <input type="text" name="sub_title" class="form-control">
                        </div>

                        <!-- Short Description -->
                        <div class="form-group mt-3">
                            <label>Short Description</label>
                            <textarea name="short_description" class="form-control"></textarea>
                        </div>

                        <!-- Image -->
                        <div class="form-group mt-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <!-- Meta -->
                        <div class="form-group mt-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control"></textarea>
                        </div>

                        <!-- Status -->
                        <div class="form-group mt-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>


                        <!-- Buttons -->
                        <div class="mt-4">

                            <button type="submit" id="saveBtn" class="btn btn-success">
                                <i class="fa-solid fa-save"></i> Save Occasion
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

// loading button
document.getElementById('form').addEventListener('submit', function () {

    let btn = document.getElementById('saveBtn');

    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving...';

});
</script>