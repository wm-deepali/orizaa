@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        {{-- Breadcrumb --}}
        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Manual Invoices
                    </li>

                </ol>
            </div>

            {{-- RIGHT SIDE (SEARCH + BUTTON) --}}
            <div class="ml-auto mr-2 d-flex align-items-center">

                {{-- SEARCH FORM --}}
                <form method="GET" action="{{ route('admin.invoices.index') }}" class="mr-2">
                    <div class="input-group">

                        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                            placeholder="Search Invoice / Customer">

                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>

                    </div>
                </form>

                {{-- CLEAR BUTTON --}}
                @if(request('search'))
                    <a href="{{ route('admin.invoices.index') }}" class="btn btn-outline-danger mr-2">
                        Clear
                    </a>
                @endif

                {{-- CREATE BUTTON --}}
                <a href="{{ route('admin.invoices.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Create Invoice
                </a>

            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">

                                <tr>
                                    <th width="60">ID</th>
                                    <th>Invoice No</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th width="150">Total</th>
                                    <th width="150">Action</th>
                                </tr>

                            </thead>

                            <tbody>

                                @forelse($invoices as $invoice)

                                    <tr id="row{{ $invoice->id }}">

                                        <td>{{ $invoice->id }}</td>

                                        <td>
                                            <strong>{{ $invoice->invoice_no }}</strong>
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($invoice->date)->format('d M Y') }}
                                        </td>

                                        <td>
                                            {{ $invoice->customer_name }}</br>
                                            {{ $invoice->phone }}</br>
                                            {{ $invoice->email }}
                                        </td>

                                        <td>
                                            ₹{{ number_format($invoice->total_amount, 2) }}
                                        </td>

                                        <td>

                                            {{-- VIEW (NEW) --}}
                                            <a href="{{ route('admin.invoices.show', $invoice->id) }}" target="_blank"
                                                class="btn btn-sm btn-outline-info">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            {{-- VIEW PDF --}}
                                            <a href="{{ route('admin.invoices.pdf', $invoice->id) }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-file-pdf"></i>
                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.invoices.edit', $invoice->id) }}"
                                                class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            {{-- DELETE --}}
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteInvoice({{ $invoice->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            No Invoices Found
                                        </td>
                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')


<script>
    function deleteInvoice(id) {
        Swal.fire({
            title: 'Delete Invoice?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        })
            .then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ url('admin/invoices') }}/" + id,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (res) {

                            Swal.fire('Deleted!', res.message, 'success');

                            $("#row" + id).fadeOut(400, function () {
                                $(this).remove();
                            });

                        }
                    });

                }

            });
    }
</script>