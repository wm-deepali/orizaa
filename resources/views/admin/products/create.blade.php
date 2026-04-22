@include('admin.top-header')

<style>
    /* GLOBAL */
    .card {
        border-radius: 14px;
        border: none;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .card h5 {
        font-weight: 600;
        margin-bottom: 15px;
        color: #111827;
    }

    /* HEADER */
    .card-header {
        background: #fff;
        font-size: 20px;
        font-weight: 600;
        border-bottom: 1px solid #eee;
    }

    /* FORM */
    label {
        font-weight: 500;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px 12px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
    }

    .form-control:focus {
        background: #fff;
        border-color: #f97316;
        box-shadow: none;
    }

    /* CHECKBOX */
    input[type="checkbox"] {
        margin-right: 6px;
    }

    /* SECTION SPACING */
    .card.p-3 {
        padding: 20px !important;
    }

    /* CATEGORY SCROLL */
    .category-scroll {
        max-height: 300px;
        overflow-y: auto;
        padding-right: 10px;
    }

    /* SUBCATEGORY */
    .subcategory-box {
        padding-left: 20px;
        margin-top: 5px;
    }

    /* GRID SPACING */
    .row>div {
        margin-bottom: 12px;
    }

    /* RIGHT SIDEBAR */
    .right-sticky {
        position: sticky;
        top: 20px;
    }

    /* BUTTON */
    .btn-success {
        background: linear-gradient(90deg, #f97316, #fb923c);
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 500;
    }

    .btn-success:hover {
        opacity: 0.9;
    }

    /* SMALL BUTTON */
    .btn-sm {
        border-radius: 8px;
    }

    /* CHECKBOX GRID */
    .checkbox-grid label {
        display: block;
        margin-bottom: 6px;
    }

    /* CUSTOMIZATION BOX */
    .custom-box {
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 10px;
        transition: 0.2s;
    }

    .custom-box:hover {
        border-color: #f97316;
        background: #fff7ed;
    }

    /* TEXTAREA */
    textarea.form-control {
        min-height: 90px;
    }

    .flag-group {
        background: #f9fafb;
        border: 1px solid #eee;
        border-radius: 10px;
        padding: 10px 12px;
        /* reduced from 15px */
    }

    .flag-title {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 6px;
        /* reduced */
        text-transform: uppercase;
    }

    .flag-item {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 4px 6px;
        /* reduced */
        border-radius: 6px;
        cursor: pointer;
        transition: 0.2s;
        font-size: 13px;
        margin-bottom: 2px;
        /* reduce vertical gap */
    }

    .flag-item:hover {
        background: #fff7ed;
    }

    .flag-item input[type="checkbox"] {
        accent-color: #f97316;
        transform: scale(1);
    }

    .occasion-box {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #f9fafb;
        cursor: pointer;
        transition: 0.2s;
        font-size: 14px;
    }

    .occasion-box:hover {
        background: #fff7ed;
        border-color: #f97316;
    }

    .occasion-box input[type="checkbox"] {
        accent-color: #f97316;
        transform: scale(1.1);
        cursor: pointer;
    }

    /* Optional: active feel when checked */
    .occasion-box input[type="checkbox"]:checked+span {
        font-weight: 500;
        color: #f97316;
    }

    /* tumhara existing CSS */

    select.form-control {
        height: 45px;
        padding: 10px 12px;
    }

    .flag-item input[type="checkbox"] {
        accent-color: #f97316;
        cursor: pointer;
    }

    /* TITLE SPACING */
    h5 b {
        font-weight: 600;
    }

    /* CATEGORY CARD */
.category-card {
    border: 1px solid #eee;
    border-radius: 10px;
    padding: 10px 12px;
    margin-bottom: 10px;
    background: #fff;
    transition: 0.2s;
}

.category-card:hover {
    border-color: #f97316;
    background: #fff7ed;
}

/* CATEGORY ITEM */
.category-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
    cursor: pointer;
}

/* CATEGORY NAME */
.cat-name {
    font-size: 14px;
}

/* SUBCATEGORY BOX */
.subcategory-box {
    margin-top: 8px;
    padding-left: 20px;
    display: none;
}

/* SUBCATEGORY ITEM */
.subcategory-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    margin-bottom: 4px;
    cursor: pointer;
}

