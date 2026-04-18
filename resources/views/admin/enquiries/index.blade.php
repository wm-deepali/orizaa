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

                    <li class="breadcrumb-item active">
                        Manage Enquiries
                    </li>

                </ol>
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
                                    <th>Business</th>
                                    <th>Owner</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th width="120">Date</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($enquiries as $enquiry)

                                    <tr id="row{{ $enquiry->id }}">

                                        <td>{{ $enquiry->id }}</td>

                                        <td>
                                            <strong>{{ $enquiry->business_name }}</strong>
                                        </td>

                                        <td>{{ $enquiry->owner_name }}</td>

                                        <td>{{ $enquiry->email }}</td>

                                        <td>{{ $enquiry->mobile }}</td>

                                        <td>{{ $enquiry->state->name ?? '-' }}</td>

                                        <td>{{ $enquiry->city->name ?? '-' }}</td>

                                        <td>
                                            {{ $enquiry->created_at->format('d M Y') }}
                                        </td>

                                        <td>

                                            <a href="{{ route('admin.enquiries.show', $enquiry->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteEnquiry({{ $enquiry->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            No Enquiries Found
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

    function deleteEnquiry(id) {
        Swal.fire({
            title: 'Delete Enquiry?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        })
        .then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "{{ url('admin/enquiries') }}/" + id,
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