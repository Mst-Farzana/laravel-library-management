@extends('layouts.app')

@section('content')

<!-- Custom Animations -->
<style>
    @keyframes float1 { 0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.6; } 50% { transform: translateY(-30px) rotate(5deg); opacity: 0.9; } }
    @keyframes float2 { 0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.5; } 50% { transform: translateY(-45px) rotate(-8deg); opacity: 0.8; } }
    @keyframes float3 { 0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.4; } 50% { transform: translateY(-25px) rotate(10deg); opacity: 0.7; } }
    @keyframes float4 { 0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.55; } 50% { transform: translateY(-50px) rotate(-5deg); opacity: 0.85; } }
    @keyframes float5 { 0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.45; } 50% { transform: translateY(-35px) rotate(7deg); opacity: 0.75; } }
    @keyframes float6 { 0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.5; } 50% { transform: translateY(-40px) rotate(-6deg); opacity: 0.8; } }
    @keyframes float7 { 0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.35; } 50% { transform: translateY(-55px) rotate(12deg); opacity: 0.65; } }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes pulse-glow { 0%, 100% { box-shadow: 0 0 20px rgba(16, 185, 129, 0.3); } 50% { box-shadow: 0 0 40px rgba(16, 185, 129, 0.6); } }
    @keyframes slideInRight { from { opacity: 0; transform: translateX(60px); } to { opacity: 1; transform: translateX(0); } }

    .float-book-1 { animation: float1 6s ease-in-out infinite; }
    .float-book-2 { animation: float2 7s ease-in-out infinite 0.5s; }
    .float-book-3 { animation: float3 5s ease-in-out infinite 1s; }
    .float-book-4 { animation: float4 8s ease-in-out infinite 1.5s; }
    .float-book-5 { animation: float5 6.5s ease-in-out infinite 2s; }
    .float-book-6 { animation: float6 7.5s ease-in-out infinite 0.8s; }
    .float-book-7 { animation: float7 9s ease-in-out infinite 1.2s; }

    .hero-title { animation: fadeInUp 1s ease-out; }
    .hero-subtitle { animation: fadeInUp 1s ease-out 0.2s both; }
    .hero-search { animation: slideInRight 1s ease-out 0.4s both; }

    /* Light Mode Overlay */
    .hero-bg-overlay {
        background: linear-gradient(
            135deg,
            rgba(236, 253, 245, 0.92) 0%,
            rgba(255, 255, 255, 0.88) 40%,
            rgba(236, 253, 245, 0.85) 100%
        );
    }

    /* Dark Mode Overlay */
    .dark .hero-bg-overlay {
        background: linear-gradient(
            135deg,
            rgba(15, 23, 42, 0.95) 0%,
            rgba(30, 41, 59, 0.92) 40%,
            rgba(15, 23, 42, 0.95) 100%
        );
    }

    .search-glow { animation: pulse-glow 3s ease-in-out infinite; }
    .book-shadow { filter: drop-shadow(0 10px 20px rgba(0,0,0,0.15)); }

    .bg-library {
        background-image: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .dark .bg-library {
        filter: brightness(0.4);
    }
</style>

<!-- ========== HERO SECTION ========== -->
<section class="relative min-h-[85vh] flex items-center overflow-hidden bg-library">

    <!-- Faint Overlay -->
    <div class="absolute inset-0 hero-bg-overlay transition-colors duration-500"></div>

    <!-- Animated Floating Books -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden">
        <!-- Book 1 -->
        <div class="float-book-1 absolute top-[8%] left-[5%] book-shadow">
            <div class="w-14 h-20 bg-gradient-to-br from-red-500 to-red-700 rounded-md flex items-center justify-center transform -rotate-12">
                <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>
        <!-- Book 2 -->
        <div class="float-book-2 absolute top-[12%] left-[18%] book-shadow">
            <div class="w-12 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-md flex items-center justify-center transform rotate-6">
                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>
        <!-- Book 3 -->
        <div class="float-book-3 absolute top-[40%] left-[3%] book-shadow">
            <div class="w-16 h-22 bg-gradient-to-br from-amber-500 to-amber-700 rounded-md flex items-center justify-center transform rotate-12">
                <svg class="w-7 h-7 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>
        <!-- Book 4 -->
        <div class="float-book-4 absolute bottom-[15%] left-[8%] book-shadow">
            <div class="w-13 h-18 bg-gradient-to-br from-purple-500 to-purple-700 rounded-md flex items-center justify-center transform -rotate-8">
                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>
        <!-- Book 5 -->
        <div class="float-book-5 absolute top-[5%] right-[25%] book-shadow">
            <div class="w-11 h-15 bg-gradient-to-br from-teal-500 to-teal-700 rounded-md flex items-center justify-center transform rotate-15">
                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>
        <!-- Book 6 -->
        <div class="float-book-6 absolute bottom-[10%] left-[40%] book-shadow">
            <div class="w-15 h-20 bg-gradient-to-br from-pink-500 to-pink-700 rounded-md flex items-center justify-center transform -rotate-10">
                <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>
        <!-- Book 7 -->
        <div class="float-book-7 absolute top-[50%] right-[5%] book-shadow">
            <div class="w-12 h-17 bg-gradient-to-br from-indigo-500 to-indigo-700 rounded-md flex items-center justify-center transform rotate-20">
                <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
        </div>

        <!-- Floating Pages / Particles -->
        <div class="float-book-3 absolute top-[25%] left-[30%]"><div class="w-3 h-4 bg-emerald-300/40 rounded-sm transform rotate-45"></div></div>
        <div class="float-book-5 absolute top-[60%] left-[15%]"><div class="w-2 h-3 bg-amber-300/40 rounded-sm transform -rotate-30"></div></div>
        <div class="float-book-1 absolute top-[70%] right-[15%]"><div class="w-3 h-4 bg-blue-300/40 rounded-sm transform rotate-60"></div></div>
        <div class="float-book-4 absolute top-[15%] left-[50%]"><div class="w-2 h-3 bg-purple-300/40 rounded-sm transform -rotate-45"></div></div>
        <div class="float-book-2 absolute bottom-[25%] right-[30%]"><div class="w-3 h-3 bg-pink-300/40 rounded-full"></div></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
            <!-- Left: Text Content -->
            <div class="flex-1 text-center lg:text-left">
                <div class="hero-title">
                    <span class="inline-block px-4 py-1.5 bg-emerald-100/80 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-semibold mb-4 tracking-wide border border-emerald-200 dark:border-emerald-700 transition-colors duration-300">
                        📚 Your Digital Library Awaits
                    </span>
                </div>

                <h1 class="hero-title text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 dark:text-white mb-6 leading-tight transition-colors duration-300">
                    Welcome to
                    <span class="relative inline-block">
                        <span class="text-emerald-600 dark:text-emerald-400">Library</span>
                        <span class="absolute -bottom-2 left-0 w-full h-1.5 bg-gradient-to-r from-emerald-400 to-teal-400 rounded-full opacity-60"></span>
                    </span>
                    Management
                </h1>

                <p class="hero-subtitle text-lg md:text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-xl mx-auto lg:mx-0 leading-relaxed transition-colors duration-300">
                    Discover amazing books, manage your library, and track your reading journey — all in one beautiful place.
                </p>

                <!-- Stats -->
                <div class="hero-subtitle flex flex-wrap justify-center lg:justify-start gap-6 mb-8">
                    <div class="text-center px-4 py-2 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-xl border border-white/50 dark:border-gray-700 shadow-sm transition-colors duration-300">
                        <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $books->total() ?? ($books->count() ?? 0) }}+</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">Books</div>
                    </div>
                    <div class="text-center px-4 py-2 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-xl border border-white/50 dark:border-gray-700 shadow-sm transition-colors duration-300">
                        <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $books->where('available_copies', '>', 0)->count() ?? 0 }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">Available</div>
                    </div>
                    <div class="text-center px-4 py-2 bg-white/60 dark:bg-gray-800/60 backdrop-blur-sm rounded-xl border border-white/50 dark:border-gray-700 shadow-sm transition-colors duration-300">
                        <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $books->pluck('category_id')->unique()->count() ?? 0 }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">Categories</div>
                    </div>
                </div>
            </div>

            <!-- Right: Small Search Box -->
            <div class="hero-search flex-shrink-0 w-full lg:w-auto lg:max-w-xs">
                <form action="{{ route('library.search') }}" method="GET" class="search-glow bg-white/90 dark:bg-gray-800/90 backdrop-blur-md p-4 rounded-2xl shadow-2xl border border-emerald-200/50 dark:border-emerald-700/50 transition-colors duration-300">
                    <div class="flex items-center gap-2">
                        <div class="flex-1 relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="query" placeholder="Search books..." value="{{ request('query') }}" class="w-full pl-9 pr-3 py-2.5 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl border border-gray-200 dark:border-gray-600 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all" required>
                        </div>
                        <button type="submit" class="bg-emerald-600 dark:bg-emerald-500 hover:bg-emerald-700 dark:hover:bg-emerald-600 text-white px-4 py-2.5 rounded-xl text-sm font-semibold transition-all hover:scale-105 active:scale-95 flex items-center gap-1.5 shadow-lg shadow-emerald-500/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            Search
                        </button>
                    </div>
                </form>

                <!-- Quick Tags -->
                <div class="mt-4 flex flex-wrap justify-center lg:justify-start gap-2">
                    <span class="text-xs text-gray-500 dark:text-gray-400 font-medium self-center mr-1">Popular:</span>
                    <a href="{{ route('library.search', ['query' => 'fiction']) }}" class="text-xs px-3 py-1 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-full hover:bg-emerald-100 dark:hover:bg-emerald-900/50 transition border border-emerald-200 dark:border-emerald-700">Fiction</a>
                    <a href="{{ route('library.search', ['query' => 'science']) }}" class="text-xs px-3 py-1 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/50 transition border border-blue-200 dark:border-blue-700">Science</a>
                    <a href="{{ route('library.search', ['query' => 'history']) }}" class="text-xs px-3 py-1 bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 rounded-full hover:bg-amber-100 dark:hover:bg-amber-900/50 transition border border-amber-200 dark:border-amber-700">History</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Wave (Seamless Transition) -->
    <div class="absolute bottom-0 left-0 right-0 z-10">
        <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0 50L48 45.7C96 41.3 192 32.7 288 30.2C384 27.7 480 31.3 576 38.2C672 45 768 55 864 56.8C960 58.7 1056 52.3 1152 47.5C1248 42.7 1344 39.3 1392 37.7L1440 36V100H1392C1344 100 1248 100 1152 100C1056 100 960 100 864 100C768 100 672 100 576 100C480 100 384 100 288 100C192 100 96 100 48 100H0V50Z" class="fill-white dark:fill-gray-900 transition-colors duration-500"/>
        </svg>
    </div>