/* CHECKBOX COLOR */
.category-item input,
.subcategory-item input {
    accent-color: #f97316;
}
</style>

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="card shadow-sm">
            <div class="card-header"><b>Add Product</b></div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">

                        <!-- LEFT -->
                        <div class="col-md-8">

                            {{-- CATEGORY --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Category & Sub Category</b></h5>

                             <div class="category-scroll">

    @foreach($categories as $cat)
        <div class="category-card">

            <!-- CATEGORY -->
            <label class="category-item">
                <input type="checkbox"
                       class="category-checkbox"
                       data-id="{{ $cat->id }}"
                       name="categories[]"
                       value="{{ $cat->id }}">

                <span class="cat-name">{{ $cat->name }}</span>
            </label>

            <!-- SUBCATEGORY -->
            <div class="subcategory-box" id="subcat_{{ $cat->id }}">
                @foreach($cat->children as $sub)
                    <label class="subcategory-item">
                        <input type="checkbox"
                               name="sub_categories[]"
                               value="{{ $sub->id }}">

                        <span>{{ $sub->name }}</span>
                    </label>
                @endforeach
            </div>

        </div>
    @endforeach

</div>
                            </div>

                            {{-- BASIC --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Basic Info</b></h5>

                                <label>Name *</label>
                                <input type="text" name="name" id="name" class="form-control">

                                <label class="mt-2">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control">

                                <label class="mt-2">Brand</label>
                                <select name="brand_id" class="form-control">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        @if($brand->status)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                                <label class="mt-2">Image</label>
                                <input type="file" name="image" class="form-control">

                                <label class="mt-2">Sub Title</label>
                                <input type="text" name="sub_title" class="form-control">

                                <label class="mt-2">Summary</label>
                                <textarea name="summary" class="form-control"></textarea>
                            </div>

                            {{-- SKU --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Inventory</b></h5>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>SKU</label>
                                        <input type="text" name="sku" class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label>Min Qty</label>
                                        <input type="number" name="min_qty" class="form-control">
                                    </div>
                                </div>

                                <label class="mt-2">Delivery Time</label>
                                <input type="text" name="delivery_time" class="form-control">

                                <div class="mt-3">
                                    <div class="row">

                                        <div class="col-md-6 mb-2">
                                            <label class="occasion-box">
                                                <input type="checkbox" name="quality">
                                                <span>Quality Assurance</span>
                                            </label>
                                        </div>

                                        <div class="col-md-6 mb-2">
                                            <label class="occasion-box">
                                                <input type="checkbox" name="pan_india">
                                                <span>PAN India Delivery</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- PRICING --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Pricing</b></h5>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label>MRP</label>
                                        <input type="number" name="mrp" id="mrp" class="form-control">
                                    </div>

                                    <div class="col-md-4">
                                        <label>Discount Type</label>
                                        <select name="discount_type" id="discount_type" class="form-control">
                                            <option value="amount">Amount</option>
                                            <option value="percentage">%</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Discount</label>
                                        <input type="number" name="discount" id="discount" class="form-control">
                                    </div>
                                </div>

                                <label class="mt-2">Final Price</label>
                                <input type="text" name="price" id="price" readonly class="form-control">
                            </div>

                            {{-- FLAGS --}}
                            <div class="card p-3 mb-3">
                                <h5 class="mb-3"><b>Product Flags</b></h5>

                                <div class="row">

                                    <!-- LEFT GROUP -->
                                    <div class="col-md-6">
                                        <div class="flag-group">
                                            <p class="flag-title">Marketing</p>

                                            <label class="flag-item">
                                                <input type="checkbox" name="featured"> Featured Products
                                            </label>

                                            <label class="flag-item">
                                                <input type="checkbox" name="new_arrival"> New Arrivals
                                            </label>

                                            <label class="flag-item">
                                                <input type="checkbox" name="sale"> Sale
                                            </label>

                                            <label class="flag-item">
                                                <input type="checkbox" name="best_seller"> Best Sellers
                                            </label>
                                        </div>
                                    </div>

                                    <!-- RIGHT GROUP -->
                                    <div class="col-md-6">
                                        <div class="flag-group">
                                            <p class="flag-title">Availability</p>

                                            <label class="flag-item">
                                                <input type="checkbox" name="ready_to_ship"> Ready to Ship
                                            </label>

                                            <label class="flag-item">
                                                <input type="checkbox" name="bulk_available"> Bulk Orders
                                            </label>

                                            <label class="flag-item">
                                                <input type="checkbox" name="gift_hamper"> Gift Hamper
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <!-- EXTRA FLAGS -->
                                <div class="flag-group mt-3">
                                    <p class="flag-title">Other Settings</p>

                                    <label class="flag-item">
                                        <input type="checkbox" name="is_premium"> Premium Products
                                    </label>

                                    <label class="flag-item">
                                        <input type="checkbox" name="is_engraving"> Engravings
                                    </label>

                                    <label class="flag-item">
                                        <input type="checkbox" name="is_personalized_engraving">
                                        Personalized Engraving
                                    </label>

                                    <label class="flag-item">
                                        <input type="checkbox" name="show_on_website" checked> Show on Website
                                    </label>
                                </div>
                            </div>

                            {{-- CUSTOMIZATION --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Customization</b></h5>

                                <div class="row">
                                    @foreach($customizations as $c)
                                        <div class="col-md-6 mb-2">
                                            <label class="custom-box w-100">
                                                <input type="checkbox" name="customizations[]" value="{{ $c->id }}">
                                                {{ $c->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- INCLUSIONS --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Inclusions</b></h5>

                                <div id="incWrap">
                                    <input type="text" name="inclusions[]" class="form-control mb-2">
                                </div>

                                <button type="button" onclick="addInc()" class="btn btn-sm btn-primary">Add
                                    More</button>
                            </div>

                            {{-- DETAILS --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Content</b></h5>

                                <label>Details</label>
                                <textarea name="details" id="details" class="form-control"></textarea>

                                <label class="mt-2">Delivery & Returns</label>
                                <textarea name="delivery_returns" id="delivery_returns" class="form-control"></textarea>
                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="col-md-4 right-sticky">

                            {{-- OCCASIONS --}}
                            <div class="card p-3 mb-3">
                                <h5 class="mb-3"><b>Occasions (Suitable for)</b></h5>

                                <div class="row">
                                    @foreach($occasions as $o)
                                        <div class="col-12 mb-2">
                                            <label class="occasion-box">
                                                <input type="checkbox" name="occasions[]" value="{{ $o->id }}">
                                                <span>{{ $o->title }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- ADVANCED --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Advanced</b></h5>

                                <label>Product Code</label>
                                <input type="text" name="product_code" class="form-control">

                                <label class="mt-2">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control">

                                <label class="mt-2">Added By</label>
                                <input type="text" name="added_by" class="form-control">
                            </div>

                            {{-- SEO --}}
                            <div class="card p-3 mb-3">
                                <h5><b>SEO</b></h5>

                                <label>Meta Title</label>
                                <input type="text" name="meta_title" class="form-control">

                                <label class="mt-2">Meta Description</label>
                                <textarea name="meta_description" class="form-control"></textarea>
                            </div>

                            {{-- BUTTONS --}}
                            <div class="card p-3 mb-3">
                                <h5><b>Actions</b></h5>

                                <label><input type="checkbox" name="cart" checked> Add to Cart</label><br>
                                <label><input type="checkbox" name="whatsapp"> WhatsApp</label><br>
                                <label><input type="checkbox" name="call"> Call</label>
                            </div>

                            <div class="card p-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                        </div>

                    </div>

                    <button class="btn btn-success mt-3">Save Product</button>

                </form>
            </div>
        </div>

    </div>
</div>

@include('admin.footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.config.versionCheck = false;
    CKEDITOR.replace('details');
    CKEDITOR.replace('delivery_returns');

    $('#name').keyup(function () {
        $('#slug').val($(this).val().toLowerCase().replace(/ /g, '-'));
    });

    $('#mrp,#discount,#discount_type').on('keyup change', function () {
        let m = +$('#mrp').val() || 0;
        let d = +$('#discount').val() || 0;
        let t = $('#discount_type').val();

        let p = t == 'percentage' ? m - (m * d / 100) : m - d;
        if (p < 0) p = 0;

        $('#price').val(p.toFixed(2));
    });

    function addInc() {
        $('#incWrap').append('<input type="text" name="inclusions[]" class="form-control mb-2">');
    }
    
    $('.category-checkbox').on('change', function () {
    let id = $(this).data('id');

    if ($(this).is(':checked')) {
        $('#subcat_' + id).slideDown();
    } else {
        $('#subcat_' + id).slideUp();
        $('#subcat_' + id).find('input').prop('checked', false);
    }
});
</script>