<style>
    .nav-header-scroll {
        overflow-x: auto;
    }

    .popular-tag {
        position: relative;
        left: -20px;
        top: -20px;
    }

    .nav-header-scroll::-webkit-scrollbar {
        display: none;
    }

    /* Vertical Separator Styling */
    .nav-link+.h-6 {
        background-color: #e5e7eb;
        margin: 0 8px;
    }

    /* Optional: Hover pe line ka color change */
    .group-hover+.h-6 {
        background-color: #f4a261;
    }


    @media (max-width: 768px) {
        .mobile-nav-section {
            display: none;
        }
    }
   .nav-bottom-bordercolor .nav-link1:hover{
    border-bottom: 3px solid #b38c30 !important;
}

</style>
<!-- TOP ANNOUNCEMENT BAR -->
<div id="announcement"
    class="bg-[#1d1d1d] text-[#cfa425] px-2 py-3 text-center text-sm font-medium flex items-center justify-center gap-3 shadow-md">

    <span><i class="fa-solid fa-gift text-lg"></i> Corporate Season Special: 20% OFF on bulk orders above <i
            class="fa-solid fa-indian-rupee-sign"></i>25,000 | Code: CORP20</span>
    <button onclick="document.getElementById('announcement').style.display='none'"
        class="ml-4 text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white rounded"><i
            class="fa-solid fa-x"></i></button>
</div>

<!-- STICKY HEADER (only logo + search + icons) -->
<!--<header class="sticky-header">-->
<!--    <div class="max-w-7xl mx-auto px-6">-->
<!--        <div class="flex items-center justify-between py-3">-->
<!-- LOGO -->
<!--            <div class="flex items-center gap-3">-->
<!--                <a href="{{'/'}}">-->
<!--                <img src="{{ asset('images/B2B_logo.png') }}" alt="B2B Gifts India" class="h-20 md:h-20 w-auto object-contain">-->
<!--                </a>-->
<!--                <div class="font-bold text-2xl tracking-tight">-->
<!--<span class="text-[#f4a261]">B2B </span><span class="text-[#cfa425]">Gifts </span><span-->
<!--    class="text-[#e07a5f]">India</span>-->
<!--                </div>-->
<!--            </div>-->

<!-- SEARCH -->
<!--            <div class="flex-1 max-w-2xl mx-10">-->
<!--                <div class="relative">-->

<!-- INPUT -->
<!--                    <input type="text" id="searchInput"-->
<!--                        placeholder="Search corporate gifts, executive diaries, branded bottles..."-->
<!--                        class="w-full bg-gray-50 border border-gray-200 focus:border-[#cfa425]  rounded-full py-3.5 px-6 focus:outline-none shadow-sm"-->
<!--                         autocomplete="off"-->
<!--                        tabindex="0">-->

<!-- SEARCH ICON -->
<!--                    <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#cfa425] focus:outline-none">-->
<!--                        <i class="fa-solid fa-magnifying-glass text-lg"></i>-->
<!--                    </button>-->

<!-- ðŸ”¥ SUGGESTIONS DROPDOWN -->
<!--                    <div id="searchSuggestions"-->
<!--                        class="absolute left-0 w-full bg-white border border-gray-200 rounded-xl mt-2 shadow-lg hidden z-50 max-h-80 overflow-y-auto">-->
<!--                    </div>-->

<!--                </div>-->
<!--            </div>-->

<!-- ICONS -->
<!--            <div class="flex items-center gap-8 text-xl">-->
<!--                <i class="fa-regular fa-heart hover:text-[#e07a5f] cursor-pointer transition-colors"></i>-->
<!--                <div class="relative cursor-pointer">-->
<!--                    <a href="{{ route('shopping-cart') }}" class="relative cursor-pointer">-->
<!--                        <i class="fa-solid fa-cart-shopping hover:text-[#cfa425] transition-colors"></i>-->

