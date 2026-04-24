@include('admin.top-header')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<style>
  .stats-card {
    transition: 0.3s ease;
    cursor: pointer;
  }

  .stats-card:hover {
    transform: translateY(-5px);
  }

  .icon-box {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
  }

  .card-link {
    text-decoration: none;
    color: inherit;
  }
</style>

<div class="main-section">
  @include('admin.header')

  <div class="container-fluid">

    <!-- HEADER -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 p-4"
          style="background: linear-gradient(135deg, #e8f1ff, #f3e8ff, #fff1e6);">

          <h3 class="fw-bold mb-1 text-primary">
            Congratulations {{ auth()->user()->name }}
          </h3>

          <p class="text-muted mb-0">
            Here's what's happening with your business today 
          </p>

        </div>
      </div>
    </div>

  <div class="row">

  <!-- ================= TOP 4 ================= -->

  <!-- CATEGORIES -->
  <div class="col-md-3 mb-4">
    <a href="{{ route('admin.categories.index') }}" class="card-link">
      <div class="card stats-card shadow-sm rounded-4 p-3">
        <div class="d-flex align-items-center">
          <div class="icon-box bg-success text-white me-3">
            <i class="fa fa-folder"></i>
          </div>
          <div style="margin-left:10px;">
            <h6 class="mb-1">Categories</h6>
            <h4 class="fw-bold">{{ $data['categories'] }}</h4>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- PRODUCTS -->
  <div class="col-md-3 mb-4">
    <a href="{{ route('admin.products.index') }}" class="card-link">
      <div class="card stats-card shadow-sm rounded-4 p-3">
        <div class="d-flex align-items-center">
          <div class="icon-box bg-primary text-white me-3">
            <i class="fa fa-box"></i>
          </div>
          <div style="margin-left:10px;">
            <h6 class="mb-1">Products</h6>
            <h4 class="fw-bold">{{ $data['products'] }}</h4>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- PACKAGES -->
  <div class="col-md-3 mb-4">
    <a href="{{ route('admin.packages.index') }}" class="card-link">
      <div class="card stats-card shadow-sm rounded-4 p-3">
        <div class="d-flex align-items-center">
          <div class="icon-box bg-warning text-white me-3">
            <i class="fa fa-box-open"></i>
          </div>
          <div style="margin-left:10px;">
            <h6 class="mb-1">Packages</h6>
            <h4 class="fw-bold">{{ $data['packages'] }}</h4>
          </div>
        </div>
      </div>
    </a>
  </div>

  <!-- CLIENT -->
  <div class="col-md-3 mb-4">
    <a href="{{ route('admin.clients.index') }}" class="card-link">
      <div class="card stats-card shadow-sm rounded-4 p-3">
        <div class="d-flex align-items-center">
          <div class="icon-box bg-dark text-white me-3">
            <i class="fa fa-users"></i>
          </div>
          <div style="margin-left:10px;">
            <h6 class="mb-1">Clients</h6>
            <h4 class="fw-bold">{{ $data['clients'] }}</h4>
          </div>
        </div>
      </div>
    </a>
  </div>

</div>

<div class="row">

  <!-- ================= BOTTOM 4 ================= -->

  <!-- TODAY -->
  <div class="col-md-3 mb-4">
    <div class="card stats-card shadow-sm rounded-4 p-3">
      <div class="d-flex align-items-center">
        <div class="icon-box bg-info text-white me-3">
          <i class="fa fa-calendar-day"></i>
        </div>
        <div style="margin-left:10px;">
          <h6 class="mb-1">Today's Enquiry</h6>
          <h4 class="fw-bold">{{ $data['todayEnquiries'] }}</h4>
        </div>
      </div>
    </div>
  </div>

  <!-- TOTAL -->
  <div class="col-md-3 mb-4">
    <a href="{{ route('admin.enquiries.index') }}" class="card-link">
      <div class="card stats-card shadow-sm rounded-4 p-3">
        <div class="d-flex align-items-center">
          <div class="icon-box bg-danger text-white me-3">
            <i class="fa fa-envelope"></i>
          </div>
          <div style="margin-left:10px;">
            <h6 class="mb-1">Total Enquiries</h6>
            <h4 class="fw-bold">{{ $data['totalEnquiries'] }}</h4>
          </div>
        </div>
      </div>
    </a>
  </div>

 

  <!-- VENDOR -->
  <div class="col-md-3 mb-4">
    <a href="{{ route('admin.vendor-enquiries.index') }}" class="card-link">
      <div class="card stats-card shadow-sm rounded-4 p-3">
        <div class="d-flex align-items-center">
          <div class="icon-box bg-secondary text-white me-3">
            <i class="fa fa-truck"></i>
          </div>
          <div style="margin-left:10px;">
            <h6 class="mb-1">Vendors Enquiry</h6>
            <h4 class="fw-bold">{{ $data['vendorEnquiries'] }}</h4>
          </div>
        </div>
      </div>
    </a>
  </div>

</div>

    <!-- ================= LATEST ENQUIRIES ================= -->
   <div class="card shadow-sm rounded-4 mt-4">
  <div class="card-body">

    <h5 class="mb-3">Latest Enquiries</h5>

    <!-- TABS -->
    <ul class="nav nav-tabs mb-3">

    
      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#general">
          General
        </button>
      </li>

      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#contact">
          Contact
        </button>
      </li>

      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#home">
          Home
        </button>
      </li>

      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#package">
          Package
        </button>
      </li>

      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#vendor">
          Vendor
        </button>
      </li>

      <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#supplier">
          Supplier
        </button>
      </li>

    </ul>

    <!-- TAB CONTENT -->
    <div class="tab-content">


      <!-- GENERAL -->
      <div class="tab-pane fade" id="general">
        @include('admin.dashboard.table', [
    'items' => $latestGeneralEnquiries,
    'route' => 'admin.other-enquirie'
])
      </div>

      <!-- CONTACT -->
      <div class="tab-pane fade" id="contact">
       @include('admin.dashboard.table', [
    'items' => $latestContactEnquiries,
    'route' => 'admin.contact-enquiries'
])
      </div>

      <!-- HOME -->
      <div class="tab-pane fade" id="home">
        @include('admin.dashboard.table', [
    'items' => $latestHomeEnquiries,
    'route' => 'admin.home-enquiries'
])
      </div>

      <!-- PACKAGE -->
      <div class="tab-pane fade" id="package">
      @include('admin.dashboard.table', [
    'items' => $latestPackageEnquiries,
    'route' => 'admin.package-enquiries'
])

      </div>

      <!-- VENDOR -->
      <div class="tab-pane fade" id="vendor">
        @include('admin.dashboard.table', [
    'items' => $latestVendorEnquiries,
    'route' => 'admin.vendor-enquiries'
])
      </div>

      <!-- SUPPLIER -->
      <div class="tab-pane fade" id="supplier">
       @include('admin.dashboard.table', [
    'items' => $latestSupplierEnquiries,
    'route' => 'admin.supplier-enquiries'
])
      </div>

    </div>

  </div>
</div>

    @include('admin.footer')
  </div>
</div>


<script>

function deleteEnquiry(id, route) {

    Swal.fire({
        title: 'Delete Enquiry?',
        text: "This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: `/admin/${route.split('.').pop()}/${id}`,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (res) {

                    Swal.fire('Deleted!', res.message, 'success');

                    $("#row" + id).fadeOut(400, function () {
                        $(this).remove();
                    });

                },
                error: function () {
                    Swal.fire('Error', 'Something went wrong', 'error');
                }
            });

        }

    });
}

</script>