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
                        <a href="{{ route('admin.coupons.index') }}">Manage Coupons</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Add Coupon
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Add Coupon</strong>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.coupons.store') }}">

                        @csrf

                        <div class="form-group">
                            <label>Coupon Code *</label>
                            <input type="text" name="code" id="code" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label>Type *</label>
                            <select name="type" class="form-control" required>
                                <option value="percentage">Percentage</option>
                                <option value="fixed">Fixed</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label>Value *</label>
                            <input type="number" name="value" class="form-control" required>
                        </div>

                        <div class="form-group mt-3">
                            <label>Minimum Order Amount</label>
                            <input type="number" name="min_order_amount" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>Max Discount</label>
                            <input type="number" name="max_discount" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>Usage Limit</label>
                            <input type="number" name="usage_limit" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>Start Date</label>
                            <input type="datetime-local" name="start_date" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <label>End Date</label>
                            <input type="datetime-local" name="end_date" class="form-control">
                        </div>

                        <div class="form-group mt-3">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_active" id="is_active" class="custom-control-input" checked>
                                <label class="custom-control-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>

                        <div class="mt-4">

                            <button type="submit" id="saveBtn" class="btn btn-success">
                                <i class="fa-solid fa-save"></i> Save Coupon
                            </button>

                            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">
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
document.getElementById('code').addEventListener('keyup', function () {
    this.value = this.value.toUpperCase();
});

document.querySelector('form').addEventListener('submit', function () {
    let btn = document.getElementById('saveBtn');
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving...';
});
</script>