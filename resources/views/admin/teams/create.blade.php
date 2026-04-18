@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top bg-light mb-3">
            <ol class="breadcrumb bg-transparent mb-0">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.teams.index') }}">Manage Team</a></li>
                <li class="active">Add Team</li>
            </ol>
        </div>

        <div class="card">
            <div class="card-header"><strong>Add Team Member</strong></div>

            <div class="card-body">

                {{-- GLOBAL ERROR --}}
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.teams.store') }}">
                    @csrf

                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>Designation *</label>
                        <input type="text" name="designation" class="form-control" value="{{ old('designation') }}">
                        @error('designation') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">
                        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group mt-3">
                        <input type="checkbox" name="status" {{ old('status', true) ? 'checked' : '' }}> Active
                    </div>

                    <button class="btn btn-success mt-3">Save</button>
                    <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary mt-3">Cancel</a>

                </form>

            </div>
        </div>

    </div>
</div>

@include('admin.footer')