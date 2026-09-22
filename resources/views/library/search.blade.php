@extends('layouts.app')

@section('content')

<!-- Custom Animations -->
<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes float1 {
        0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.6; }
        50% { transform: translateY(-20px) rotate(5deg); opacity: 0.9; }
    }
    @keyframes float3 {
        0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 0.4; }
        50% { transform: translateY(-15px) rotate(10deg); opacity: 0.7; }
    }
    .animate-fade-in { animation: fadeInUp 0.6s ease-out; }
    .float-book-1 { animation: float1 6s ease-in-out infinite; }
    .float-book-3 { animation: float3 5s ease-in-out infinite 1s; }
</style>

<div class="min-h-screen bg-gradient-to-b from-white via-emerald-50/40 to-white dark:from-gray-900 dark:via-gray-800/50 dark:to-gray-900 transition-colors duration-500 relative overflow-hidden">

    <!-- Decorative Background Blobs -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-200/40 dark:bg-emerald-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-60 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-teal-200/40 dark:bg-teal-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-3xl opacity-60 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 relative z-10">

        <!-- Header -->
        <div class="mb-8 animate-fade-in">
            <a href="{{ route('library.home') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors font-medium mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Library
            </a>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Search Results</h1>
            <p class="text-gray-600 dark:text-gray-400">
                Showing results for: <span class="font-semibold text-emerald-600 dark:text-emerald-400">"{{ $query }}"</span>
                <span class="text-gray-500 dark:text-gray-500">({{ $books->total() }} found)</span>
            </p>
        </div>

        <!-- Search Form -->
        <form action="{{ route('library.search') }}" method="GET" class="mb-10 animate-fade-in" style="animation-delay: 0.1s;">
            <div class="bg-white/90 dark:bg-gray-800/90 backdrop-blur-md p-2 rounded-2xl shadow-xl border border-emerald-200/50 dark:border-emerald-700/50 flex flex-col md:flex-row gap-2 transition-colors duration-300">
                <div class="flex-1 relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input
                        type="text"
                        name="query"
                        placeholder="Search by title, author, or ISBN..."
                        value="{{ $query }}"
                        class="w-full pl-12 pr-4 py-3.5 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl border border-gray-200 dark:border-gray-600 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition-all"
                        required
                    >
                </div>
                <button type="submit" class="bg-emerald-600 dark:bg-emerald-500 hover:bg-emerald-700 dark:hover:bg-emerald-600 text-white px-8 py-3.5 rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Search
                </button>
            </div>
        </form>

        @if($books->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($books as $index => $book)
                <a href="{{ route('books.show', $book->id) }}"
                   class="group bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 animate-fade-in"
                   style="animation-delay: {{ 0.1 + ($index * 0.05) }}s;">

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
            <div class="mt-12 flex justify-center animate-fade-in" style="animation-delay: 0.3s;">
                {{ $books->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20 bg-white/60 dark:bg-gray-800/50 backdrop-blur-sm rounded-3xl border border-dashed border-gray-300 dark:border-gray-700 relative overflow-hidden shadow-sm transition-colors duration-300 animate-fade-in">
                <!-- Floating books in empty state -->
                <div class="float-book-1 absolute top-10 left-20 opacity-20"><div class="w-10 h-14 bg-emerald-400 rounded-md"></div></div>
                <div class="float-book-3 absolute bottom-10 right-20 opacity-20"><div class="w-8 h-12 bg-blue-400 rounded-md"></div></div>

                <div class="relative z-10">
                    <div class="w-24 h-24 mx-auto mb-6 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center shadow-inner">
                        <svg class="w-12 h-12 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 transition-colors duration-300">No results found</h3>
                    <p class="text-gray-500 dark:text-gray-400 max-w-md mx-auto mb-6 transition-colors duration-300">We couldn't find any books matching "<span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $query }}</span>". Try different keywords.</p>
                    <a href="{{ route('library.home') }}" class="inline-flex items-center gap-2 bg-emerald-600 dark:bg-emerald-500 hover:bg-emerald-700 dark:hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Browse All Books
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection
