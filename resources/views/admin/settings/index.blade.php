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
            <li class="breadcrumb-item active">Settings</li>
        </ol>
    </div>
</div>

<div class="content-wrapper pb-4">

<div class="row">

    {{-- LEFT MENU --}}
    <div class="col-md-3">
        <ul class="nav flex-column nav-pills">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#gst">
                    GST Setting
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#invoice">
                    Invoice Setting
                </a>
            </li>
        </ul>
    </div>

    {{-- RIGHT CONTENT --}}
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">

                <div class="tab-content">

                    {{-- ================= GST ================= --}}
                    <div class="tab-pane fade show active" id="gst">

                        <form id="gstForm" method="POST" action="{{ route('admin.settings.update') }}">
                            @csrf

                            <div class="form-group">
                                <label>IGST (%)</label>
                                <input type="number" step="0.01" name="igst"
                                    value="{{ $settings['igst'] ?? 18 }}"
                                    class="form-control">
                            </div>

                            <div class="form-group mt-3">
                                <label>CGST (%)</label>
                                <input type="number" step="0.01" name="cgst"
                                    value="{{ $settings['cgst'] ?? 9 }}"
                                    class="form-control">
                            </div>

                            <div class="form-group mt-3">
                                <label>SGST (%)</label>
                                <input type="number" step="0.01" name="sgst"
                                    value="{{ $settings['sgst'] ?? 9 }}"
                                    class="form-control">
                            </div>

                            <button class="btn btn-primary mt-3">Save GST</button>
                        </form>

                    </div>

                    {{-- ================= INVOICE ================= --}}
                    <div class="tab-pane fade" id="invoice">

                        <form id="invoiceForm" method="POST" enctype="multipart/form-data"
                            action="{{ route('admin.settings.update') }}">
                            @csrf

                            <div class="form-group">
                                <label>Invoice Prefix</label>
                                <input type="text" name="invoice_prefix"
                                    value="{{ $settings['invoice_prefix'] ?? 'INV' }}"
                                    class="form-control">
                            </div>

                            <div class="form-group mt-3">
                                <label>Serial Number</label>
                                <input type="number" name="invoice_serial"
                                    value="{{ $settings['invoice_serial'] ?? 1001 }}"
                                    class="form-control">
                            </div>

                            <div class="form-group mt-3">
                                <label>Billing Address</label>
                                <textarea name="billing_address" class="form-control">{{ $settings['billing_address'] ?? '' }}</textarea>
                            </div>

                            <div class="form-group mt-3">
                                <label>Upload Logo</label>

                                @if(!empty($settings['billing_logo']))
                                    <img src="{{ asset('storage/'.$settings['billing_logo']) }}" height="50">
                                @endif

                                <input type="file" name="billing_logo" class="form-control">
                            </div>

                            <button class="btn btn-primary mt-3">Save Invoice</button>
                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

</div>
</div>
</div>

@include('admin.footer')

<script>
document.querySelectorAll("form").forEach(form => {
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch(this.action, {
            method: "POST",
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
        });
    });
});
</script>