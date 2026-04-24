@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <!-- Breadcrumb -->
        <div class="breadcrumbs-top bg-light mb-3">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.exhibitions.index') }}">Manage Exhibition</a>
                </li>
                <li class="breadcrumb-item active">Edit Exhibition</li>
            </ol>
        </div>

        <div class="content-wrapper pb-4">
            <div class="card">
                <div class="card-header">
                    <strong>Edit Exhibition</strong>
                </div>

                <div class="card-body">

                    {{-- 🔴 VALIDATION ERRORS --}}
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
                        action="{{ route('admin.exhibitions.update', $exhibition->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Exhibition Name --}}
                        <div class="form-group">
                            <label>Exhibition Name *</label>
                            <input type="text"
                                name="title"
                                id="title"
                                value="{{ old('title', $exhibition->title) }}"
                                class="form-control @error('title') is-invalid @enderror"
                                required>

                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="form-group mt-3">
                            <label>Slug</label>
                            <input type="text"
                                name="slug"
                                id="slug"
                                value="{{ old('slug', $exhibition->slug) }}"
                                class="form-control">
                        </div>

                        {{-- Venue --}}
                        <div class="form-group mt-3">
                            <label>Venue</label>
                            <input type="text"
                                name="venue"
                                value="{{ old('venue', $exhibition->venue) }}"
                                class="form-control">
                        </div>

                        {{-- Dates --}}
                        <div class="form-row mt-3">
                            <div class="col">
                                <label>From Date</label>
                                <input type="date"
                                    name="from_date"
                                    value="{{ old('from_date', $exhibition->from_date) }}"
                                    class="form-control">
                            </div>

                            <div class="col">
                                <label>To Date</label>
                                <input type="date"
                                    name="to_date"
                                    value="{{ old('to_date', $exhibition->to_date) }}"
                                    class="form-control">
                            </div>
                        </div>

                        {{-- Subtitle --}}
                        <div class="form-group mt-3">
                            <label>Subtitle</label>
                            <textarea name="subtitle"
                                class="form-control">{{ old('subtitle', $exhibition->subtitle) }}</textarea>
                        </div>

                        {{-- Current Image --}}
                        @if($exhibition->image)
                            <div class="form-group mt-3">
                                <label>Current Image</label><br>
                                <img src="{{ asset('storage/'.$exhibition->image) }}"
                                     width="120"
                                     class="border rounded mb-2">
                            </div>
                        @endif

                        {{-- Upload New Image --}}
                        <div class="form-group mt-3">
                            <label>Change Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>

                        {{-- Meta Title --}}
                        <div class="form-group mt-3">
                            <label>Meta Title</label>
                            <input type="text"
                                name="meta_title"
                                value="{{ old('meta_title', $exhibition->meta_title) }}"
                                class="form-control">
                        </div>

                        {{-- Meta Description --}}
                        <div class="form-group mt-3">
                            <label>Meta Description</label>
                            <textarea name="meta_description"
                                class="form-control">{{ old('meta_description', $exhibition->meta_description) }}</textarea>
                        </div>

                        {{-- Status --}}
                        <div class="form-check mt-3">
                            <input type="checkbox"
                                name="status"
                                {{ old('status', $exhibition->status) ? 'checked' : '' }}>
                            <label>Active</label>
                        </div>

                        {{-- Buttons --}}
                        <div class="mt-4">

                            <button id="saveBtn" class="btn btn-success">
                                <i class="fa-solid fa-save"></i> Update
                            </button>

                            <a href="{{ route('admin.exhibitions.index') }}"
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
    // Slug auto
    document.getElementById('title').addEventListener('keyup', function () {
        let slug = this.value.toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');

        document.getElementById('slug').value = slug;
    });

    // Disable button on submit
    document.getElementById('Form').addEventListener('submit', function () {

        let btn = document.getElementById('saveBtn');

        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating...';

    });
</script>