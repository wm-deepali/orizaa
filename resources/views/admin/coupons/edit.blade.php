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
                        Edit Coupon
                    </li>

                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit Coupon</strong>
                </div>

                <div class="card-body">

                    <form id="couponForm" method="POST"
                        action="{{ route('admin.coupons.update', $coupon->id) }}">

                        @csrf
                        @method('PUT')

                        {{-- CODE --}}
                        <div class="form-group">
                            <label>Coupon Code *</label>
                            <input type="text" name="code" id="code"
                                value="{{ $coupon->code }}"
                                class="form-control" required>
                        </div>

                        {{-- TYPE --}}
                        <div class="form-group mt-3">
                            <label>Type *</label>
                            <select name="type" class="form-control" required>
                                <option value="percentage" {{ $coupon->type == 'percentage' ? 'selected' : '' }}>
                                    Percentage
                                </option>
                                <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>
                                    Fixed
                                </option>
                            </select>
                        </div>

                        {{-- VALUE --}}
                        <div class="form-group mt-3">
                            <label>Value *</label>
                            <input type="number" name="value"
                                value="{{ $coupon->value }}"
                                class="form-control" required>
                        </div>

                        {{-- MIN ORDER --}}
                        <div class="form-group mt-3">
                            <label>Minimum Order Amount</label>
                            <input type="number" name="min_order_amount"
                                value="{{ $coupon->min_order_amount }}"
                                class="form-control">
                        </div>

                        {{-- MAX DISCOUNT --}}
                        <div class="form-group mt-3">
                            <label>Max Discount</label>
                            <input type="number" name="max_discount"
                                value="{{ $coupon->max_discount }}"
                                class="form-control">
                        </div>

                        {{-- USAGE LIMIT --}}
                        <div class="form-group mt-3">
                            <label>Usage Limit</label>
                            <input type="number" name="usage_limit"
                                value="{{ $coupon->usage_limit }}"
                                class="form-control">
                        </div>

                        {{-- START DATE --}}
                        <div class="form-group mt-3">
                            <label>Start Date</label>
                            <input type="datetime-local" name="start_date"
                                value="{{ $coupon->start_date ? \Carbon\Carbon::parse($coupon->start_date)->format('Y-m-d\TH:i') : '' }}"
                                class="form-control">
                        </div>

                        {{-- END DATE --}}
                        <div class="form-group mt-3">
                            <label>End Date</label>
                            <input type="datetime-local" name="end_date"
                                value="{{ $coupon->end_date ? \Carbon\Carbon::parse($coupon->end_date)->format('Y-m-d\TH:i') : '' }}"
                                class="form-control">
                        </div>

                        {{-- STATUS --}}
                        <div class="form-group mt-3">

                            <div class="custom-control custom-checkbox">

                                <input type="checkbox"
                                    name="is_active"
                                    id="is_active"
                                    class="custom-control-input"
                                    {{ $coupon->is_active ? 'checked' : '' }}>

                                <label class="custom-control-label" for="is_active">
                                    Active
                                </label>

                            </div>

                        </div>

                        {{-- ACTION --}}
                        <div class="mt-4">

                            <button type="submit" id="updateBtn" class="btn btn-success">
                                <i class="fa-solid fa-save"></i> Update Coupon
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
    // AUTO UPPERCASE
    document.getElementById('code').addEventListener('keyup', function () {
        this.value = this.value.toUpperCase();
    });

    // LOADING BUTTON
    document.getElementById('couponForm').addEventListener('submit', function () {
        let btn = document.getElementById('updateBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating...';
    });
</script>