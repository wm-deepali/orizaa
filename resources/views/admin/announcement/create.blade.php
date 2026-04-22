@include('admin.top-header')

<div class="main-section">

@include('admin.header')

<div class="app-content content container-fluid">

<div class="breadcrumbs-top bg-light mb-3">

<ol class="breadcrumb bg-transparent mb-0">
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.announcements.index') }}">Announcement</a></li>
<li class="breadcrumb-item active">Add</li>
</ol>

</div>

<div class="content-wrapper pb-4">

<div class="card shadow-sm">
<div class="card-header"><strong>Add Announcement</strong></div>

<div class="card-body">

<form method="POST" action="{{ route('admin.announcements.store') }}">
@csrf

<div class="form-group">
<label>Title *</label>
<input type="text" name="title" class="form-control" required>
</div>

<div class="form-group mt-3">
<label>Link (Optional)</label>
<input type="text" name="link" class="form-control">
</div>

<div class="form-group mt-3">
<div class="custom-control custom-checkbox">
<input type="checkbox" name="status" value="1" checked class="custom-control-input" id="status">
<label class="custom-control-label" for="status">Active</label>
</div>
</div>

<div class="mt-4">
<button type="submit" class="btn btn-success">
<i class="fa fa-save"></i> Save
</button>

<a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary">
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