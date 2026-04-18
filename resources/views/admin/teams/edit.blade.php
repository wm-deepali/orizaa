@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top bg-light mb-3">
            <ol class="breadcrumb bg-transparent mb-0">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.teams.index') }}">Manage Team</a></li>
                <li class="active">Edit Team</li>
            </ol>
        </div>

        <div class="card">
            <div class="card-header"><strong>Edit Team Member</strong></div>

            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.teams.update', $team->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Name *</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $team->name) }}">
                    </div>

                    <div class="form-group mt-3">
                        <label>Designation *</label>
                        <input type="text" name="designation" class="form-control"
                            value="{{ old('designation', $team->designation) }}">
                    </div>

                    <div class="form-group mt-3">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control">

                        @if($team->image)
                            <img src="{{ asset('storage/' . $team->image) }}" width="100" class="mt-2">
                        @endif
                    </div>

                    <div class="form-group mt-3">
                        <label>Description</label>
                        <textarea name="description"
                            class="form-control">{{ old('description', $team->description) }}</textarea>
                    </div>

                    <div class="form-group mt-3">
                        <input type="checkbox" name="status" {{ old('status', $team->status) ? 'checked' : '' }}> Active
                    </div>

                    <button class="btn btn-success mt-3">Update</button>
                    <a href="{{ route('admin.teams.index') }}" class="btn btn-secondary mt-3">Cancel</a>

                </form>

            </div>
        </div>

    </div>
</div>

@include('admin.footer')