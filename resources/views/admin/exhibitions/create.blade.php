@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top bg-light mb-3">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.exhibitions.index') }}">Manage Exhibition</a>
                </li>
                <li class="breadcrumb-item active">Add Exhibition</li>
            </ol>
        </div>

        <div class="content-wrapper pb-4">
            <div class="card">
                <div class="card-header"><strong>Add Exhibition</strong></div>

                <div class="card-body">

                    {{-- ERROR MESSAGE --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="Form" method="POST" enctype="multipart/form-data"
                        action="{{ route('admin.exhibitions.store') }}">
                        @csrf

                        <div class="form-group">
                            <label>Exhibition Name *</label>
                            <input type="text" name="title" id="title"
                                value="{{ old('title') }}"
                                class="form-control @error('title') is-invalid @enderror" required>
                        </div>

                        <div class="form-group mt-3">
                            <label>Slug</label>
                            <input type="text" name="slug" id="slug"
                                value="{{ old('slug') }}"
                                class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>Venue</label>
                            <input type="text" name="venue"
                                value="{{ old('venue') }}"
                                class="form-control">
                        </div>

                        <div class="form-row mt-3">
                            <div class="col">
                                <label>From Date</label>
                                <input type="date" name="from_date"
                                    value="{{ old('from_date') }}"
                                    class="form-control">
                            </div>

                            <div class="col">
                                <label>To Date</label>
                                <input type="date" name="to_date"
                                    value="{{ old('to_date') }}"
                                    class="form-control">
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label>Subtitle</label>
                            <textarea name="subtitle" class="form-control">{{ old('subtitle') }}</textarea>
                        </div>

                        <div class="form-group mt-3">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title"
                                value="{{ old('meta_title') }}"
                                class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
                        </div>

                        <div class="form-check mt-3">
                            <input type="checkbox" name="status"
                                {{ old('status', 1) ? 'checked' : '' }}>
                            <label>Active</label>
                        </div>

                        <button id="saveBtn" class="btn btn-success mt-3">
                            Save
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@include('admin.footer')

<script>
document.getElementById('title').addEventListener('keyup', function () {
    let slug = this.value.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
    document.getElementById('slug').value = slug;
});

document.getElementById('Form').addEventListener('submit', function () {
    let btn = document.getElementById('saveBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving...';
});
</script>