@extends('layouts.app')

@section('content')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');


        .nav-link {
            position: relative;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--primary-orange) !important;
        }

        .nav-link:hover::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, var(--primary-orange), var(--primary-cyan));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .nav-link:hover::after {
            transform: scaleX(1);
        }


        :root {
            --primary-orange: #f4a261;
            --primary-cyan: #2ec4b6;
            --primary-red: #e07a5f;
        }

        .job-container {
            max-width: 900px;
            margin: auto;
        }

        .job-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        .apply-btn {
            background: linear-gradient(135deg, var(--primary-red), var(--primary-orange));
            color: white;
            padding: 16px 32px;
            border-radius: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(224, 122, 95, 0.3);
        }

        .apply-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 30px rgba(244, 162, 97, 0.4);
        }

        /* Modal */
        .modal-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.65);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999;
            padding: 20px;
            overflow-y: auto;
        }

        .modal-box {
            width: 100%;
            max-width: 620px;
            background: white;
            padding: 30px;
            border-radius: 20px;
            max-height: 92vh;
            overflow-y: auto;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .apply-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(14px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.7);
        }

        /* Form Inputs */
        .form-input {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1.5px solid #e5e7eb;
            background: rgba(255, 255, 255, 0.85);
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 4px rgba(244, 162, 97, 0.15);
            outline: none;
        }

        .btn-apply {
            background: linear-gradient(135deg, var(--primary-red), var(--primary-orange));
            color: white;
            font-weight: 600;
            padding: 16px;
            border-radius: 14px;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-apply:hover {
            transform: scale(1.04);
            box-shadow: 0 12px 30px rgba(244, 162, 97, 0.4);
        }

        .job-badge {
            background: #fff4ed;
            color: var(--primary-red);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13.5px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .job-card {
                padding: 25px 20px;
            }

            .modal-box {
                padding: 20px;
            }
        }
    </style>

    <section class="py-8 md:py-20 px-4 bg-gradient-to-b from-gray-50 to-white">

        <div class="job-container">

            <div class="job-card">

                <!-- Job Title -->
                <h1 class="text-3xl md:text-4xl font-bold mb-6 text-gray-800">
                    React Developer
                </h1>

                <!-- Job Meta -->
                <div class="flex flex-wrap gap-4 text-gray-600 mb-8">
                    <span class="job-badge">📍 Delhi</span>
                    <span class="job-badge">💼 Full Time</span>
                    <span class="job-badge">2+ Years Experience</span>
                </div>

                <!-- Salary -->
                <div class="mb-8">
                    <span class="text-2xl font-semibold text-gray-800">
                        ₹8,00,000 - ₹14,00,000 <span class="text-base font-normal text-gray-500">per year</span>
                    </span>
                </div>

                <!-- Overview -->
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Job Description</h3>
                <p class="text-gray-700 mb-8 leading-relaxed">
                    We are looking for a passionate and skilled React Developer to join our growing tech team at B2B Gifts
                    India.
                    You will be responsible for building beautiful, responsive, and high-performance web applications for
                    our corporate gifting platform.
                </p>

                <!-- Responsibilities -->
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Responsibilities</h3>
                <ul class="list-disc ml-6 text-gray-700 mb-8 space-y-2">
                    <li>Develop and maintain modern React.js applications with Tailwind CSS</li>
                    <li>Integrate RESTful APIs and manage state efficiently</li>
                    <li>Optimize components for maximum performance</li>
                    <li>Collaborate with backend developers and UI/UX designers</li>
                    <li>Write clean, maintainable, and reusable code</li>
                </ul>

                <!-- Requirements -->
                <h3 class="text-xl font-semibold mb-3 text-gray-800">Requirements</h3>
                <ul class="list-disc ml-6 text-gray-700 mb-10 space-y-2">
                    <li>2+ years of experience with React.js and modern JavaScript (ES6+)</li>
                    <li>Strong proficiency in Tailwind CSS or similar utility frameworks</li>
                    <li>Experience with Redux / Context API and API integration</li>
                    <li>Understanding of responsive design and cross-browser compatibility</li>
                    <li>Good problem-solving skills and attention to detail</li>
                </ul>

                <!-- Apply Button -->
                <button onclick="openModal()" class="apply-btn text-lg">
                    Apply Now for this Position
                </button>

            </div>
        </div>

    </section>

    <!-- Apply Modal -->
    <div class="modal-bg" id="applyModal">
        <div class="modal-box">

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-gray-800">Apply for React Developer</h3>
                <button onclick="closeModal()"
                    class="text-2xl text-gray-400 hover:text-gray-600 transition-colors">✕</button>
            </div>

            <div class="apply-form">

                <form method="POST" enctype="multipart/form-data">


                    <input type="text" name="name" placeholder="Full Name" required class="form-input mb-4">

                    <input type="email" name="email" placeholder="Email Address" required class="form-input mb-4">

                    <input type="tel" name="phone" placeholder="Mobile Number" required class="form-input mb-4">

                    <!-- Resume Upload -->
                    <div class="mb-6">
                        <div class="relative">
                            <input type="file" name="resume" id="resume"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName()">
                            <div class="form-input flex items-center justify-between cursor-pointer">
                                <span id="fileName" class="text-gray-500">Upload your CV / Resume</span>
                                <span class="bg-[#f4a261] text-white px-5 py-2 rounded-lg text-sm font-medium">Browse</span>
                            </div>
                        </div>
                    </div>

                    <textarea name="cover_letter" rows="4"
                        placeholder="Tell us why you're perfect for this role at B2B Gifts India..."
                        class="form-input mb-6"></textarea>

                    <button type="submit" class="btn-apply text-lg py-4">
                        Submit Application
                    </button>
                </form>

                <p class="text-xs text-center text-gray-500 mt-6">
                    Your information is secure with us. We respect your privacy.
                </p>
            </div>

        </div>
    </div>

@endsection