<!--                        <span id="cart-count"-->
<!--                            class="absolute -top-2 -right-2 bg-[#e07a5f] text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">-->
<!--                            {{ $globalCartCount }}-->
<!--                        </span>-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</header>-->
<header class="sticky-header bg-white">
    <div class="max-w-7xl mx-auto px-4 md:px-6">
        <div class="flex items-center justify-between py-3">

            <!-- LEFT: LOGO -->
            <div class="flex items-center gap-3">
                <a href="/">
                    <img src="{{ asset('images/oriza-logo1.jpeg') }}" class="h-14 md:h-20 w-auto rounded object-contain">
                </a>
            </div>

            <!-- DESKTOP SEARCH -->
            <div class="hidden md:flex flex-1 max-w-2xl mx-10 ">
                <div class="flex-1 max-w-2xl mx-10">
                    <div class="relative">

                        <!-- INPUT -->
                        <input type="text" id="searchInput"
    placeholder="Search corporate gifts, executive diaries, branded bottles..."
    class="w-full bg-gray-50 border border-[#b38c30] focus:border-[#b38c30] rounded-full py-3.5 px-6 focus:outline-none shadow-sm"
    autocomplete="off" tabindex="0">



                        <button type="button"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-[#cfa425] focus:outline-none">
                            <i class="fa-solid fa-magnifying-glass text-lg"></i>
                        </button>


                        <div id="searchSuggestions"
                            class="absolute left-0 w-full bg-white border border-gray-200 rounded-xl mt-2 shadow-lg hidden z-50 max-h-80 overflow-y-auto">
                        </div>

                    </div>
                </div>


                <!--<div class="relative">-->
                <!--<input type="text"-->
                <!--    placeholder="Search corporate gifts, executive diaries, branded bottles..."-->
                <!--    class="w-full bg-gray-50 border border-gray-200 focus:border-[#cfa425]  rounded-full py-3.5 px-6 focus:outline-none shadow-sm">-->

                <!--    <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#cfa425] focus:outline-none">-->
                <!--        <i class="fa-solid fa-magnifying-glass text-lg"></i>-->
                <!--    </button>-->


                <!--    <div id="searchSuggestions"-->
                <!--        class="absolute left-0 w-full bg-white border border-gray-200 rounded-xl mt-2 shadow-lg hidden z-50 max-h-80 overflow-y-auto">-->
                <!--    </div>-->
                <!--    </div>-->
            </div>

            <!-- RIGHT ICONS -->
            <div class="flex items-center gap-5 text-xl">

                <!-- MOBILE SEARCH ICON -->
                <i onclick="toggleSearch()" class="fa-solid fa-magnifying-glass md:hidden cursor-pointer"></i>

                <!-- Wishlist -->
                <i class="fa-regular fa-heart cursor-pointer"></i>

                <!-- Cart -->
                <div class="relative">
                    <i class="fa-solid fa-cart-shopping cursor-pointer"></i>
                    <span
                        class="absolute -top-2 -right-2 bg-[#e07a5f] text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                        {{ $globalCartCount }}
                    </span>
                </div>

                <!-- MENU ICON (mobile only) -->
                <i onclick="toggleMenu()" class="fa-solid fa-bars md:hidden cursor-pointer"></i>

            </div>
        </div>
    </div>

    <!-- 🔍 MOBILE SEARCH BAR -->
    <div id="mobileSearch" class="hidden px-4 pb-3 md:hidden">
        <input type="text" placeholder="Search products..."
            class="w-full bg-gray-50 border border-gray-200 rounded-full py-3 px-5">
    </div>

</header>
<!-- Overlay -->
<script>
    function toggleSearch() {
        document.getElementById('mobileSearch').classList.toggle('hidden');
    }

    function toggleMenu() {
        const drawer = document.getElementById('drawer');
        const overlay = document.getElementById('overlay');

        drawer.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    }
</script>


<!-- Drawer -->
<div id="drawer"
    class="fixed top-0 left-0 w-72 h-full bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50">

    <div class="p-5 font-bold text-lg border-b">
        Menu
    </div>

    <ul class="p-5 space-y-4">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('category') }}">Categories</a></li>
        <li><a href="#">Orders</a></li>
        <li><a href="{{ route('contact-us') }}">Contact</a></li>
    </ul>
</div>


