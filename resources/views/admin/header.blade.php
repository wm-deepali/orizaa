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

<div id='cssmenu'>
    <ul class="pt-0">

        {{-- DASHBOARD --}}
        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}">
                <i class="fa-solid fa-gauge"></i> Dashboard
            </a>
        </li>

        {{-- MASTERS --}}
        <li
            class="{{ request()->routeIs('admin.categories.*', 'admin.gifting-occasions.*', 'admin.customizations.*', 'admin.products.*') ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-layer-group"></i> Masters
            </a>

            <ul>

                <li class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        Categories
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.gifting-occasions.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.gifting-occasions.index') }}">
                        Gifting Occasions
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.customizations.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.customizations.index') }}">
                        Customizations
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.products.index') }}">
                        Manage Products
                    </a>
                </li>
                <li class="{{ request()->is('admin/packages*') ? 'active' : '' }}">
                    <a href="{{ route('admin.packages.index') }}">
                        Manage Packages
                    </a>
                </li>

            </ul>
        </li>

        {{-- CONTENT MANAGEMENT --}}
        <li class="{{ request()->routeIs(
    'admin.pages.*',
    'admin.faqs.*',
    'admin.blogs.*',
    'admin.brands.*',
    'admin.clients.*',
    'admin.testimonials.*',
    'admin.contact-branches.*',
    'admin.awards.*',
    'admin.teams.*'
) ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-file-lines"></i> Content Management
            </a>

            <ul>

                <li class="{{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.pages.index') }}">
                        Dynamic Pages
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.faqs.index') }}">
                        Manage FAQ
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.blogs.index') }}">
                        Manage Blogs
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.brands.index') }}">
                        Manage Brands
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.clients.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.clients.index') }}">
                        Manage Clients
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonials.index') }}">
                        Manage Testimonials
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.contact-branches.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.contact-branches.index') }}">
                        Manage Contact Branches
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.awards.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.awards.index') }}">
                        Manage Awards
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.teams.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.teams.index') }}">
                        Manage Team
                    </a>
                </li>

            </ul>
        </li>

        <li class="{{ request()->routeIs('admin.enquiries.*', 'admin.contact-enquiries.*') ? 'active' : '' }}">
            <a href="#">
                <i class="fa-solid fa-envelope"></i> Enquiries
            </a>

            <ul>
                <li class="{{ request()->routeIs('admin.enquiries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.enquiries.index') }}">
                        Cart / Quote Enquiries
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.contact-enquiries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.contact-enquiries.index') }}">
                        Contact Enquiries
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.home-enquiries.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.home-enquiries.index') }}">
                        Home Enquiries
                    </a>
                </li>

            </ul>
        </li>

    </ul>
</div>