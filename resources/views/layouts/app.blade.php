<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LibraryPro') }} - {{ $title ?? 'Library Management' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* ✅ Alpine.js Flash Prevention (ঝিকমিক বন্ধ করতে) */
        [x-cloak] { display: none !important; }
    </style>
</head>

<!-- ✅ Responsive & Dark Mode Ready Body -->
<body class="bg-gradient-to-br from-gray-50 via-emerald-50/40 to-gray-50 dark:from-gray-900 dark:via-gray-800/50 dark:to-gray-900 min-h-screen flex flex-col antialiased transition-colors duration-500">

    <!-- Navigation (Responsive Alpine.js Menu এখানে লোড হবে) -->
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-md shadow-sm border-b border-gray-200/60 dark:border-gray-800/60 sticky top-16 z-40 transition-colors duration-500">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="flex-grow relative">

        <!-- Decorative Background Blobs (Responsive & Dark Mode) -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none -z-10">
            <div class="absolute top-0 right-0 w-72 h-72 sm:w-96 sm:h-96 bg-emerald-100/50 dark:bg-emerald-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-60 transition-colors duration-500"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 sm:w-96 sm:h-96 bg-teal-100/50 dark:bg-teal-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-60 transition-colors duration-500"></div>
        </div>

        <!-- ✅ Success Flash Message (Alpine.js Auto-Dismiss) -->
        @if (session('success'))
            <div x-data="{ show: true }"
                 x-show="show"
                 x-init="setTimeout(() => show = false, 5000)"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6" x-cloak>

                <div class="bg-emerald-50/90 dark:bg-emerald-900/40 backdrop-blur-sm border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 px-4 py-3.5 rounded-xl flex items-center justify-between shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-emerald-100 dark:bg-emerald-800/50 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="font-medium text-sm sm:text-base">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="ml-4 text-emerald-600 dark:text-emerald-400 hover:text-emerald-800 dark:hover:text-emerald-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- ✅ Error Flash Message (Alpine.js Auto-Dismiss) -->
        @if (session('error'))
            <div x-data="{ show: true }"
                 x-show="show"
                 x-init="setTimeout(() => show = false, 5000)"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-4"
                 class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6" x-cloak>

                <div class="bg-red-50/90 dark:bg-red-900/40 backdrop-blur-sm border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3.5 rounded-xl flex items-center justify-between shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-8 h-8 bg-red-100 dark:bg-red-800/50 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </div>
                        <span class="font-medium text-sm sm:text-base">{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="ml-4 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        @endif

        <!-- Main Content Area (Responsive Padding) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 relative z-10">
            {{ $slot ?? '' }}
            @yield('content')
        </div>
    </main>

    <!-- Modern Footer (Responsive) -->
    <footer class="bg-gradient-to-r from-gray-900 via-emerald-950 to-gray-900 text-white border-t border-emerald-900/50 mt-auto relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500"></div>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">

                <!-- Brand -->
                <div class="flex items-center justify-center md:justify-start gap-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center shadow-lg shadow-emerald-500/30">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-base tracking-tight">Library<span class="text-emerald-400">Pro</span></span>
                        <p class="text-[10px] text-gray-400 mt-0 leading-none">Your Digital Gateway to Knowledge</p>
                    </div>
                </div>

                <!-- Quick Links (Stack on mobile, row on desktop) -->
                <div class="flex flex-col sm:flex-row items-center gap-3 sm:gap-4 text-xs font-medium">
                    <a href="#" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 relative group">
                        Privacy Policy
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 relative group">
                        Terms of Service
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-emerald-400 transition-colors duration-300 relative group">
                        Support
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-emerald-400 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

                <!-- Copyright -->
                <p class="text-xs text-gray-400 flex items-center justify-center md:justify-end gap-1.5">
                    <span>&copy; {{ date('Y') }} LibraryPro.</span>
                    <span class="hidden sm:inline">All rights reserved.</span>
                </p>
            </div>
        </div>
    </footer>

</body>
</html>
