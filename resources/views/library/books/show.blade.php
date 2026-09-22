@extends('layouts.app')

@section('content')

<!-- Custom Styles -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.6s ease-out;
    }
</style>

<div class="py-12 bg-gradient-to-b from-white via-emerald-50/40 to-white dark:from-gray-900 dark:via-gray-800/50 dark:to-gray-900 min-h-screen transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <div class="mb-6 animate-fade-in">
            <a href="{{ route('library.home') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Library
            </a>
        </div>

        <!-- Book Details Card -->
        <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden animate-fade-in transition-colors duration-300">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">

                <!-- Book Cover -->
                <div class="flex items-center justify-center">
                    @if($book->cover_image)
                        <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="max-h-96 rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-48 h-72 bg-gradient-to-br from-emerald-400 to-emerald-600 dark:from-emerald-500 dark:to-emerald-700 rounded-2xl flex items-center justify-center shadow-2xl">
                            <svg class="w-20 h-20 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                    @endif
                </div>

                <!-- Book Info -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $book->title }}</h1>
                    <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">by {{ $book->author }}</p>

                    <!-- Status Badge -->
                    <div class="mb-6">
                        @if($book->available_copies > 0)
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 rounded-xl font-semibold border border-emerald-200 dark:border-emerald-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $book->available_copies }} Available
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 px-4 py-2 bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300 rounded-xl font-semibold border border-red-200 dark:border-red-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Currently Unavailable
                            </span>
                        @endif
                    </div>

                    <!-- Book Details Grid -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 border border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Category</p>
                            <p class="text-base font-bold text-gray-900 dark:text-white mt-1">{{ $book->category->name ?? 'Uncategorized' }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 border border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Publisher</p>
                            <p class="text-base font-bold text-gray-900 dark:text-white mt-1">{{ $book->publisher ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 border border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Published Year</p>
                            <p class="text-base font-bold text-gray-900 dark:text-white mt-1">{{ $book->published_year ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 border border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">ISBN</p>
                            <p class="text-base font-bold text-gray-900 dark:text-white mt-1">{{ $book->isbn ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 border border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Total Copies</p>
                            <p class="text-base font-bold text-gray-900 dark:text-white mt-1">{{ $book->total_copies ?? 0 }}</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 border border-gray-100 dark:border-gray-700">
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase font-semibold">Shelf Location</p>
                            <p class="text-base font-bold text-gray-900 dark:text-white mt-1">{{ $book->shelf_location ?? 'Not specified' }}</p>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($book->description)
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Description</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $book->description }}</p>
                        </div>
                    @endif

                    <!-- Borrow Button -->
                    <div class="flex gap-3">
                        @auth
                            @if($book->available_copies > 0)
                                <form action="{{ route('books.borrow', $book) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                        Borrow This Book
                                    </button>
                                </form>
                            @else
                                <button disabled class="inline-flex items-center gap-2 bg-gray-300 dark:bg-gray-700 text-gray-500 dark:text-gray-400 px-6 py-3 rounded-xl font-semibold cursor-not-allowed">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                    </svg>
                                    Not Available
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 dark:bg-emerald-500 dark:hover:bg-emerald-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                Login to Borrow
                            </a>
                        @endauth

                        <a href="{{ route('library.home') }}" class="inline-flex items-center gap-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 px-6 py-3 rounded-xl font-semibold transition-all duration-300">
                            Back to Library
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
