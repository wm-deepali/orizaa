<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @php
        require_once app_path('Helpers/seo.php');
        $seo = getSeo();
    @endphp

    <title>
        @yield('meta_title', $seo->meta_title ?? 'ORIZAA STYLE')
    </title>

    <meta name="description" content="@yield('meta_description', $seo->meta_description ?? '')">

    @if($seo && $seo->scripts)
        {!! $seo->scripts !!}
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ URL::asset('front/style.css')  }}" type="text/css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap');

        body {
            font-family: 'Inter', system-ui, sans-serif;
        }

        :root {
            --pastel-bg: #f9f7f3;
            --accent-orange: #f4a261;
            --accent-teal: #2ec4b6;
            --accent-rose: #e07a5f;
            --text-dark: #2d2d2d;
            --text-muted: #6b7280;
        }

        .product-card {
            transition: all 0.35s ease;
        }

        .product-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        }

        .category-chip {
            white-space: normal;
            min-height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            line-height: 1.3;
        }

        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 50;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .nav-bar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .add-to-cart-btn {
            white-space: nowrap;
        }
    </style>
</head>

<body class="bg-[#f9f7f3] text-[#2d2d2d]">

    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

</body>

</html>