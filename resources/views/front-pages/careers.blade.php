@extends('layouts.app')

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        :root {
            --primary-orange: #f4a261;
            --primary-cyan: #2ec4b6;
            --primary-red: #e07a5f;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(180deg, #f8f4f0, #ffffff);
        }

        /* Glass Card */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.35s ease;
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(244, 162, 97, 0.15);
        }

        /* Apply Form */
        .apply-form {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(14px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        /* Form Inputs */
        .form-input {
            width: 100%;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1.5px solid #e5e7eb;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: var(--primary-orange);
            box-shadow: 0 0 0 4px rgba(244, 162, 97, 0.15);
            outline: none;
        }

        /* Button */
        .btn-apply {
            background: linear-gradient(135deg, #e07a5f, #f4a261);
            color: white;
            font-weight: 600;
            padding: 16px;
            border-radius: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(224, 122, 95, 0.3);
        }

        .btn-apply:hover {
            transform: scale(1.04);
            box-shadow: 0 12px 30px rgba(244, 162, 97, 0.4);
        }

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

        .job-badge {
            background: #fff4ed;
            color: #e07a5f;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 500;
        }
    </style>
    
@section('content')

 <!-- Hero -->
    <section class="py-12 md:py-20 text-center px-4">
        <h1 class="text-3xl md:text-5xl font-bold mb-4">
            Careers at <span class="text-[#f4a261]">B2B</span><span class="text-[#2ec4b6]"> Gifts</span><span class="text-[#e07a5f]"> India</span>
        </h1>
        <p class="text-gray-600 text-base md:text-lg max-w-2xl mx-auto">
            Join our growing team and help businesses across India create memorable gifting experiences.
        </p>
    </section>

    <section class="pb-20">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                <!-- Job Listings -->
                <div class="lg:col-span-2 space-y-6">
                    <h2 class="text-3xl font-bold mb-8 text-gray-800">Current Openings</h2>

                    <!-- Job 1 -->
                    <div class="glass-card p-6">
                        <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                            <div>
                                <h3 class="text-2xl font-semibold mb-2">React Developer</h3>
                                <div class="flex flex-col sm:flex-row gap-3 mb-4">
                                    <span class="job-badge">📍 Delhi</span>
                                    <span class="job-badge">💼 Full Time</span>
                                    <span class="job-badge">2+ Years Exp.</span>
                                </div>
                                <p class="text-gray-600">
                                    Looking for a passionate React developer with strong frontend skills and modern UI/UX knowledge.
                                </p>
                            </div>
                            <a href="#" class="text-[#f4a261] font-semibold hover:text-[#e07a5f] transition-colors whitespace-nowrap">Apply Now →</a>
                        </div>
                    </div>

                    <!-- Job 2 -->
                    <div class="glass-card p-6">
                        <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                            <div>
                                <h3 class="text-2xl font-semibold mb-2">Backend Developer (Laravel/Node.js)</h3>
                                <div class="flex flex-col sm:flex-row gap-3 mb-4">
                                    <span class="job-badge">📍 Remote / Hybrid</span>
                                    <span class="job-badge">💼 Full Time</span>
                                </div>
                                <p class="text-gray-600">
                                    We need a skilled backend developer experienced in Laravel or Node.js for our e-commerce platform.
                                </p>
                            </div>
                            <a href="#" class="text-[#f4a261] font-semibold hover:text-[#e07a5f] transition-colors whitespace-nowrap">Apply Now →</a>
                        </div>
                    </div>
                </div>

                <!-- Quick Apply Form -->
                <div>
                    <div class="apply-form p-8 sticky top-8">
                        <h3 class="text-2xl font-bold mb-6 text-gray-800">Quick Apply</h3>
                        
                        <form>
                            <input type="text" placeholder="Full Name" required class="form-input mb-4">
                            <input type="email" placeholder="Email Address" required class="form-input mb-4">
                            <input type="tel" placeholder="Mobile Number" required class="form-input mb-4">
                            
                            <select class="form-input mb-4" required>
                                <option value="">Select Position</option>
                                <option>React Developer</option>
                                <option>Backend Developer</option>
                            </select>

                            <div class="mb-6">
                                <div class="relative">
                                    <input type="file" id="resume" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="updateFileName()">
                                    <div class="form-input flex items-center justify-between cursor-pointer">
                                        <span id="fileName" class="text-gray-500">Upload your CV / Resume</span>
                                        <span class="bg-[#f4a261] text-white px-5 py-2 rounded-lg text-sm font-medium">Browse</span>
                                    </div>
                                </div>
                            </div>

                            <textarea rows="4" placeholder="Why do you want to join B2B Gifts India?" 
                                class="form-input mb-6 resize-y"></textarea>

                            <button type="submit" class="btn-apply w-full text-lg">
                                Submit Application
                            </button>
                        </form>

                        <p class="text-xs text-center text-gray-500 mt-6">
                            Your data is safe with us. We respect your privacy.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection