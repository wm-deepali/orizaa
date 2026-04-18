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
						<a href="{{ route('admin.contact-branches.index') }}">Contact Branches</a>
					</li>

					<li class="breadcrumb-item active">
						Add Branches
					</li>

				</ol>
			</div>

		</div>

		<div class="content-wrapper pb-4">

			<div class="card shadow-sm">

				<div class="card-header">
					<strong>Add Contact Branches</strong>
				</div>

				<div class="card-body">

					<form method="POST" enctype="multipart/form-data"
						action="{{ route('admin.contact-branches.store') }}">
						@csrf

						<div id="branchWrap">

							{{-- FIRST ROW --}}
							<div class="branch-block border p-3 mb-3 rounded">

								<div class="form-group">
									<label>Branch Name *</label>
									<input type="text" name="title[]" class="form-control">
								</div>

								<div class="form-group mt-3">
									<label>Subtitle</label>
									<input type="text" name="subtitle[]" class="form-control">
								</div>

								<div class="form-group mt-3">
									<label>Address</label>
									<textarea name="address[]" class="form-control"></textarea>
								</div>

								<div class="form-group mt-3">
									<label>Phone</label>
									<input type="text" name="phone[]" class="form-control">
								</div>

								<div class="form-group mt-3">
									<label>Email</label>
									<input type="text" name="email[]" class="form-control">
								</div>

								<div class="form-group mt-3">
									<label>Working Hours</label>
									<input type="text" name="working_hours[]" class="form-control">
								</div>

								<div class="form-group mt-3">
									<label>Icon</label>
									<input type="file" name="icon[]" class="form-control">
								</div>

							</div>

						</div>

						<button type="button" onclick="addBranch()" class="btn btn-info mb-3">
							Add More
						</button>

						<div class="mt-4">
							<button type="submit" class="btn btn-success">
								<i class="fa fa-save"></i> Save Branches
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
</div>

@include('admin.footer')

<script>
	function addBranch() {
		$('#branchWrap').append(`
<div class="branch-block border p-3 mb-3 rounded">

<div class="form-group">
<label>Branch Name *</label>
<input type="text" name="title[]" class="form-control">
</div>

<div class="form-group mt-3">
<label>Subtitle</label>
<input type="text" name="subtitle[]" class="form-control">
</div>

<div class="form-group mt-3">
<label>Address</label>
<textarea name="address[]" class="form-control"></textarea>
</div>

<div class="form-group mt-3">
<label>Phone</label>
<input type="text" name="phone[]" class="form-control">
</div>

<div class="form-group mt-3">
<label>Email</label>
<input type="text" name="email[]" class="form-control">
</div>

<div class="form-group mt-3">
<label>Working Hours</label>
<input type="text" name="working_hours[]" class="form-control">
</div>

<div class="form-group mt-3">
<label>Icon</label>
<input type="file" name="icon[]" class="form-control">
</div>

</div>
`);
	}
</script>