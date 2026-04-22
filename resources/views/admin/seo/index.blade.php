@include('admin.top-header')

<div class="main-section">

    @include('admin.header')

    <div class="app-content content container-fluid">

        {{-- BREADCRUMB --}}
        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Manage SEO
                    </li>
                </ol>
            </div>

        </div>

        <div class="content-wrapper pb-4">

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- TABLE --}}
            <div class="card">
                <div class="card-body">

                    <h5 class="mb-3">SEO Pages</h5>

                    <div class="table-responsive">

                        <table class="table table-striped table-hover">

                            <thead class="thead-light">
                                <tr>
                                    <th width="80">ID</th>
                                    <th>Page</th>
                                    <th>Meta Title</th>
                                    <th width="120">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($pages as $page)

                                    <tr>

                                        <td>{{ $page->id }}</td>

                                        <td>
                                            <strong>{{ $page->page_name }}</strong>
                                        </td>


                                        <td>{{ $page->meta_title }}</td>

                                        <td>

                                            <button class="btn btn-sm btn-outline-primary" onclick="openSeoModal(
                                                        {{ $page->id }},
                                                        '{{ $page->page_name }}',
                                                        '{{ $page->slug }}',
                                                        `{!! $page->meta_title !!}`,
                                                        `{!! $page->meta_description !!}`,
                                                        `{!! $page->scripts !!}`
                                                    )">
                                                <i class="fa fa-pencil"></i>
                                            </button>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No SEO Pages Found
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


{{-- ================= MODAL ================= --}}
<div class="modal fade" id="seoModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="seoForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit SEO</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">

                    {{-- SLUG --}}
                    <input type="hidden" name="slug" id="seo_slug" class="form-control">

                    {{-- META TITLE --}}
                    <div class="mb-3">
                        <label>Meta Title</label>
                        <input type="text" name="meta_title" id="seo_title" class="form-control">
                    </div>

                    {{-- META DESCRIPTION --}}
                    <div class="mb-3">
                        <label>Meta Description</label>
                        <textarea name="meta_description" id="seo_desc" class="form-control" rows="3"></textarea>
                    </div>

                    {{-- SCRIPTS (ONLY HOME) --}}
                    <div class="mb-3" id="scriptBox">
                        <label>Scripts (Only for Home Page)</label>
                        <textarea name="scripts" id="seo_scripts" class="form-control" rows="4"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-success">Update</button>
                </div>

            </form>

        </div>
    </div>
</div>


{{-- ================= SCRIPT ================= --}}
<script>

    function openSeoModal(id, name, slug, title, desc, scripts) {

        $('#seo_slug').val(slug);
        $('#seo_title').val(title);
        $('#seo_desc').val(desc);
        $('#seo_scripts').val(scripts);

        // dynamic action
        $('#seoForm').attr('action', '/admin/seo/' + id);

        // show scripts only for home
        if (name === 'Home') {
            $('#scriptBox').show();
        } else {
            $('#scriptBox').hide();
        }

        $('#seoModal').modal('show');
    }

</script>