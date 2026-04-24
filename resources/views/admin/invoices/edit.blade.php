@include('admin.top-header')

<style>
    .suggest-box {
        position: absolute;
        background: #fff;
        border: 1px solid #ddd;
        z-index: 999;
        width: 100%;
        max-height: 150px;
        overflow-y: auto;
    }

    .suggest-item {
        padding: 8px;
        cursor: pointer;
    }

    .suggest-item:hover {
        background: #f1f1f1;
    }
</style>

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <!-- Breadcrumb -->
        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.invoices.index') }}">Invoices</a></li>
                    <li class="breadcrumb-item active">Edit Invoice</li>
                </ol>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.invoices.update', $invoice->id) }}">
            @csrf
            @method('PUT')

            <!-- ================= INVOICE DETAILS ================= -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <h5 class="mb-3">Invoice Details</h5>

                    <div class="row">
                        <div class="col-md-4">
                            <label>Invoice No *</label>
                            <input name="invoice_no" value="{{ $invoice->invoice_no }}" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label>Date *</label>
                            <input type="date" name="date" value="{{ $invoice->date }}" class="form-control" required>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ================= CUSTOMER ================= -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <h5 class="mb-3">Customer Details</h5>

                    <div class="row">

                        <div class="col-md-4">
                            <label>Mobile</label>
                            <input name="mobile" id="mobile" value="{{ $invoice->mobile }}" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label>Customer Name *</label>
                            <input name="customer_name" value="{{ $invoice->customer_name }}" class="form-control"
                                required>
                        </div>

                        <div class="col-md-4">
                            <label>Email</label>
                            <input name="email" value="{{ $invoice->email }}" class="form-control">
                        </div>

                    </div>

                    <div class="mt-3">
                        <label>GSTIN</label>
                        <input name="gstin" value="{{ $invoice->gstin }}" class="form-control">
                    </div>

                    <div class="mt-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control">{{ $invoice->address }}</textarea>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label>State</label>
                            <select name="state" id="state" class="form-control">
                                @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ $invoice->state == $state->name ? 'selected' : '' }}>
                                        {{ $state->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>City</label>
                            <select name="city" id="city" class="form-control">
                                <option value="{{ $invoice->city }}">{{ $invoice->city }}</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label>ZIP</label>
                            <input name="zip" value="{{ $invoice->zip }}" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label>State Code</label>
                            <input name="state_code" value="{{ $invoice->state_code }}" class="form-control">
                        </div>
                    </div>

                </div>
            </div>

            <!-- ================= ITEMS ================= -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">
                        <h5>Invoice Items</h5>
                        <button type="button" id="addRow" class="btn btn-primary btn-sm">+ Add Item</button>
                    </div>

                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Article</th>
                                <th>Description</th>
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Discount</th>
                                <th>GST%</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="itemsBody">

                            @foreach($invoice->items as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>

                                    <td style="position:relative;">
                                        <input name="items[{{ $i }}][article_no]" value="{{ $item->article_no }}"
                                            class="form-control article-input">
                                    </td>

                                    <td>
                                        <input name="items[{{ $i }}][description]" value="{{ $item->description }}"
                                            class="form-control desc-input" readonly>
                                    </td>

                                    <td>
                                        <input name="items[{{ $i }}][qty]" value="{{ $item->qty }}"
                                            class="form-control qty">
                                    </td>

                                    <td>
                                        <input name="items[{{ $i }}][rate]" value="{{ $item->rate }}"
                                            class="form-control rate">
                                    </td>

                                    <td>
                                        <div class="d-flex">
                                            <input name="items[{{ $i }}][discount]" value="{{ $item->discount }}"
                                                class="form-control discount">
                                            <select name="items[{{ $i }}][discount_type]"
                                                class="form-control discount_type ml-1">
                                                <option value="flat" {{ $item->discount_type == 'flat' ? 'selected' : '' }}>₹
                                                </option>
                                                <option value="percent" {{ $item->discount_type == 'percent' ? 'selected' : '' }}>
                                                    %</option>
                                            </select>
                                        </div>
                                    </td>

                                    <td>
                                        <input name="items[{{ $i }}][gst]" value="{{ $item->gst }}"
                                            class="form-control gst">
                                    </td>

                                    <td>
                                        <input name="items[{{ $i }}][price]" value="{{ $item->price }}"
                                            class="form-control bg-light price" readonly>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm removeRow">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>

            <!-- ================= TOTAL ================= -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <input id="total_taxable" name="total_taxable" value="{{ $invoice->total_taxable }}"
                                class="form-control bg-light" readonly>
                        </div>

                        <div class="col-md-4">
                            <input id="total_tax" name="total_tax" value="{{ $invoice->total_tax }}"
                                class="form-control bg-light" readonly>
                        </div>

                        <div class="col-md-4">
                            <input id="total_amount" name="total_amount" value="{{ $invoice->total_amount }}"
                                class="form-control bg-light" readonly>
                        </div>
                    </div>

                </div>
            </div>

            <div class="text-right mb-4">
                <button class="btn btn-success">Update Invoice</button>
            </div>

        </form>
    </div>
</div>

<div id="descPopup"
    style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999;">

    <div style="width:500px; margin:100px auto; background:#fff; padding:20px; border-radius:8px;">

        <h5>Description</h5>

        <textarea id="descTextarea" class="form-control" rows="8"></textarea>

        <div class="text-right mt-3">
            <button id="saveDesc" class="btn btn-primary btn-sm">Save</button>
            <button id="closeDesc" class="btn btn-secondary btn-sm">Close</button>
        </div>

    </div>
</div>

@include('admin.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).ready(function () {

        let stateId = $('#state').val(); // already selected
        let selectedCity = "{{ $invoice->city }}";

        if (stateId) {

            $.get('/admin/get-cities/' + stateId, function (cities) {

                let html = '<option value="">Select City</option>';
                cities.forEach(c => {
                    let selected = (c.name === selectedCity) ? 'selected' : '';
                    html += `<option value="${c.name}" ${selected}>${c.name}</option>`;
                });

                $('#city').html(html);

            });

        }

    });

    // STATE → CITY
    $('#state').change(function () {
        let id = $(this).val();
        $.get('/admin/get-cities/' + id, function (data) {
            let html = '<option>Select City</option>';
            data.forEach(c => {
                html += `<option value="${c.name}">${c.name}</option>`;
            });
            $('#city').html(html);
        });
    });

    // ARTICLE SUGGEST
    $(document).on('keyup', '.article-input', function () {
        let input = $(this);
        let q = input.val();

        if (q.length < 2) return;

        $.get('/admin/article-suggestions?q=' + q, function (data) {

            let list = data.map(d => `
    <div class="suggest-item"
         data-article="${d.article_no}"
         data-desc="${d.description}">
         ${d.article_no} - ${d.description}
    </div>
`).join('');

            input.next('.suggest-box').remove();
            input.after(`<div class="suggest-box">${list}</div>`);
        });
    });

    $(document).on('click', '.suggest-item', function () {
        let row = $(this).closest('td');

        let article = $(this).data('article');
        let desc = $(this).data('desc');

        row.find('.article-input').val(article);
        row.closest('tr').find('input[name*="[description]"]').val(desc);

        $(this).parent().remove();
    });

    // CALCULATION
    $(document).on('keyup change', '.qty,.rate,.discount,.discount_type,.gst', function () {

        let row = $(this).closest('tr');

        let qty = parseFloat(row.find('.qty').val()) || 0;
        let rate = parseFloat(row.find('.rate').val()) || 0;
        let discount = parseFloat(row.find('.discount').val()) || 0;
        let type = row.find('.discount_type').val();
        let gst = parseFloat(row.find('.gst').val()) || 0;

        let base = qty * rate;

        if (type === 'percent') {
            discount = (base * discount) / 100;
        }

        let taxable = base - discount;
        let tax = taxable * gst / 100;
        let total = taxable + tax;

        row.find('.price').val(total.toFixed(2));

        calculateTotals();
    });

    function calculateTotals() {
        let t1 = 0, t2 = 0, t3 = 0;

        $('#itemsBody tr').each(function () {

            let qty = parseFloat($(this).find('.qty').val()) || 0;
            let rate = parseFloat($(this).find('.rate').val()) || 0;
            let discount = parseFloat($(this).find('.discount').val()) || 0;
            let type = $(this).find('.discount_type').val();
            let gst = parseFloat($(this).find('.gst').val()) || 0;

            let base = qty * rate;

            if (type === 'percent') {
                discount = (base * discount) / 100;
            }

            let taxable = base - discount;
            let tax = taxable * gst / 100;

            t1 += taxable;
            t2 += tax;
            t3 += taxable + tax;
        });

        $('#total_taxable').val(t1.toFixed(2));
        $('#total_tax').val(t2.toFixed(2));
        $('#total_amount').val(t3.toFixed(2));
    }

    $('#addRow').click(function () {

        let index = $('#itemsBody tr').length;

        let lastRow = $('#itemsBody tr:last');
        let lastGst = lastRow.find('.gst').val(); // copy GST

        let row = `
    <tr>
        <td>${index + 1}</td>

        <td>
            <input name="items[${index}][article_no]" class="form-control article-input">
        </td>

        <td>
           <input name="items[${index}][description]" class="form-control desc-input" readonly>
        </td>

        <td>
            <input name="items[${index}][qty]" value="1" class="form-control qty">
        </td>

        <td>
            <input name="items[${index}][rate]" class="form-control rate">
        </td>

        <td>
            <div class="d-flex">
                <input name="items[${index}][discount]" class="form-control discount">
                <select name="items[${index}][discount_type]" class="form-control discount_type ml-1">
                    <option value="flat">₹</option>
                    <option value="percent">%</option>
                </select>
            </div>
        </td>

        <td>
            <input name="items[${index}][gst]" value="${lastGst}" class="form-control gst">
        </td>

        <td>
    <input name="items[${index}][price]" class="form-control bg-light price" readonly>
</td>

<td>
    <button type="button" class="btn btn-sm btn-danger removeRow">
        <i class="fa fa-trash"></i>
    </button>
</td>
    </tr>`;

        $('#itemsBody').append(row);
    });


    let timeout = null;

    $('#mobile').on('keyup', function () {

        let mobile = $(this).val();

        if (mobile.length < 10) return;

        clearTimeout(timeout);

        timeout = setTimeout(function () {

            $.get('/admin/customer-by-mobile?mobile=' + mobile, function (res) {

                if (res.found) {

                    let data = res.data;

                    $('input[name="customer_name"]').val(data.customer_name);
                    $('input[name="email"]').val(data.email);
                    $('textarea[name="address"]').val(data.address);
                    $('input[name="gstin"]').val(data.gstin);
                    $('input[name="zip"]').val(data.zip);
                    $('input[name="state_code"]').val(data.state_code);

                    // ✅ SET STATE
                    let stateName = data.state;

                    $("#state option").each(function () {
                        if ($(this).text().trim() === stateName) {
                            $(this).prop('selected', true);

                            let stateId = $(this).val();

                            // ✅ LOAD CITY
                            $.get('/admin/get-cities/' + stateId, function (cities) {

                                let html = '<option>Select City</option>';

                                cities.forEach(c => {
                                    let selected = (c.name === data.city) ? 'selected' : '';
                                    html += `<option value="${c.name}" ${selected}>${c.name}</option>`;
                                });

                                $('#city').html(html);
                            });

                        }
                    });

                    $('#mobile').addClass('border-success');

                } else {

                    $('#mobile').removeClass('border-success');
                }

            });

        }, 500);

    });

    $(document).on('click', '.removeRow', function () {

        if ($('#itemsBody tr').length === 1) {
            alert('At least one item required');
            return;
        }

        $(this).closest('tr').remove();

        updateRowNumbers();
        reindexInputs();
        calculateTotals();
    });

    function updateRowNumbers() {
        $('#itemsBody tr').each(function (i) {
            $(this).find('td:first').text(i + 1);
        });
    }

    $(document).click(function (e) {
        if (!$(e.target).closest('.article-input').length) {
            $('.suggest-box').remove();
        }
    });

    function reindexInputs() {
        $('#itemsBody tr').each(function (i) {
            $(this).find('input, select').each(function () {
                let name = $(this).attr('name');
                if (name) {
                    let newName = name.replace(/items\[\d+\]/, `items[${i}]`);
                    $(this).attr('name', newName);
                }
            });
        });
    }

    let currentDescInput = null;

    // OPEN
    $(document).on('click', '.desc-input', function () {

        currentDescInput = $(this);

        $('#descTextarea').val($(this).val());

        $('#descPopup').fadeIn();
    });

    // SAVE
    $('#saveDesc').click(function () {

        if (currentDescInput) {
            currentDescInput.val($('#descTextarea').val());
        }

        $('#descPopup').fadeOut();
    });

    // CLOSE BUTTON
    $('#closeDesc').click(function () {
        $('#descPopup').fadeOut();
    });

    // CLICK OUTSIDE
    $('#descPopup').click(function (e) {
        if (e.target === this) {
            $(this).fadeOut();
        }
    });
</script>