</section>

<!-- ========== BOOKS GRID ========== -->
<!-- Seamless background blending with the white wave above and footer below -->
<section class="relative py-16 bg-gradient-to-b from-white via-emerald-50/40 to-white dark:from-gray-900 dark:via-gray-800/50 dark:to-gray-900 transition-colors duration-500 overflow-hidden">

    <!-- Decorative Background Blobs for depth -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-200/40 dark:bg-emerald-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-60 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-teal-200/40 dark:bg-teal-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-60 pointer-events-none"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white transition-colors duration-300 flex items-center gap-2">
                    Available Books <span class="text-2xl">📖</span>
                </h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1 transition-colors duration-300">Browse our carefully curated collection</p>
            </div>
            <div class="flex gap-2">
                <span class="px-4 py-1.5 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 rounded-full text-sm font-bold border border-emerald-200 dark:border-emerald-700 shadow-sm transition-colors duration-300">
                    {{ $books->count() }} books
                </span>
            </div>
        </div>

        @if($books->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($books as $index => $book)
                <a href="{{ route('books.show', $book->id) }}"
                   class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500"
                   style="animation: fadeInUp 0.6s ease-out {{ $index * 0.08 }}s both;">

                    <!-- Cover Image -->
                    <div class="relative h-52 overflow-hidden bg-gradient-to-br from-gray-100 dark:from-gray-700 to-gray-200 dark:to-gray-600 transition-colors duration-300">
                        @if($book->cover_image)
                            <img src="{{ $book->cover_image }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="{{ $book->title }}">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="w-20 h-28 bg-gradient-to-br from-emerald-400 to-emerald-600 dark:from-emerald-500 dark:to-emerald-700 rounded-lg flex items-center justify-center shadow-lg transform group-hover:rotate-6 transition-transform duration-500">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                        @endif

                        <!-- Availability Badge -->
                        @if($book->available_copies > 0)
                            <span class="absolute top-3 right-3 px-2.5 py-1 bg-emerald-500 dark:bg-emerald-600 text-white text-xs font-bold rounded-full shadow-lg backdrop-blur-sm">
                                Available
                            </span>
                        @else
                            <span class="absolute top-3 right-3 px-2.5 py-1 bg-red-500 dark:bg-red-600 text-white text-xs font-bold rounded-full shadow-lg backdrop-blur-sm">
                                Unavailable
                            </span>
                        @endif
                    </div>

                    <!-- Book Info -->
                    <div class="p-5">
                        <h3 class="text-gray-900 dark:text-white font-bold leading-snug mb-2 line-clamp-2 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors duration-300">
                            {{ $book->title }}
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4 flex items-center gap-1.5 transition-colors duration-300">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ $book->author }}
                        </p>

                        <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-700 transition-colors duration-300">
                            <span class="text-xs px-2.5 py-1 bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 rounded-lg font-semibold border border-emerald-200 dark:border-emerald-700 transition-colors duration-300">
                                {{ $book->category->name ?? 'General' }}
                            </span>
                            <span class="text-sm font-bold text-gray-700 dark:text-gray-300 transition-colors duration-300">
                                {{ $book->available_copies }} left
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $books->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20 bg-white/60 dark:bg-gray-800/50 backdrop-blur-sm rounded-3xl border border-dashed border-gray-300 dark:border-gray-700 relative overflow-hidden shadow-sm transition-colors duration-300">
                <!-- Floating books in empty state -->
                <div class="float-book-1 absolute top-10 left-20 opacity-20"><div class="w-10 h-14 bg-emerald-400 rounded-md"></div></div>
                <div class="float-book-3 absolute bottom-10 right-20 opacity-20"><div class="w-8 h-12 bg-blue-400 rounded-md"></div></div>

                <div class="relative z-10">
                    <div class="w-24 h-24 mx-auto mb-6 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center shadow-inner">
                        <svg class="w-12 h-12 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 transition-colors duration-300">No books available yet</h3>
                    <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto transition-colors duration-300">Our library is growing! Check back soon for amazing reads.</p>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection
