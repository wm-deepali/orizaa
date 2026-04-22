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
                        Manage Home Page
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
                                    <th width="80">#</th>
                                    <th>Section Name</th>
                                    <th width="150">Type</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($sections as $index => $section)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td>
                                            <strong>{{ $section['title'] }}</strong>
                                        </td>

                                        <td>
                                            <span class="badge badge-info">
                                                {{ ucfirst($section['type']) }}
                                            </span>
                                        </td>

                                        <td>
                                            <a href="{{ $section['route'] }}" class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-pencil"></i> Manage
                                            </a>
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

</div>

@include('admin.footer')