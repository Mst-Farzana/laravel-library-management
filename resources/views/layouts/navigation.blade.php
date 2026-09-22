<nav class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-teal-900 shadow-2xl sticky top-0 z-50 border-b border-emerald-700/30" x-data="{ mobileMenuOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('library.home') }}" class="flex items-center gap-2 group">
                    <div class="relative">
                        <div class="absolute inset-0 bg-white/20 rounded-lg blur-md group-hover:blur-lg transition-all"></div>
                        <div class="relative w-8 h-8 bg-gradient-to-br from-white to-emerald-100 rounded-lg flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-4 h-4 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <span class="text-base font-bold text-white tracking-tight">Library<span class="text-emerald-300">Pro</span></span>
                        <p class="text-[10px] text-emerald-200/80 -mt-0.5 hidden sm:block leading-none">Digital Library</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden sm:flex sm:items-center sm:space-x-1">
                <a href="{{ route('library.home') }}" class="px-3 py-1.5 text-emerald-50 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-xs font-medium {{ request()->routeIs('library.home') ? 'bg-white/15 text-white shadow-lg' : '' }}">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Home
                    </span>
                </a>

                <a href="{{ route('library.search', ['query' => '']) }}" class="px-3 py-1.5 text-emerald-50 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-xs font-medium {{ request()->routeIs('library.search') ? 'bg-white/15 text-white shadow-lg' : '' }}">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Browse Books
                    </span>
                </a>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 text-emerald-50 hover:text-white hover:bg-white/10 rounded-lg transition-all duration-300 text-xs font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white shadow-lg' : '' }}">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                            </svg>
                            Dashboard
                        </span>
                    </a>
                @endauth
            </div>

            <!-- Right Side: Auth Links (Desktop) -->
            <div class="hidden sm:flex items-center space-x-2">
                @auth
                    <!-- User Info -->
                    <div class="hidden md:flex items-center gap-2 px-2.5 py-1.5 bg-white/10 rounded-lg">
                        <div class="w-7 h-7 bg-gradient-to-br from-amber-400 to-orange-500 rounded-md flex items-center justify-center text-white font-bold text-xs shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="text-left">
                            <p class="text-xs font-semibold text-white leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-emerald-200 leading-tight truncate max-w-[100px]">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="flex items-center gap-1.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                @else
                    <!-- Login Button -->
                    <a href="{{ route('login') }}" class="flex items-center gap-1.5 px-3 py-1.5 text-emerald-700 bg-white hover:bg-emerald-50 rounded-lg text-xs font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Login
                    </a>

                    <!-- Register Button -->
                    <a href="{{ route('register') }}" class="flex items-center gap-1.5 bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-500 hover:to-orange-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-9a3 3 0 11-6 0 3 3 0 016 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="flex items-center sm:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 rounded-lg text-emerald-100 hover:text-white hover:bg-white/10 transition-all">
                    <!-- Hamburger Icon -->
                    <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <!-- Close Icon -->
                    <svg x-show="mobileMenuOpen" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- ✅ Mobile Menu Dropdown (x-cloak যোগ করা হয়েছে ঝিকমিক বন্ধ করতে) -->
        <div x-show="mobileMenuOpen"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             @click.away="mobileMenuOpen = false"
             class="sm:hidden border-t border-emerald-700/30 bg-emerald-900/95 backdrop-blur-md">

            <div class="px-4 py-3 space-y-2">
                <!-- Mobile Navigation Links -->
                <a href="{{ route('library.home') }}" class="flex items-center gap-2 px-3 py-2 text-emerald-50 hover:text-white hover:bg-white/10 rounded-lg transition-all text-sm font-medium {{ request()->routeIs('library.home') ? 'bg-white/15 text-white' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Home
                </a>

                <a href="{{ route('library.search', ['query' => '']) }}" class="flex items-center gap-2 px-3 py-2 text-emerald-50 hover:text-white hover:bg-white/10 rounded-lg transition-all text-sm font-medium {{ request()->routeIs('library.search') ? 'bg-white/15 text-white' : '' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    Browse Books
                </a>

                @auth
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-3 py-2 text-emerald-50 hover:text-white hover:bg-white/10 rounded-lg transition-all text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Dashboard
                    </a>

                    <!-- Mobile User Info -->
                    <div class="flex items-center gap-2 px-3 py-2 bg-white/10 rounded-lg mt-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-amber-400 to-orange-500 rounded-md flex items-center justify-center text-white font-bold text-sm shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-white leading-tight truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-emerald-200 leading-tight truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <!-- Mobile Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white px-3 py-2 rounded-lg text-sm font-semibold transition-all shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                @else
                    <!-- Mobile Login Button -->
                    <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 px-3 py-2 text-emerald-700 bg-white hover:bg-emerald-50 rounded-lg text-sm font-semibold transition-all shadow-lg mt-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Login
                    </a>

                    <!-- Mobile Register Button -->
                    <a href="{{ route('register') }}" class="flex items-center justify-center gap-2 bg-gradient-to-r from-amber-400 to-orange-500 hover:from-amber-500 hover:to-orange-600 text-white px-3 py-2 rounded-lg text-sm font-semibold transition-all shadow-lg">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-9a3 3 0 11-6 0 3 3 0 016 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
