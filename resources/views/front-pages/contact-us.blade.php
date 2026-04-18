@extends('layouts.app')

@section('content')

    <style>
        .form-input {
            width: 100%;
            padding: 14px 18px;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            background: #fff;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 4px rgba(244, 162, 97, 0.15);
            outline: none;
        }

        .office-card {
            transition: all 0.4s ease;
        }

        .office-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 45px rgba(244, 162, 97, 0.12);
        }

        .send-btn {
            background: linear-gradient(135deg, #e07a5f, #f4a261);
            color: white;
            font-weight: 600;
            padding: 16px 40px;
            border-radius: 9999px;
            transition: all 0.3s ease;
        }

        .send-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(224, 122, 95, 0.3);
        }
    </style>


    <section class="py-8 md:py-20 bg-gradient-to-br from-[#f8f4f0] to-white">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6">Get In Touch</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Have questions about corporate gifting? Our team is ready to help you find the perfect solution.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 py-8 md:py-16">
        <div class="grid lg:grid-cols-5 gap-12">

            <!-- Contact Form -->
            <div class="lg:col-span-3">
                <div class="bg-white rounded-3xl shadow-sm p-4 md:p-10">
                    <h2 class="text-3xl font-semibold mb-8">Send us a Message</h2>

                    <form method="POST" action="{{ route('contact.submit') }}">
                        @csrf

                        {{-- SUCCESS MESSAGE --}}
                        @if(session('success'))
                            <div class="mb-4 text-green-600 font-medium">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- ERROR MESSAGE --}}
                        @if ($errors->any())
                            <div class="mb-4 text-red-500">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>• {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- NAME + EMAIL -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name"
                                class="form-input" required>

                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address"
                                class="form-input" required>
                        </div>

                        <!-- MOBILE -->
                        <input type="tel" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile Number"
                            class="form-input mt-6" required>

                        <!-- COMPANY -->
                        <input type="text" name="company" value="{{ old('company') }}" placeholder="Company Name"
                            class="form-input mt-6">

                        <!-- INQUIRY TYPE (DYNAMIC) -->
                        <select name="inquiry_type" class="form-input mt-6">
                            <option value="">Select Inquiry Type</option>
                            @foreach($inquiryTypes as $type)
                                <option value="{{ $type }}" {{ old('inquiry_type') == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>

                        <!-- MESSAGE -->
                        <textarea name="message" rows="5" placeholder="Your Message..." class="form-input mt-6"
                            required>{{ old('message') }}</textarea>

                        <div>
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                        </div>

                        <!-- SUBMIT BUTTON -->
                        <button type="submit"
                            class="contact-btn bg-gradient-to-r from-[#B8962E] to-[#D4AF37] w-full mt-8 text-white py-5 rounded-2xl font-semibold text-lg">
                            Send Message
                        </button>

                    </form>

                </div>
            </div>

            <!-- Offices -->
            <div class="lg:col-span-2 space-y-8">

                @foreach($branches as $branch)
                    <div class="office-card bg-white rounded-3xl p-8 shadow-sm border border-gray-100">

                        <div class="flex items-center gap-4 mb-6">
                            <div
                                class="w-12 h-12 {{ $branch->icon ?? 'bg-[#D4AF37]' }} text-white rounded-2xl flex items-center justify-center text-2xl">
                                {!! $branch->icon ?? '📍' !!}
                            </div>

                            <div>
                                <h3 class="font-semibold text-xl">
                                    {{ $branch->title }}
                                </h3>

                                @if($branch->subtitle)
                                    <p class="text-[#D4AF37] font-medium">
                                        {{ $branch->subtitle }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <p class="text-gray-600 mb-4">
                            {{ $branch->address }}
                        </p>

                        <div class="space-y-3 text-sm">

                            @if($branch->phone)
                                <p><strong>Phone:</strong> {{ $branch->phone }}</p>
                            @endif

                            @if($branch->email)
                                <p><strong>Email:</strong> {{ $branch->email }}</p>
                            @endif

                            @if($branch->working_hours)
                                <p><strong>Working Hours:</strong> {{ $branch->working_hours }}</p>
                            @endif

                        </div>

                    </div>
                @endforeach

            </div>

        </div>
    </div>

    <!-- Map / Quick Contact -->
    <section class="bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <p class="text-gray-500">We serve clients across 18+ cities in India</p>
        </div>
    </section>
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection