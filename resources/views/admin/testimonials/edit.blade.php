@include('admin.top-header')

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index') }}">Testimonials</a></li>
                <li class="breadcrumb-item active">Edit Testimonial</li>
            </ol>
        </div>

        <div class="card">
            <div class="card-header"><strong>Edit Testimonial</strong></div>

            <div class="card-body">

                <form method="POST" action="{{ route('admin.testimonials.update', $testimonial->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6">
                            <label>Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="text" {{ $testimonial->type == 'text' ? 'selected' : '' }}>Text</option>
                                <option value="reel" {{ $testimonial->type == 'reel' ? 'selected' : '' }}>Reel</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $testimonial->name }}" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ $testimonial->status ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ !$testimonial->status ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                    </div>

                    <div class="row mt-3">

                        <div class="col-md-6">
                            <label>Feedback</label>
                            <textarea name="feedback" class="form-control">{{ $testimonial->feedback }}</textarea>
                        </div>

                        <div class="col-md-6" id="ratingDiv">
                            <label>Rating</label>
                            <select name="rating" class="form-control">
                                <option value="">Select</option>
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ $testimonial->rating == $i ? 'selected' : '' }}>{{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control">

                            @if($testimonial->photo)
                                <div class="mt-2">
                                    <img src="{{ asset('uploads/testimonials/' . $testimonial->photo) }}" width="80"
                                        style="border-radius:6px;">
                                </div>
                            @endif
                        </div>

                    </div>

                    <div id="reelDiv" class="mt-3">

                        <div class="form-group row">

                            {{-- REEL FILE --}}
                            <div class="col-sm-6">
                                <label>Reel File</label>
                                <input type="file" name="reel_file" class="form-control">

                                @if($testimonial->reel_file)
                                    <div class="mt-2">
                                        <video width="150" controls>
                                            <source src="{{ asset('uploads/testimonials/' . $testimonial->reel_file) }}">
                                        </video>
                                    </div>
                                @endif
                            </div>

                            {{-- REEL URL --}}
                            <div class="col-sm-6">
                                <label>Reel URL</label>
                                <input type="text" name="reel_url" value="{{ $testimonial->reel_url }}"
                                    class="form-control">

                                @if($testimonial->reel_url)
                                    <div class="mt-2">
                                        <a href="{{ $testimonial->reel_url }}" target="_blank" class="btn btn-sm btn-info">
                                            View Reel
                                        </a>
                                    </div>
                                @endif
                            </div>

                        </div>

                    </div>

                    <div class="mt-4">

                                <button type="submit" id="saveBtn" class="btn btn-success">

                                    <i class="fa-solid fa-save"></i>
                                    Update Testimonial

                                </button>


                                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">

                                    Cancel

                                </a>

                            </div>


                </form>

            </div>
        </div>

    </div>
</div>

@include('admin.footer')

<script>
    function toggle() {
        let type = $('#type').val();
        if (type == 'reel') {
            $('#reelDiv').show();
            $('#ratingDiv').hide();
        } else {
            $('#reelDiv').hide();
            $('#ratingDiv').show();
        }
    }
    toggle();
    $('#type').change(toggle);
</script>