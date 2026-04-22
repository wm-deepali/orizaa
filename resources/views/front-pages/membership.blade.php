@extends('layouts.app')

<style>
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal-content {
        background: white;
        border-radius: 24px;
        width: 90%;
        max-width: 480px;
        max-height: 92vh;
        overflow-y: auto;
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
    }

    .form-input {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e5e7eb;
        border-radius: 14px;
        margin-bottom: 16px;
        transition: all 0.3s;
    }

    .form-input:focus {
        border-color: var(--primary-orange);
        outline: none;
        box-shadow: 0 0 0 4px rgba(244, 162, 97, 0.1);
    }

    .en-form {
        z-index: 9999;
    }
</style>

@section('content')


    <section class="hero-bg py-8 md:py-32">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <p class="uppercase tracking-widest text-sm font-medium text-gray-500 mb-4">
                Premium Corporate Solutions
            </p>
            <h1 class="text-4xl md:text-6xl font-bold leading-tight text-gray-900 mb-6">
                Our Membership Plans
            </h1>
            <p class="max-w-3xl mx-auto text-xl text-gray-600">
                Choose the perfect membership that suits your corporate gifting needs. From occasional orders to
                enterprise-level solutions — we have a plan for every business.
            </p>

            <div class="mt-12">
                <a href="#"
                    class="inline-block bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
                    Compare All Plans
                </a>
            </div>
        </div>
    </section>

    <!-- How We Create Value -->
    <section class="py-8 md:py-32 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="grid md:grid-cols-12 gap-12 items-center">

                <!-- Left Content -->
                <div class="md:col-span-5">
                    <div class="bg-gray-900 text-white p-4 md:p-10 rounded-3xl h-full">
                        <h2 class="text-2xl md:text-3xl font-semibold mb-2 md:mb-6">Connecting Businesses Through Thoughtful
                            Gifting</h2>
                        <p class="text-gray-300 leading-relaxed">
                            We help companies build stronger relationships with employees and clients through premium,
                            customized corporate gifts.
                            Our membership plans are designed to make gifting seamless, cost-effective, and impactful.
                        </p>
                    </div>
                </div>

                <!-- Right Value Points -->
                <div class="md:col-span-7 space-y-6">

                    <div class="flex gap-6 bg-white p-7 rounded-3xl shadow-sm service-card">
                        <div
                            class="card-number w-10 h-10 flex-shrink-0 rounded-2xl flex items-center justify-center text-lg">
                            01</div>
                        <div>
                            <h3 class="font-semibold text-xl mb-2">Flexible Gifting Solutions</h3>
                            <p class="text-gray-600">Choose from one-time orders or enjoy priority access with our
                                membership plans.</p>
                        </div>
                    </div>

                    <div class="flex gap-6 bg-white p-7 rounded-3xl shadow-sm service-card">
                        <div
                            class="card-number w-10 h-10 flex-shrink-0 rounded-2xl flex items-center justify-center text-lg">
                            02</div>
                        <div>
                            <h3 class="font-semibold text-xl mb-2">Exclusive Discounts & Benefits</h3>
                            <p class="text-gray-600">Members get up to 25% off on bulk orders, free customization, and
                                priority support.</p>
                        </div>
                    </div>

                    <div class="flex gap-6 bg-white p-7 rounded-3xl shadow-sm service-card">
                        <div
                            class="card-number w-10 h-10 flex-shrink-0 rounded-2xl flex items-center justify-center text-lg">
                            03</div>
                        <div>
                            <h3 class="font-semibold text-xl mb-2">Dedicated Account Manager</h3>
                            <p class="text-gray-600">Get personalized assistance for all your gifting needs throughout the
                                year.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Membership Plans Cards -->
    <section class="py-8 md:py-32 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Choose Your Membership</h2>
                <p class="text-gray-600 mt-3 text-lg">Three plans designed for different business needs</p>
            </div>


            <div class="grid md:grid-cols-3 gap-8">

                @foreach($packages as $package)

                        <div
                            class="service-card bg-white rounded-3xl p-8 text-center 
                                                                                                                            {{ $package->is_popular ? 'ring-2 ring-[#D4AF37] relative' : '' }}">

                            {{-- MOST POPULAR --}}
                            @if($package->is_popular)
                                <div
                                    class="absolute -top-4 left-1/2 -translate-x-1/2 bg-[#D4AF37] text-white text-xs font-bold px-6 py-1.5 rounded-full">
                                    MOST POPULAR
                                </div>
                            @endif

                            {{-- NAME --}}
                            <h3 class="text-2xl font-semibold mb-2">
                                {{ $package->name }}
                            </h3>

                            {{-- SUB TITLE --}}
                            <p class="text-[#D4AF37] font-medium mb-6">
                                {{ $package->sub_title }}
                            </p>

                            {{-- PRICE --}}
                            <div class="text-5xl font-bold text-gray-800 mb-1">
                                ₹{{ number_format($package->cost) }}
                            </div>

                            <p class="text-sm text-gray-500 mb-8">
                                {{ $package->duration }}
                            </p>

                            {{-- FEATURES --}}
                            <ul class="text-left space-y-4 mb-10 text-gray-600">
                                @foreach($package->features as $feature)
                                    <li>✓ {{ $feature->feature_name }}</li>
                                @endforeach
                            </ul>

                            {{-- BUTTON --}}
                            <button type="button" onclick="openDrawer('{{ $package->name }}', {{ $package->id }})"
                                class="block w-full py-4 
                                                                                                        {{ $package->is_popular
                    ? 'bg-gradient-to-r from-[#D4AF37] to-[#B8962E] text-white'
                    : 'border-2 border-[#D4AF37] text-[#D4AF37] hover:bg-[#D4AF37] hover:text-white' }}
                                                                                                        rounded-2xl font-semibold transition-all">

                                {{ $package->button_text ?? 'Choose Plan' }}

                            </button>

                        </div>

                @endforeach

            </div>

        </div>
    </section>

    <!-- ==================== LEFT DRAWER FORM ==================== -->
    <div id="enquiryDrawer"
        class="fixed en-form top-0 left-0 h-full w-full md:w-1/3 bg-white shadow-2xl transform -translate-x-full transition-transform duration-300 z-50 overflow-y-auto">
        <div class="p-8">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold" id="drawerTitle">Request Quote</h3>
                <button onclick="closeDrawer()" class="text-3xl text-gray-400 hover:text-gray-600">×</button>
            </div>

            <form method="POST" action="{{ route('package.enquiry') }}">
                @csrf

                <input type="hidden" name="package_id" id="package_id">

                <div class="mb-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input type="text" id="name" name="name" class="form-input" placeholder="Enter your name" required>
                </div>

                <div class="mb-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Company Name</label>
                    <input type="text" id="company" name="company" class="form-input" placeholder="Your Company Name"
                        required>
                </div>

                <div class="mb-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" placeholder="you@company.com" required>
                </div>

                <div class="mb-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Number</label>
                    <input type="tel" id="phone" name="phone" class="form-input" placeholder="+91 98765 43210"
                        pattern="[6-9]{1}[0-9]{9}" maxlength="10" inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Message / Special Requirement</label>
                    <textarea id="message" rows="4" class="form-input" name="message"
                        placeholder="Any specific requirement or customization needed?"></textarea>
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
    <div id="drawerOverlay" onclick="closeDrawer()" class="fixed inset-0 bg-black/50 hidden z-40"></div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function openDrawer(planName, packageId) {
            document.getElementById('drawerTitle').textContent = `Enquiry for ${planName}`;
            document.getElementById('package_id').value = packageId;

            document.getElementById('enquiryDrawer').classList.remove('-translate-x-full');
            document.getElementById('drawerOverlay').classList.remove('hidden');
        }

        function closeDrawer() {
            document.getElementById('enquiryDrawer').classList.add('-translate-x-full');
            document.getElementById('drawerOverlay').classList.add('hidden');
        }
    </script>

    @if(session('success_package'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('success_package') }}"
            });

            document.getElementById('enquiryDrawer').classList.add('-translate-x-full');
            document.getElementById('drawerOverlay').classList.add('hidden');
        </script>
    @endif

    @if($errors->packageForm->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                // open only this drawer
                document.getElementById('enquiryDrawer').classList.remove('-translate-x-full');
                document.getElementById('drawerOverlay').classList.remove('hidden');

                // show errors in Swal
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: `{!! implode('<br>', $errors->packageForm->all()) !!}`
                });

            });
        </script>
    @endif


@endsection