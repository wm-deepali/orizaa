<!-- fixed-top-->
<div class="row d-none">
    <div class="col-10">

        @if(session('success'))
            <div class="alert alert-info alert-dismissible fade in">
                <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                <strong>Success!</strong> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade in">
                <a href="javascript:void(0);" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</div>

<!-- fixed-top-->

<div id='cssmenu'>
    <ul class="pt-0">

        {{-- DASHBOARD --}}
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
        </li>

        {{-- MASTERS --}}
        <li class="{{ request()->routeIs(
    'admin.categories.*',
    'admin.gifting-occasions.*',
    'admin.customizations.*',
    'admin.products.*',
    'admin.packages.*'
) ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-layer-group"></i> Masters
            </a>

            <ul>

                <li class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="fa-solid fa-folder"></i> Categories
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.gifting-occasions.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.gifting-occasions.index') }}">
                        <i class="fa-solid fa-gift"></i>Occasions
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.customizations.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.customizations.index') }}">
                        <i class="fa-solid fa-sliders"></i> Customizations
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}">
                        <i class="fa-solid fa-box"></i> Manage Products
                    </a>
                </li>
                <li class="{{ request()->routeIs('admin.vendor-types.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.vendor-types.index') }}">
                        <i class="fa-solid fa-building"></i> Vendor Types
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.packages.index') }}">
                        <i class="fa-solid fa-box-open"></i> Manage Packages
                    </a>
                </li>

            </ul>
        </li>

        {{-- CONTENT MANAGEMENT --}}
        <li class="{{ request()->routeIs(
    'admin.pages.*',
    'admin.home-page.*',
    'admin.home.*',
    'admin.faqs.*',
    'admin.blogs.*',
    'admin.brands.*',
    'admin.clients.*',
    'admin.testimonials.*',
    'admin.contact-branches.*',
    'admin.awards.*',
    'admin.teams.*',
    'admin.vendor-types.*',
    'admin.seo.*'
) ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-file-lines"></i> Content Management
            </a>

            <ul>

                

                <li class="{{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.announcements.index') }}">
                        <i class="fa-solid fa-bullhorn"></i> Announcement Bar
                    </a>
                </li>

 {{-- ✅ HOME PAGE --}}
                <li class="{{ request()->routeIs('admin.home-page.*', 'admin.home.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.home-page.index') }}">
                        <i class="fa-solid fa-house"></i> Manage Home Page
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.pages.index') }}">
                        <i class="fa-solid fa-file"></i> Dynamic Pages
                    </a>
                </li>

               <li class="{{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.brands.index') }}">
                        <i class="fa-solid fa-tags"></i> Manage Brands
                    </a>
                </li>
 <li class="{{ request()->routeIs('admin.contact-branches.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.contact-branches.index') }}">
                        <i class="fa-solid fa-location-dot"></i> Contact Branches
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.awards.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.awards.index') }}">
                        <i class="fa-solid fa-trophy"></i> Manage Awards
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.teams.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.teams.index') }}">
                        <i class="fa-solid fa-user-group"></i> Manage Team
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.faqs.index') }}">
                        <i class="fa-solid fa-circle-question"></i> Manage FAQ
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.blogs.index') }}">
                        <i class="fa-solid fa-blog"></i> Manage Blogs
                    </a>
                </li>

                
                <li class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.clients.index') }}">
                        <i class="fa-solid fa-users"></i> Manage Clients
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonials.index') }}">
                        <i class="fa-solid fa-comment-dots"></i> Manage Testimonials
                    </a>
                </li>

               

                

            </ul>
        </li>
        {{-- ENQUIRIES --}}
        <li class="{{ request()->routeIs(
    'admin.enquiries.*',
    'admin.contact-enquiries.*',
    'admin.home-enquiries.*',
    'admin.package-enquiries.*',
    'admin.vendor-enquiries.*',
    'admin.supplier-enquiries.*',
    'admin.other-enquiries.*'
) ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-envelope"></i> Enquiries
            </a>

            <ul>

                <li class="{{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.enquiries.index') }}">
                        <i class="fa-solid fa-cart-shopping"></i> Cart / Quote
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.contact-enquiries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.contact-enquiries.index') }}">
                        <i class="fa-solid fa-address-book"></i> Contact Enquiries
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.home-enquiries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.home-enquiries.index') }}">
                        <i class="fa-solid fa-house"></i> Home Enquiries
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.package-enquiries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.package-enquiries.index') }}">
                        <i class="fa-solid fa-box"></i> Package Enquiries
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.vendor-enquiries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.vendor-enquiries.index') }}">
                        <i class="fa-solid fa-building"></i> Vendor Enquiries
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.supplier-enquiries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.supplier-enquiries.index') }}">
                        <i class="fa-solid fa-truck"></i> Bulk Orders Enquiries
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.other-enquiries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.other-enquiries.index') }}">
                        <i class="fa-solid fa-ellipsis"></i> Other Enquiries
                    </a>
                </li>

            </ul>
        </li>



        {{-- Offline Inventories --}}
        <li class="{{ request()->routeIs(
    'admin.enquiries.*',
    'admin.contact-enquiries.*',
    'admin.home-enquiries.*',
    'admin.package-enquiries.*',
    'admin.vendor-enquiries.*',
    'admin.supplier-enquiries.*',
    'admin.other-enquiries.*'
) ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-envelope"></i> Offline Inventories
            </a>

            <ul>

                <li class="{{ request()->routeIs('admin.invoices.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.invoices.index') }}">
                        <i class="fa-solid fa-file-invoice"></i> Manage Invoices
                    </a>
                </li>

               

            </ul>
        </li>
        
        <li class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
    <a href="#">
        <i class="fa-solid fa-cart-shopping"></i> Orders & Customers
    </a>

    <ul>

  <li class="{{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
    <a href="{{ route('admin.customers.index') }}">
        <i class="fa-solid fa-users"></i> Customers
    </a>
</li>
        <li class="{{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
            <a href="{{ route('admin.orders.index') }}">
                <i class="fa-solid fa-list"></i> All Orders
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.orders.pending') ? 'active' : '' }}">
            <a href="{{ route('admin.orders.pending') }}">
                <i class="fa-solid fa-clock"></i> Pending Orders
            </a>
        </li>

        <li class="{{ request()->routeIs('admin.orders.paid') ? 'active' : '' }}">
            <a href="{{ route('admin.orders.paid') }}">
                <i class="fa-solid fa-circle-check"></i> Paid Orders
            </a>
        </li>

    </ul>
</li>


        {{-- Coupons & Setting--}}
        <li class="{{ request()->routeIs(
    'admin.enquiries.*',
    'admin.contact-enquiries.*',
    'admin.home-enquiries.*',
    'admin.package-enquiries.*',
    'admin.vendor-enquiries.*',
    'admin.supplier-enquiries.*',
    'admin.other-enquiries.*'
) ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-envelope"></i> Coupon & Settings
            </a>

            <ul>

                 {{-- COUPONS --}}
                <li class="{{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.coupons.index') }}">
                        <i class="fa-solid fa-ticket"></i> Manage Coupons
                    </a>
                </li>

                {{-- SETTINGS --}}
                <li class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings.index') }}">
                        <i class="fa-solid fa-gear"></i> Tax Settings
                    </a>
                </li>
                {{-- SEO Settings --}}
                <li class="{{ request()->routeIs('admin.seo.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.seo.index') }}">
                        <i class="fa-solid fa-magnifying-glass-chart"></i> Manage SEO
                    </a>
                </li>

               

            </ul>
        </li>

    </ul>
    
   
</div>