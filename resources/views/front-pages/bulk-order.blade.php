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
            Manufacturing & Supply Partnership
        </p>
        <h1 class="text-5xl md:text-6xl font-bold leading-tight text-gray-900 mb-6">
            Partner with <span class="text-[#D4AF37]">Orizaa Style</span>
        </h1>
        <p class="max-w-3xl mx-auto text-xl text-gray-600">
            We are actively looking for reliable manufacturers and suppliers for bulk corporate gifting. 
            Join hands with us to supply high-quality products for our growing corporate clientele across India.
        </p>

        <div class="mt-12">
            <a href="#enquiry-form" 
               class="inline-block bg-gradient-to-r from-[#B8962E] to-[#D4AF37] text-white px-10 py-4 rounded-2xl font-semibold text-lg hover:shadow-xl transition-all">
                Submit Bulk Supply Enquiry
            </a>
        </div>
    </div>
</section>
<!-- Vendor Enquiry Form -->
<section id="enquiry-form" class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900">Bulk Order Vendor / Supplier Enquiry</h2>
            <p class="text-gray-600 mt-3">Please provide your details below. Our procurement team will contact you within 48 hours.</p>
        </div>

        <div class="bg-white border border-gray-100 shadow-xl rounded-3xl p-10 md:p-14">

            <form>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact Person Name</label>
                        <input type="text" placeholder="Enter full name" class="form-input" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company / Firm Name</label>
                        <input type="text" placeholder="Your Company Name" class="form-input" required>
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input type="email" placeholder="you@company.com" class="form-input" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile / WhatsApp Number</label>
                        <input type="tel" placeholder="+91 98765 43210" class="form-input" required>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product Category You Supply</label>
                    <select class="select-input" required>
                        <option value="">Select Main Category</option>
                        <option>Corporate Diaries & Notebooks</option>
                        <option>Drinkware & Bottles</option>
                        <option>Leather Products & Folders</option>
                        <option>Power Banks & Tech Gadgets</option>
                        <option>Promotional Pens & Stationery</option>
                        <option>Custom Packaging Solutions</option>
                        <option>Eco-Friendly Gifts</option>
                        <option>Trophies & Awards</option>
                        <option>Apparel & Merchandise</option>
                        <option>Other Products</option>
                    </select>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Monthly Production / Supply Capacity</label>
                    <input type="text" placeholder="e.g. 15,000 units per month" class="form-input" required>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Order Quantity (MOQ)</label>
                    <input type="text" placeholder="e.g. 500 - 1000 pieces" class="form-input">
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Product / Service Description</label>
                    <textarea rows="5" placeholder="Describe your products, quality standards, customization capabilities, and why we should partner with you..." 
                              class="form-input"></textarea>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">City / Manufacturing Location</label>
                        <input type="text" placeholder="e.g. Delhi, Mumbai, Surat, Chennai" class="form-input">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">GST Number (Optional)</label>
                        <input type="text" placeholder="22AAAAA0000A1Z5" class="form-input">
                    </div>
                </div>

                <div class="mt-8">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Upload Catalogue / Product Images / Price List (Optional)</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-2xl p-10 text-center hover:border-[#D4AF37] transition-colors cursor-pointer">
                        <p class="text-gray-500 font-medium">Drag & drop files here or click to upload</p>
                        <p class="text-xs text-gray-400 mt-2">PDF, JPG, PNG (Max 10MB)</p>
                    </div>
                </div>

                <button type="submit" class="enquiry-btn w-full mt-12">
                    Submit Bulk Supply Enquiry
                </button>

                <p class="text-center text-xs text-gray-500 mt-6">
                    All information is kept confidential. Our team will review and get back to you shortly.
                </p>
            </form>

        </div>
    </div>
</section>


@endsection