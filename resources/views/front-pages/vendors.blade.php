@extends('layouts.app')

@section('content')

    <style>
        .form-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 14px;
            background: #fff;
            transition: all 0.3s ease;
            font-size: 1.05rem;
        }

        .form-input:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 5px rgba(244, 162, 97, 0.12);
            outline: none;
        }

        .select-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 14px;
            background: #fff;
            font-size: 1.05rem;
        }

        .enquiry-btn {
            background: linear-gradient(135deg, #B8962E, #D4AF37);
            color: white;
            padding: 18px 40px;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.4s ease;
        }

        .enquiry-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(224, 122, 95, 0.4);
        }
    </style>
    <!-- Hero Section -->
    <section class="py-24 md:py-32 bg-white">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <p class="uppercase tracking-widest text-sm font-medium text-gray-500 mb-4">
                Become a Partner
            </p>
            <h1 class="text-5xl md:text-6xl font-bold leading-tight text-gray-900 mb-6">
                Partner with <span class="text-[#D4AF37]">Orizaa Style</span>
            </h1>
            <p class="max-w-3xl mx-auto text-xl text-gray-600">
                Join hands with India's fastest growing corporate gifting company.
                Whether you're a manufacturer, supplier, designer, or logistics partner — we welcome quality collaborations.
            </p>

            <div class="mt-12">
                <a href="#enquiry-form"
                    class="inline-block bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
                    Submit Your Enquiry
                </a>
            </div>
        </div>
    </section>

    <!-- Benefits -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-semibold">Why Partner With Us?</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-3xl text-center">
                    <div class="text-5xl mb-6">📦</div>
                    <h3 class="font-semibold text-xl mb-3">Large Volume Orders</h3>
                    <p class="text-gray-600">Consistent bulk orders throughout the year from our corporate clients.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl text-center">
                    <div class="text-5xl mb-6">💰</div>
                    <h3 class="font-semibold text-xl mb-3">Timely Payments</h3>
                    <p class="text-gray-600">100% transparent and on-time payment terms.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl text-center">
                    <div class="text-5xl mb-6">🤝</div>
                    <h3 class="font-semibold text-xl mb-3">Long-term Partnership</h3>
                    <p class="text-gray-600">Grow together as we expand our presence across India.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900">Investor Benefits</h2>
                <p class="text-gray-600 mt-3">Maximize impact and reduce hidden costs with B2B Gifts India</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="benefit-card bg-white p-8 rounded-3xl shadow-sm text-center">
                    <div class="text-5xl mb-6">🏢</div>
                    <h3 class="font-semibold text-xl mb-3">No Excessive Fees</h3>
                    <p class="text-gray-600">Transparent pricing with zero hidden registration or management charges.</p>
                </div>

                <div class="benefit-card bg-white p-8 rounded-3xl shadow-sm text-center">
                    <div class="text-5xl mb-6">📈</div>
                    <h3 class="font-semibold text-xl mb-3">Exclusive Discounts</h3>
                    <p class="text-gray-600">Up to 25% off on bulk orders + priority access to new collections.</p>
                </div>

                <div class="benefit-card bg-white p-8 rounded-3xl shadow-sm text-center">
                    <div class="text-5xl mb-6">🤝</div>
                    <h3 class="font-semibold text-xl mb-3">Dedicated Support</h3>
                    <p class="text-gray-600">Personal account manager + customized gifting strategy for your business.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Investment Opportunities -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold">Investor-Focused Opportunities</h2>
                <p class="text-gray-600 mt-3">From equity stakes to diversified gifting solutions</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                <div class="bg-gray-50 p-8 rounded-3xl">
                    <h3 class="text-[#D4AF37] font-semibold mb-1">Equity Partnership</h3>
                    <div class="text-4xl font-bold text-gray-800 mb-4">₹50K+</div>
                    <p class="text-gray-600 text-sm">Become a strategic partner and get priority access to premium products
                        at wholesale rates.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-3xl">
                    <h3 class="text-[#2ec4b6] font-semibold mb-1">Bulk Gifting</h3>
                    <div class="text-4xl font-bold text-gray-800 mb-4">12% OFF</div>
                    <p class="text-gray-600 text-sm">Annual membership with guaranteed discounts on all corporate orders.
                    </p>
                </div>

                <div class="bg-gray-50 p-8 rounded-3xl">
                    <h3 class="text-[#B8962E] font-semibold mb-1">Co-Branded Collections</h3>
                    <div class="text-4xl font-bold text-gray-800 mb-4">Custom</div>
                    <p class="text-gray-600 text-sm">Create exclusive co-branded gift lines with your logo and messaging.
                    </p>
                </div>

                <div class="bg-gray-50 p-8 rounded-3xl">
                    <h3 class="text-gray-700 font-semibold mb-1">Diversified Network</h3>
                    <div class="text-4xl font-bold text-gray-800 mb-4">18+</div>
                    <p class="text-gray-600 text-sm">Access to a network of 18+ cities across India for seamless pan-India
                        gifting.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Our Trusted Partners / Team -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold">Our Trusted Network</h2>
                <p class="text-gray-600 mt-3">Backed by visionary leaders and corporate partners</p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">

                <div class="text-center">
                    <div class="mx-auto w-48 h-48 bg-gray-200 rounded-3xl overflow-hidden mb-6">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a" alt="Rahul Sharma"
                            class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold text-xl">Rahul Sharma</h3>
                    <p class="text-[#D4AF37]">Founder & CEO</p>
                </div>

                <div class="text-center">
                    <div class="mx-auto w-48 h-48 bg-gray-200 rounded-3xl overflow-hidden mb-6">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2" alt="Priya Malhotra"
                            class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold text-xl">Priya Malhotra</h3>
                    <p class="text-[#2ec4b6]">Director - Operations</p>
                </div>

                <div class="text-center">
                    <div class="mx-auto w-48 h-48 bg-gray-200 rounded-3xl overflow-hidden mb-6">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d" alt="Arjun Verma"
                            class="w-full h-full object-cover">
                    </div>
                    <h3 class="font-semibold text-xl">Arjun Verma</h3>
                    <p class="text-[#B8962E]">Creative Head</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Our Process -->
    <section class="py-20 bg-white">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold">Our Process</h2>
                <p class="text-gray-600 mt-4">A clear path to smarter corporate gifting partnerships</p>
            </div>

            <div
                class="max-w-3xl mx-auto space-y-16 relative before:absolute before:left-8 before:top-10 before:bottom-10 before:w-0.5 before:bg-gradient-to-b before:from-[#D4AF37] before:to-[#B8962E]">

                <div class="process-step flex gap-10">
                    <div class="w-16 h-16 bg-[#D4AF37] text-white rounded-2xl flex items-center justify-center text-2xl font-bold flex-shrink-0"
                        style="z-index: 10;">1</div>
                    <div>
                        <h3 class="text-2xl font-semibold mb-3">Discovery & Consultation</h3>
                        <p class="text-gray-600">We understand your brand values, gifting goals, and budget to create a
                            tailored plan.</p>
                    </div>
                </div>

                <div class="process-step flex gap-10">
                    <div class="w-16 h-16 bg-[#2ec4b6] text-white rounded-2xl flex items-center justify-center text-2xl font-bold flex-shrink-0"
                        style="z-index: 10;">2</div>
                    <div>
                        <h3 class="text-2xl font-semibold mb-3">Curated Solutions</h3>
                        <p class="text-gray-600">Get handpicked premium products with customization options that perfectly
                            match your needs.</p>
                    </div>
                </div>

                <div class="process-step flex gap-10">
                    <div class="w-16 h-16 bg-[#B8962E] text-white rounded-2xl flex items-center justify-center text-2xl font-bold flex-shrink-0"
                        style="z-index: 10;">3</div>
                    <div>
                        <h3 class="text-2xl font-semibold mb-3">Ongoing Partnership</h3>
                        <p class="text-gray-600">Enjoy dedicated support, priority service, and continuous opportunities to
                            strengthen your brand presence.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- Vendor Enquiry Form -->
    <section id="enquiry-form" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900">Vendor / Partner Enquiry Form</h2>
                <p class="text-gray-600 mt-3">Please fill the details below. Our team will get back to you within 48 hours.
                </p>
            </div>

            <div class="bg-white border border-gray-100 shadow-xl rounded-3xl p-10 md:p-14">

                @if(session('success'))
                    <div class="mb-4 text-green-600 font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 text-red-500">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('vendor.enquiry') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name / Company Contact Person
                            </label>
                            <input type="text" name="name" placeholder="Enter your name" class="form-input"
                                value="{{ old('name') }}" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Company Name
                            </label>
                            <input type="text" name="company" placeholder="Your Company Name" class="form-input"
                                value="{{ old('company') }}" required>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address
                            </label>
                            <input type="email" name="email" placeholder="you@company.com" value="{{ old('email') }}"
                                class="form-input" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Mobile Number
                            </label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+91 98765 43210"
                                class="form-input" pattern="[6-9]{1}[0-9]{9}" maxlength="10" inputmode="numeric"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')" required>
                        </div>
                    </div>

                    <!-- 🔥 ONE SELECT (Business + Category) -->
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Business Type / Category
                        </label>

                        <select name="vendor_type_id" class="select-input" required>
                            <option value="">Select Option</option>

                            <optgroup label="Business Type">
                                @foreach($vendorTypes->where('type', 'business') as $type)
                                    <option value="{{ $type->id }}" {{ old('vendor_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </optgroup>

                            <optgroup label="Categories">
                                @foreach($vendorTypes->where('type', 'category') as $type)
                                    <option value="{{ $type->id }}" {{ old('vendor_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Product / Service Description
                        </label>
                        <textarea name="description" rows="5"
                            placeholder="Briefly describe your products, capacity, MOQ, etc..."
                            class="form-input">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Monthly Production Capacity
                            </label>
                            <input type="text" name="capacity" placeholder="e.g. 10,000 units/month"
                                value="{{ old('capacity') }}" class="form-input">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                City / Location
                            </label>
                            <input type="text" name="city" value="{{ old('city') }}" placeholder="e.g. Delhi, Mumbai, Surat"
                                class="form-input">
                        </div>
                    </div>

                    <!-- FILE -->
                    <div class="mt-8">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Upload Catalogue / Company Profile
                        </label>
                        <input type="file" name="catalogue" class="form-input">
                    </div>

                    <!-- CAPTCHA -->
                    <div class="mt-6">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                    </div>

                    @error('g-recaptcha-response')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="enquiry-btn w-full mt-12">
                        Submit Partnership Enquiry
                    </button>

                    <p class="text-center text-xs text-gray-500 mt-6">
                        Your information is secure with us. We respect your privacy.
                    </p>

                </form>


            </div>
        </div>
    </section>



@endsection