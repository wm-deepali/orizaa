@extends('layouts.app')

@section('content')

    <section class="py-16 md:py-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">

            <!-- Header -->
            <div class="text-center mb-14">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Frequently Asked Questions
                </h1>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Find quick answers to common questions about corporate gifting with B2B Gifts India
                </p>
            </div>

            <div class="space-y-5">

                @foreach($faqs as $index => $faq)
                    <div class="faq-card">
                        <button class="faq-question {{ $index == 0 ? 'active' : '' }}" onclick="toggleFAQ(this)">
                            <span>{{ $faq->question }}</span>
                            <span class="faq-icon">+</span>
                        </button>

                        <div class="faq-answer {{ $index == 0 ? 'open' : '' }}">
                            {!! $faq->answer !!}
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Still have questions -->
            <div class="mt-16 text-center bg-white rounded-3xl p-10 shadow-sm">
                <h3 class="text-2xl font-semibold mb-3">Still have questions?</h3>
                <p class="text-gray-600 mb-6">Our team is happy to help you with any queries regarding corporate gifting.
                </p>
                <a href="{{ route('contact-us') }}"
                    class="inline-block bg-gradient-to-r from-[#D4AF37] to-[#B8962E] text-white px-10 py-4 rounded-2xl font-semibold hover:shadow-lg transition-all">
                    Contact Us Now
                </a>
            </div>

        </div>
    </section>

    <script>
        function toggleFAQ(button) {
            const answer = button.nextElementSibling;
            const isOpen = answer.classList.contains('open');
            const allQuestions = document.querySelectorAll('.faq-question');

            // Close all other FAQs
            allQuestions.forEach(q => {
                if (q !== button) {
                    q.classList.remove('active');
                    q.nextElementSibling.classList.remove('open');
                }
            });

            // Toggle current FAQ
            if (isOpen) {
                button.classList.remove('active');
                answer.classList.remove('open');
            } else {
                button.classList.add('active');
                answer.classList.add('open');
            }
        }

        // Optional: Open first FAQ by default
        window.onload = function () {
            const firstButton = document.querySelector('.faq-question');
            if (firstButton) {
                firstButton.classList.add('active');
                firstButton.nextElementSibling.classList.add('open');
            }
        };
    </script>



@endsection