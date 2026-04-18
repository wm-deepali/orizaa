@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">
            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
                    <li class="breadcrumb-item active">Add Testimonial</li>
                </ol>
            </div>
        </div>

        <div class="content-wrapper pb-4">

            <div class="card shadow-sm">
                <div class="card-header"><strong>Add Testimonial</strong></div>

                <div class="card-body">

                    <form method="POST" action="{{ route('admin.testimonials.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-body">

                            <div class="form-group row">

                                <div class="col-sm-6">
                                    <label>Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="text">Text</option>
                                        <option value="reel">Reel</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control">
                                </div>

                                <div class="col-sm-6">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-sm-6">
                                    <label>Feedback</label>
                                    <textarea name="feedback" class="form-control"></textarea>
                                </div>

                                <div class="col-sm-6" id="ratingDiv">
                                    <label>Rating</label>
                                    <select name="rating" class="form-control">
                                        <option value="">Select</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>

                                <div class="col-sm-6">
                                    <label>Photo</label>
                                    <input type="file" name="photo" class="form-control">
                                </div>

                            </div>

                            <div id="reelDiv" style="display:none;">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Reel File</label>
                                        <input type="file" name="reel_file" class="form-control">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Reel URL</label>
                                        <input type="text" name="reel_url" class="form-control">
                                    </div>
                                </div>
                            </div>

                    
                            <div class="mt-4">

                                <button type="submit" id="saveBtn" class="btn btn-success">

                                    <i class="fa-solid fa-save"></i>
                                    Save Testimonial

                                </button>


                                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">

                                    Cancel

                                </a>

                            </div>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    @include('admin.footer')

    <script>
        $('#type').change(function () {
            let type = $(this).val();

            if (type == 'reel') {
                $('#reelDiv').show();
                $('#ratingDiv').hide();
            } else {
                $('#reelDiv').hide();
                $('#ratingDiv').show();
            }
        });
    </script>