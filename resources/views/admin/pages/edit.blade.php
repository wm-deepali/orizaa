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
						<a href="{{ route('admin.pages.index') }}">Manage Dynamic Pages</a>
					</li>

					<li class="breadcrumb-item active">
						Edit Dynamic Page
					</li>

				</ol>
			</div>

		</div>


		<div class="content-wrapper pb-4">

			<div class="card shadow-sm">

				<div class="card-header">
					<strong>Edit Dynamic Page</strong>
				</div>

				<div class="card-body">

					<form method="POST" action="{{ route('admin.pages.update', $page->id) }}">
						@csrf
						@method('PUT')

						<div class="form-group row">

							<div class="col-sm-4">
								<label>Page Name</label>
								<input type="text" name="page_name" value="{{ $page->page_name }}" class="form-control">
							</div>

							<div class="col-sm-4">
								<label>Heading</label>
								<input type="text" name="heading" value="{{ $page->heading }}" class="form-control">
							</div>

							<div class="col-sm-4">
								<label>Status</label>
								<select name="status" class="form-control">
									<option value="active" {{ $page->status == 'active' ? 'selected' : '' }}>Active</option>
									<option value="block" {{ $page->status == 'block' ? 'selected' : '' }}>Block</option>
								</select>
							</div>

						</div>

						<div class="form-group row">
							<div class="col-sm-12">
								<label>Detail Content</label>
								<textarea name="content" id="content"
									class="form-control editor">{{ $page->content }}</textarea>
							</div>
						</div>

						<div class="form-group row">

							<div class="col-sm-6">
								<label>Meta Title</label>
								<input type="text" name="meta_title" value="{{ $page->meta_title }}"
									class="form-control">
							</div>

							<div class="col-sm-6">
								<label>Meta Description</label>
								<textarea name="meta_description"
									class="form-control">{{ $page->meta_description }}</textarea>
							</div>

						</div>

						<div class="form-actions">
							<button type="submit" class="btn btn-primary pull-right">
								Update
							</button>
						</div>

					</form>
				</div>

			</div>

		</div>

	</div>

</div>

@include('admin.footer')

<script src="https://cdn.ckeditor.com/4.25.1-lts/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace('content');
</script>