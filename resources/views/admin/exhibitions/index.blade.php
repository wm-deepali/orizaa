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
                        Exhibitions & Showcases
                    </li>

                </ol>
            </div>

            <div class="ml-auto mr-2">
                <a href="{{ route('admin.exhibitions.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Exhibition
                </a>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            <div class="card">
                <div class="card-body">

                    <table class="table table-striped">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($exhibitions as $item)
                                <tr id="row{{ $item->id }}">
                                    <td>{{ $item->id }}</td>

                                    <td>
                                        @if($item->image)
                                            <img src="{{ asset('storage/'.$item->image) }}" width="60">
                                        @endif
                                    </td>

                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->venue }}</td>
                                    <td>{{ $item->from_date }} - {{ $item->to_date }}</td>

                                    <td>
                                        @if($item->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </td>

                                    <td>

                                        <a href="{{ route('admin.exhibitions.edit', $item->id) }}"
                                            class="btn btn-sm btn-dark">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <a href="{{ route('admin.exhibitions.gallery', $item->id) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fa fa-image"></i>
                                        </a>

                                        <button class="btn btn-sm btn-danger"
                                            onclick="deleteItem({{ $item->id }})">
                                            <i class="fa fa-trash"></i>
                                        </button>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>

        </div>

    </div>

</div>

@include('admin.footer')

<script>
function deleteItem(id){
    if(confirm('Delete this exhibition?')){
        $.ajax({
            url: "{{ url('admin/exhibitions') }}/"+id,
            type: "DELETE",
            data: {_token:"{{ csrf_token() }}"},
            success: function(res){
                $("#row"+id).remove();
            }
        });
    }
}
</script>