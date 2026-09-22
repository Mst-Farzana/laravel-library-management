<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LibraryPro') }} - Authentication</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* ✅ Alpine.js Flash Prevention (ঝিকমিক বন্ধ করতে) */
        [x-cloak] { display: none !important; }

        /* Background Floating Animation */
        @keyframes float-slow {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(30px, -30px) rotate(5deg); }
        }
        @keyframes float-reverse {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-30px, 30px) rotate(-5deg); }
        }
        @keyframes float-medium {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(20px, 20px) rotate(3deg); }
        }
        .animate-float-slow { animation: float-slow 12s ease-in-out infinite; }
        .animate-float-reverse { animation: float-reverse 15s ease-in-out infinite; }
        .animate-float-medium { animation: float-medium 10s ease-in-out infinite 2s; }
    </style>
</head>

<!-- ✅ আপডেট: overflow-x-hidden (মোবাইলে স্ক্রল ঠিক রাখতে) এবং ডার্ক মোড গ্রেডিয়েন্ট যোগ করা হয়েছে -->
<body class="bg-gradient-to-br from-emerald-50 via-white to-teal-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 min-h-screen flex flex-col justify-center items-center py-12 sm:px-6 lg:px-8 relative overflow-x-hidden transition-colors duration-500">

    <!-- Decorative Background Blobs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-emerald-200 dark:bg-emerald-900/30 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-40 animate-float-slow transition-colors duration-500"></div>
        <div class="absolute top-1/3 right-0 w-80 h-80 bg-teal-200 dark:bg-teal-900/30 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-30 animate-float-reverse transition-colors duration-500"></div>
        <div class="absolute -bottom-20 left-1/4 w-72 h-72 bg-cyan-100 dark:bg-cyan-900/30 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-50 animate-float-medium transition-colors duration-500"></div>
    </div>

    <!-- Main Content (z-10 to stay above background) -->
    <div class="relative z-10 sm:mx-auto sm:w-full sm:max-w-md w-full px-4">

        <!-- Logo -->
        <a href="/" class="flex justify-center items-center gap-3 mb-8 group">
            <div class="relative">
                <div class="absolute inset-0 bg-emerald-400 rounded-xl blur-md opacity-40 group-hover:opacity-60 transition-opacity duration-500"></div>
                <div class="relative w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-xl flex items-center justify-center shadow-xl transform group-hover:scale-105 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
            <div class="text-center sm:text-left">
                <span class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight transition-colors duration-300">Library<span class="text-emerald-600 dark:text-emerald-400">Pro</span></span>
                <p class="text-sm text-gray-500 dark:text-gray-400 font-medium -mt-1 transition-colors duration-300">Welcome back!</p>
            </div>
        </a>

        <!-- Form Card (Glassmorphism Effect) -->
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl shadow-2xl rounded-3xl sm:px-10 px-6 py-8 border border-white/60 dark:border-gray-700 transition-colors duration-300">
            {{ $slot }}
        </div>

        <!-- Back to Home Link -->
        <div class="mt-8 text-center">
            <a href="/" class="inline-flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-all duration-300 font-medium group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Library Home
            </a>
        </div>

        <!-- Footer Copyright -->
        <p class="mt-6 text-center text-xs text-gray-400 dark:text-gray-500 transition-colors duration-300">
            &copy; {{ date('Y') }} LibraryPro. All rights reserved.
        </p>
    </div>

</body>
</html>
