@include('admin.top-header')

<style>
  .stats-card {
    transition: 0.3s ease;
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
</style>

<div class="main-section">
  @include('admin.header')

  <div class="container-fluid">

    <!-- Content Start -->
    <div class="row">

      <!-- Congratulations Card -->
      <div class="col-12 mb-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden"
          style="background: linear-gradient(135deg, #e8f1ff, #f3e8ff, #fff1e6);">

          <div class="card-body p-4">
            <div class="row align-items-center">

              <div class="col-md-8">
                <h3 class="fw-bold mb-2" style="color:#1e3a8a;">
                  Congratulations {{ auth()->user()->name }}
                </h3>

               
                
              </div>

             

            </div>
          </div>

        </div>
      </div>
    
    </div>

    <!-- Table Ends -->
    @include('admin.footer')
  </div>
</div>