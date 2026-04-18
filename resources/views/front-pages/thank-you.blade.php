@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 flex items-center justify-center">

    <div class="bg-white p-10 rounded-3xl shadow-lg text-center max-w-xl w-full">
        
        <h1 class="text-3xl font-bold text-green-600 mb-4">
            🎉 Enquiry Submitted!
        </h1>

        <p class="text-gray-600 mb-6">
            Thank you for your enquiry. Our team will contact you within 24 hours.
        </p>

        <a href="{{ url('/') }}"
           class="inline-block bg-black text-white px-6 py-3 rounded-xl hover:bg-gray-800 transition">
            Back to Home
        </a>

    </div>

</div>
@endsection