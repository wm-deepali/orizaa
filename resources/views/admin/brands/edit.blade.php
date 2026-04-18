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
						<a href="{{ route('admin.brands.index') }}">Brands</a>
					</li>

					<li class="breadcrumb-item active">
						Edit Brand
					</li>

				</ol>
			</div>

		</div>

		<div class="content-wrapper pb-4">

			<div class="card shadow-sm">

				<div class="card-header">
					<strong>Edit Brand</strong>
				</div>

				<div class="card-body">

					<form method="POST" action="{{ route('admin.brands.update', $brand->id) }}"
						enctype="multipart/form-data">
						@csrf
						@method('PUT')

						<div class="form-body">

							<div class="form-group row">

								<div class="col-sm-4">
									<label>Brand Name *</label>
									<input type="text" name="name" value="{{ $brand->name }}" class="form-control">
								</div>

								<div class="col-sm-4">
									<label>Status</label>
									<select name="status" class="form-control">
										<option value="1" {{ $brand->status ? 'selected' : '' }}>Active</option>
										<option value="0" {{ !$brand->status ? 'selected' : '' }}>Inactive</option>
									</select>
								</div>

								<div class="col-sm-4">
									<label>Brand Logo</label>
									<input type="file" name="logo" class="form-control">

									@if($brand->logo)
										<div class="mt-2">
											<img src="{{ asset('storage/' . $brand->logo) }}" width="80">
										</div>
									@endif

								</div>

							</div>

							<div class="form-actions">
								<button type="submit" class="btn btn-success pull-right">
									<i class="fa-solid fa-save"></i> Update
								</button>
								<a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">

									Cancel

								</a>
							</div>

						</div>

					</form>

				</div>

			</div>

		</div>

	</div>

</div>

@include('admin.footer')