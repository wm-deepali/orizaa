@include('admin.top-header')

<div class="main-section">

@include('admin.header')

<div class="app-content content container-fluid">

<div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

<ol class="breadcrumb bg-transparent mb-0">

<li class="breadcrumb-item">
<a href="{{ route('admin.dashboard') }}">Dashboard</a>
</li>

<li class="breadcrumb-item">
<a href="{{ route('admin.contact-branches.index') }}">Contact Branches</a>
</li>

<li class="breadcrumb-item active">
Edit Branch
</li>

</ol>

</div>

<div class="card shadow-sm">

<div class="card-header">
<strong>Edit Branch</strong>
</div>

<div class="card-body">

<form method="POST"
enctype="multipart/form-data"
action="{{ route('admin.contact-branches.update',$branch->id) }}">
@csrf
@method('PUT')

<div class="form-group">
<label>Branch Name *</label>
<input type="text" name="title" value="{{ $branch->title }}" class="form-control">
</div>

<div class="form-group mt-3">
<label>Subtitle</label>
<input type="text" name="subtitle" value="{{ $branch->subtitle }}" class="form-control">
</div>

<div class="form-group mt-3">
<label>Address</label>
<textarea name="address" class="form-control">{{ $branch->address }}</textarea>
</div>

<div class="form-group mt-3">
<label>Phone</label>
<input type="text" name="phone" value="{{ $branch->phone }}" class="form-control">
</div>

<div class="form-group mt-3">
<label>Email</label>
<input type="text" name="email" value="{{ $branch->email }}" class="form-control">
</div>

<div class="form-group mt-3">
<label>Working Hours</label>
<input type="text" name="working_hours" value="{{ $branch->working_hours }}" class="form-control">
</div>

<div class="form-group mt-3">
<label>Icon</label>
<input type="file" name="icon" class="form-control">

@if($branch->icon)
    <div class="mt-2">
        <img src="{{ asset('storage/'.$branch->icon) }}" width="60">
    </div>
@endif
</div>

<div class="form-group mt-3">
<label>Status</label>
<select name="status" class="form-control">
<option value="1" {{ $branch->status ? 'selected' : '' }}>Active</option>
<option value="0" {{ !$branch->status ? 'selected' : '' }}>Inactive</option>
</select>
</div>

<div class="mt-4">
<button class="btn btn-success">
<i class="fa fa-save"></i> Update
</button>

<a href="{{ route('admin.contact-branches.index') }}" class="btn btn-secondary">
Cancel
</a>
</div>

</form>

</div>
</div>

</div>
</div>

@include('admin.footer')