<!-- ðŸ“± Mobile Bottom Menu -->
<div class="fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 shadow-md md:hidden z-[999]">


  <div class="grid grid-cols-5 text-center text-xs">

    <!-- Home -->
    <a href="{{ route('home') }}"
      class="flex flex-col items-center justify-center py-2 text-gray-600 hover:text-[#D4AF37]">
      <i class="fa-solid fa-house text-lg mb-1"></i>
      <span>Home</span>
    </a>

    <!-- New Arrivals -->
    <a href="{{ route('products', ['new_arrival' => 1]) }}"
      class="flex flex-col items-center justify-center py-2 text-gray-600 hover:text-[#D4AF37]">
      <i class="fa-solid fa-bolt text-lg mb-1"></i>
      <span>New</span>
    </a>

    <!-- Categories -->
    <a href="{{ route('category') }}"
      class="flex flex-col items-center justify-center py-2 text-gray-600 hover:text-[#D4AF37]">
      <!--<i class="fa-solid fa-grid text-lg mb-1"></i>-->
      <i class="fa-solid fa-table-cells-large text-lg mb-1"></i>
      <span>Categories</span>
    </a>

    <!-- Bulk Enquiry -->
    <a href="{{ route('vendors') }}"
      class="flex flex-col items-center justify-center py-2 text-gray-600 hover:text-[#D4AF37]">
      <i class="fa-solid fa-box text-lg mb-1"></i>
      <span>Enquiry</span>
    </a>

    <!-- Contact -->
    <a href="{{ route('contact-us') }}"
      class="flex flex-col items-center justify-center py-2 text-gray-600 hover:text-[#D4AF37]">
      <i class="fa-solid fa-phone text-lg mb-1"></i>
      <span>Contact</span>
    </a>

  </div>
</div>


<!-- FOOTER - E-commerce style for Corporate Gifting Website -->
<footer class="bg-[#1a1a1a] text-gray-300">
  <!-- Main Footer Content -->
  <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 pt-16 pb-12">
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8 lg:gap-10">

      <!-- Column 1: Brand + Description -->
      <div class="col-span-2 sm:col-span-3 lg:col-span-1">
        <div class="flex items-center gap-3 mb-6">
          <div class="font-bold text-2xl lg:text-3xl tracking-tight">
            <span class="text-[#D4AF37]">ORIZAA STYLE</span>

          </div>
        </div>
        <p class="text-gray-400 text-sm leading-relaxed mb-6">
          Premium corporate gifting partner since 2018.<br>
          Custom branded solutions for employees, clients & business partners.
        </p>
        <div class="flex gap-5 text-xl">
          <a href="#" class="hover:text-white transition-colors"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="hover:text-white transition-colors"><i class="fab fa-instagram"></i></a>
          <a href="#" class="hover:text-white transition-colors"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="hover:text-white transition-colors"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <!-- Column 2: Categories -->
      <div>
        <h4 class="text-white font-semibold text-lg mb-5">Categories</h4>
        <ul class="space-y-3 text-sm">
          @php
            $categories = \App\Models\Category::whereNull('parent_id')
              ->where('show_on_website', 1)
              ->where('status', 1)
              ->orderBy('sort_order', 'asc')
              ->get();
          @endphp
          @foreach ($categories as $category)
                  <li>
                    <a href="{{ $category->children->count() > 0
            ? url('category/' . $category->slug)
            : url('products?subcategory=' . $category->slug) }}"
                      class="hover:text-white transition-colors">{{ $category->name }}</a>
                  </li>
          @endforeach
        </ul>
      </div>

      <!-- Column 3: Company Profile -->
      <div>
        <h4 class="text-white font-semibold text-lg mb-5">Company</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="{{ route('about-us') }}" class="hover:text-white transition-colors">About Us</a></li>
          <li><a href="{{ route('why-us') }}" class="hover:text-white transition-colors">Why Choose Us</a></li>
          <li><a href="{{ route('contact-us') }}" class="hover:text-white transition-colors">Contact Us</a></li>
          <li><a href="{{ route('awards') }}" class="hover:text-white transition-colors">Awards & Recognition</a></li>
          <li><a href="{{ route('blogs') }}" class="hover:text-white transition-colors">Blogs</a></li>
          <li><a href="{{ route('limited-edition') }}" class="hover:text-white transition-colors">Limited Edition</a>
          </li>
          <li><a href="{{ route('bespoke-creation') }}" class="hover:text-white transition-colors">Bespoke Creation</a></li>
          <li><a href="{{ route('signature-collection') }}" class="hover:text-white transition-colors">Signature Collection</a></li>

        </ul>
      </div>

      <!-- Column 4: Legal & Policies -->
      <div>
        <h4 class="text-white font-semibold text-lg mb-5">Legal & Policies</h4>
        <ul class="space-y-3 text-sm">
          @foreach($footerPages as $page)
            <li>
              <a href="{{ route('dynamic.page', \Illuminate\Support\Str::slug($page->page_name)) }}"
                class="hover:text-white transition-colors">
                {{ $page->page_name }}
              </a>
            </li>
          @endforeach
        </ul>
      </div>

      <!-- Column 5: Quick Links -->
      <div>
        <h4 class="text-white font-semibold text-lg mb-5">Quick Links</h4>
        <ul class="space-y-3 text-sm">
          <li><a href="{{ route('category') }}" class="hover:text-white transition-colors">Browse All Categories</a>
          </li>
          <li><a href="{{ route('products', ['new_arrival' => 1]) }}" class="hover:text-white transition-colors">New
              Arrivals</a></li>
          <li><a href="{{ route('membership') }}" class="hover:text-white transition-colors">B2B Club Membership</a>
          </li>
          <li><a href="{{ route('vendors') }}" class="hover:text-white transition-colors">Partner / Vendor Inquiry</a>
          </li>
          <li><a href="{{ route('bulk-order') }}" class="hover:text-white transition-colors">Bulk Order Inquiry</a></li>
          <li><a href="{{ route('faqs') }}" class="hover:text-white transition-colors">FAQ</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Separator Line -->
  <div class="border-t border-gray-700"></div>

  <!-- Disclaimer -->
  <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 py-8 text-center text-sm text-gray-500">
    <p>
      <strong>Disclaimer: </strong>B2B Gifts India provides corporate gifting solutions only to businesses,
      institutions, and registered entities.
      All prices are exclusive of taxes. Product images are for representation only. Actual product may vary slightly.
      We are not responsible for any typographical errors. All trademarks and brand names belong to their respective
      owners.
    </p>
  </div>

  <!-- Second Separator Line -->
  <div class="border-t border-gray-700"></div>

  <!-- Copyright -->
  <div class="bg-[#111] py-6 text-center text-sm text-gray-500">
    <p>Â© 2026 B2B Gifts India. All Rights Reserved.</p>
  </div>
</footer>

<!-- Sticky WhatsApp Button -->
<a href="https://wa.me/917607770184" target="_blank"
  class="fixed bottom-[68px] right-5 md:bottom-5 z-50 hover:scale-110 transition-all duration-300">

  <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp"
    class="w-20 h-20 drop-shadow-lg">
</a>


<!-- GLOBAL ENQUIRY DRAWER -->
<div id="globalDrawer"
  class="fixed top-0 right-0 h-full w-full md:w-1/3 bg-white shadow-2xl transform translate-x-full transition-transform duration-300 z-50 overflow-y-auto">

  <div class="p-8">
    <div class="flex justify-between items-center mb-8">
      <h3 class="text-2xl font-bold" id="globalDrawerTitle">Get a Quote</h3>
      <button onclick="closeGlobalDrawer()" class="text-3xl text-gray-400">Ã—</button>
    </div>

    <form method="POST" action="{{ route('general.enquiry') }}">
      @csrf

      <!-- SOURCE -->
      <input type="hidden" name="source" id="global_source">

      <div class="mb-1">
        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
        <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}"
          placeholder="Enter your name" required>
      </div>

      <div class="mb-1">
        <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
        <input type="text" id="company" name="company" value="{{ old('company') }}" class="form-input"
          placeholder="Your Company Name" required>
      </div>

      <div class="mb-1">
        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input"
          placeholder="you@company.com" autocomplete="email" required>
      </div>

      <div class="mb-1">
        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Number</label>
        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="9876543210"
          pattern="[6-9]{1}[0-9]{9}" maxlength="10" inputmode="numeric"
          oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Message / Special Requirement</label>
        <textarea id="message" rows="4" class="form-input" name="message"
          placeholder="Any specific requirement or customization needed?">{{ old('message') }}</textarea>
      </div>

      <div class="mb-4">
        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
      </div>

      <button type="submit"
        class="w-full py-5 bg-gradient-to-r from-[#D4AF37] to-[#B8962E] text-white rounded-2xl font-semibold text-lg">
        Submit Enquiry
      </button>
    </form>
  </div>
</div>

<!-- Overlay -->
<div id="globalOverlay" onclick="closeGlobalDrawer()" class="fixed inset-0 bg-black/50 hidden z-40"></div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
  function openGlobalDrawer(title = 'Get a Quote', source = 'general') {
    document.getElementById('globalDrawerTitle').textContent = title;
    document.getElementById('global_source').value = source;

    document.getElementById('globalDrawer').classList.remove('translate-x-full');
    document.getElementById('globalOverlay').classList.remove('hidden');
  }

  function closeGlobalDrawer() {
    document.getElementById('globalDrawer').classList.add('translate-x-full');
    document.getElementById('globalOverlay').classList.add('hidden');
  }
</script>

@if(session('success_general'))
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: "{{ session('success_general') }}"
    });

    document.getElementById('globalDrawer').classList.add('translate-x-full');
    document.getElementById('globalOverlay').classList.add('hidden');
  </script>
@endif

@if($errors->generalForm->any())
  <script>
    document.addEventListener('DOMContentLoaded', function () {

      // open only global drawer
      document.getElementById('globalDrawer').classList.remove('translate-x-full');
      document.getElementById('globalOverlay').classList.remove('hidden');

      Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        html: `{!! implode('<br>', $errors->generalForm->all()) !!}`
      });

    });
  </script>
@endif