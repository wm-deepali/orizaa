@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item active">Testimonials</li>
                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
                    Add Testimonial
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
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($testimonials as $t)
                                    <tr>
                                        <td>{{ $t->id }}</td>
                                        <td>{{ $t->name }}</td>
                                        <td>{{ ucfirst($t->type) }}</td>
                                        <td>{{ $t->rating ?? '-' }}</td>
                                        <td>{{ $t->status ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('admin.testimonials.edit', $t->id) }}"
                                                class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-danger"
                                                onclick="deleteTestimonial({{ $t->id }})">

                                                <i class="fa fa-trash"></i>

                                            </button>
                                        </td>
                                    </tr>
                                @empty

                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            No Testimonial Found
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

    function deleteTestimonial(id) {
        Swal.fire({
            title: 'Delete Testimonial?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete'
        })
            .then((result) => {

                if (result.isConfirmed) {

                    $.ajax({

                        url: "{{ url('admin/testimonials') }}/" + id,

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