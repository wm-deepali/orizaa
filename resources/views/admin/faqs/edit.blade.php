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
                        <a href="{{ route('admin.faqs.index') }}">Manage FAQ</a>
                    </li>

                    <li class="breadcrumb-item active">
                        Edit FAQ
                    </li>

                </ol>
            </div>

        </div>


        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">

                <div class="card-header">
                    <strong>Edit FAQ</strong>
                </div>

                <div class="card-body">

                    <form id="faqForm" method="POST" action="{{ route('admin.faqs.update', $faq->id) }}">

                        @csrf
                        @method('PUT')


                        <div class="form-group">

                            <label>Question *</label>

                            <input type="text" name="question" class="form-control" value="{{ $faq->question }}"
                                required>

                        </div>


                        <div class="form-group mt-3">

                            <label>Answer *</label>

                            <textarea name="answer" rows="5" class="form-control" required>{{ $faq->answer }}</textarea>

                        </div>


                        <div class="form-group mt-3">

                            <div class="custom-control custom-checkbox">

                                <input type="checkbox" name="show_home" id="show_home" class="custom-control-input" {{ $faq->show_home ? 'checked' : '' }}>

                                <label class="custom-control-label" for="show_home">
                                    Show on Home Page
                                </label>

                            </div>


                            <div class="custom-control custom-checkbox mt-2">

                                <input type="checkbox" name="status" id="status" class="custom-control-input" {{ $faq->status ? 'checked' : '' }}>

                                <label class="custom-control-label" for="status">
                                    Active
                                </label>

                            </div>

                        </div>


                        <div class="mt-4">

                            <button type="submit" id="saveBtn" class="btn btn-success">

                                <i class="fa-solid fa-save"></i>
                                Update FAQ

                            </button>

                            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">

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

    document.getElementById('faqForm').addEventListener('submit', function () {

        let btn = document.getElementById('saveBtn');

        btn.disabled = true;

        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Updating...';

    });

</script>