<!-- Professional Corporate Navigation â€“ Single row + "More" dropdown -->
<nav class="mobile-nav-section bg-white border-b border-gray-200 shadow-sm ">
    <div class="max-w-7xl mx-auto nav-header-scroll">
        <div class="flex items-center h-14 md:h-16">

            @php
                $categories = \App\Models\Category::withCount('children')
                    ->where('name', '!=', '')
                    ->whereNull('parent_id')
                    ->where('status', 1)
                    ->orderBy('sort_order', 'asc')
                    ->get();


                $mainCategories = $categories->take(20);
                $moreCategories = $categories->slice(20);
            @endphp

            <!-- Main visible categories â€“ starts from left -->
            <div class="hidden md:flex items-center justify-start flex-1 space-x-1 lg:space-x-2 xl:space-x-4 nav-bottom-bordercolor">

                {{-- Main Categories --}}
                @foreach($mainCategories as $cat)
                    @php
                        $url = $cat->children_count > 0
                            ? url('category/' . $cat->slug)
                            : url('products?subcategory=' . $cat->slug);
                    @endphp

                    <a href="{{ $url }}"
                        class="nav-link1 px-3 lg:px-3 xl:px-3 py-5  text-sm lg:text-base font-medium text-gray-700 hover:text-[#b38c30] whitespace-nowrap">

                        {{ strtoupper($cat->name) }}

                        {{-- Optional popular badge --}}
                        {{-- @if($cat->is_popular)
                        <span class="ml-1 text-[10px] bg-orange-100 text-orange-600 px-1 rounded popular-tag">Popular</span>
                        @endif
                        --}}
                    </a>

                    @if(!$loop->last)
                        <div class="h-6 w-[1px] bg-gray-300"></div>
                    @endif
                @endforeach


                {{-- MORE Dropdown --}}
                @if($moreCategories->count())
                    <div class="relative group">
                        <button
                            class="nav-link px-4 lg:px-5 py-5 text-sm lg:text-base font-medium text-gray-700  flex items-center gap-1 whitespace-nowrap">
                            MORE
                            <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div
                            class="absolute top-full left-0 mt-1 w-64 bg-white shadow-xl rounded-lg border border-gray-200 py-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">

                            @foreach($moreCategories as $cat)
                                @php
                                    $url = $cat->children_count > 0
                                        ? url('category/' . $cat->slug)
                                        : url('products?subcategory=' . $cat->slug);
                                @endphp

                                <a href="{{ $url }}"
                                    class="block px-6 py-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#f4a261]">

                                    {{ $cat->name }}

                                    @if($cat->is_popular)
                                        <span class="ml-2 text-[10px] bg-orange-100 text-orange-600 px-1 rounded">Popular</span>
                                    @endif
                                </a>
                            @endforeach

                        </div>
                    </div>
                @endif

            </div>

        

        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        const arrow = document.getElementById('mobileArrow');

        menu.classList.toggle('hidden');
        arrow.classList.toggle('rotate-180');
    }

    function toggleSubmenu(id) {
        const submenu = document.getElementById('submenu-' + id);
        const icon = document.getElementById('icon-' + id);

        submenu.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');
    }
</script>

<style>
    .nav-link {
        position: relative;
    }

    .nav-link:hover::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #f4a261;
        transform: scaleX(0);
        transition: transform 0.2s ease;
    }

    .nav-link:hover::after {
        transform: scaleX(1);
    }
</style>

<script>
    const input = document.getElementById('searchInput');
    const box = document.getElementById('searchSuggestions');
    const BASE_URL = "{{ asset('') }}";
    let timeout = null;

    input.addEventListener('keyup', function () {

        clearTimeout(timeout);

        timeout = setTimeout(() => {
            let query = input.value.trim();

            if (query.length < 2) {
                box.classList.add('hidden');
                return;
            }

            fetch(`/search-suggestions?q=${query}`)
                .then(res => res.json())
                .then(data => {

                    let html = '';

                    // Categories
                    if (data.categories.length) {
                        html += `<div class="px-4 py-2 text-xs text-gray-400">Categories</div>`;

                        data.categories.forEach(cat => {

                            let url = cat.children_count > 0
                                ? `/category/${cat.slug}`
                                : `/products?subcategory=${cat.slug}`;

                            html += `
            <div onclick="window.location.href='${url}'"
                class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                ${cat.name}
            </div>
        `;
                        });
                    }

                    // Products
                   if (data.products.length) {
                        html += `<div class="px-4 py-2 text-xs text-gray-400">Products</div>`;

                        data.products.forEach(prod => {
                            html += `
            <div onclick="window.location.href='${BASE_URL}product/${prod.slug}'"
                class="flex items-center gap-3 px-4 py-2 hover:bg-gray-100 cursor-pointer">
                
                <img src="${BASE_URL}storage/${prod.image}" 
                     class="w-10 h-10 rounded object-cover">

                <span>${prod.name}</span>
            </div>
        `;
                        });
                    }

                    if (!html) {
                        html = `<div class="px-4 py-3 text-gray-500">No results found</div>`;
                    }

                    box.innerHTML = html;
                    box.classList.remove('hidden');
                });

        }, 300); // debounce
    });

    // Hide on click outside
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.relative')) {
            box.classList.add('hidden');
        }
    });
</script>