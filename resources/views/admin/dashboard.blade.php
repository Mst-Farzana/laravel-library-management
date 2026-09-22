@extends('layouts.app')

@section('content')

<!-- Custom Styles -->
<style>
    [x-cloak] { display: none !important; } /* Alpine.js লোড হওয়ার আগে ঝিকমিক বন্ধ করতে */

    @keyframes slideInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    .stat-card { animation: slideInUp 0.5s ease-out; }
    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    .stat-card:nth-child(5) { animation-delay: 0.5s; }
    .activity-item { animation: slideInUp 0.4s ease-out; }
    .activity-item:nth-child(1) { animation-delay: 0.1s; }
    .activity-item:nth-child(2) { animation-delay: 0.2s; }
    .activity-item:nth-child(3) { animation-delay: 0.3s; }
    .activity-item:nth-child(4) { animation-delay: 0.4s; }
    .icon-float { animation: float 3s ease-in-out infinite; }
    .action-icon:hover { animation: bounce 0.5s ease; }

    .chart-container {
        position: relative;
        height: 180px;
        width: 100%;
    }
</style>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="py-6 bg-gradient-to-br from-gray-50 via-emerald-50/30 to-gray-50 dark:from-gray-900 dark:via-gray-800/50 dark:to-gray-900 min-h-screen transition-colors duration-500">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Welcome Header -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                    <span class="icon-float">📚</span> <!-- 📚 ইমোজি যোগ করা হয়েছে -->
                    <span>Library Dashboard</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400 mt-1 flex items-center gap-2 text-sm">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                    Welcome back, {{ auth()->user()->name }}!
                </p>
            </div>

            <!-- Alpine.js Dark Mode & Notification Wrapper -->
            <div x-data="{
                darkMode: localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
            }"
            x-init="$watch('darkMode', val => {
                localStorage.setItem('theme', val ? 'dark' : 'light');
                if (val) document.documentElement.classList.add('dark');
                else document.documentElement.classList.remove('dark');
            }); if(darkMode) document.documentElement.classList.add('dark');"
            class="flex items-center gap-2">

                <!-- Dark Mode Toggle (Alpine.js) -->
                <button @click="darkMode = !darkMode" class="p-2 rounded-lg bg-white dark:bg-gray-800 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all">
                    <svg x-show="!darkMode" class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg x-show="darkMode" x-cloak class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>

                <!-- Notification Bell (Alpine.js) -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="p-2 rounded-lg bg-white dark:bg-gray-800 shadow-sm border border-gray-200 dark:border-gray-700 hover:shadow-md transition-all relative">
                        <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        @if(isset($overdueBooks) && $overdueBooks > 0)
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 text-white text-[10px] rounded-full flex items-center justify-center font-bold animate-pulse">
                                {{ $overdueBooks }}
                            </span>
                        @endif
                    </button>

                    <!-- Notification Dropdown with Smooth Transition -->
                    <div x-show="open"
                         @click.outside="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute right-0 mt-2 w-72 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-100 dark:border-gray-700 p-3 z-50"
                         x-cloak>
                        <h4 class="font-bold text-gray-900 dark:text-white mb-2 text-sm">Notifications</h4>
                        @if(isset($overdueBooks) && $overdueBooks > 0)
                            <div class="p-2 bg-red-50 dark:bg-red-900/20 rounded-lg mb-2">
                                <p class="text-xs text-red-700 dark:text-red-400 font-medium">{{ $overdueBooks }} books overdue!</p>
                            </div>
                        @endif
                        <div class="p-2 bg-emerald-50 dark:bg-emerald-900/20 rounded-lg">
                            <p class="text-xs text-emerald-700 dark:text-emerald-400 font-medium">Library is running smoothly!</p>
                        </div>
                    </div>
                </div>

                <span class="px-3 py-1.5 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 text-xs text-gray-600 dark:text-gray-400">
                     {{ now()->format('l, F j, Y') }}
                </span>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 mb-6">
            <!-- Total Books -->
            <div class="stat-card bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-xl shadow-lg p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-white">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-medium bg-white/20 px-1.5 py-0.5 rounded-md backdrop-blur-sm">+12%</span>
                </div>
                <p class="text-emerald-100 text-xs font-medium">Total Books</p>
                <p class="text-2xl font-bold mt-0.5 stat-number">{{ $totalBooks ?? 1247 }}</p>
            </div>

            <!-- Available Books -->
            <div class="stat-card bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl shadow-lg p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-white">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-medium bg-white/20 px-1.5 py-0.5 rounded-md backdrop-blur-sm">Active</span>
                </div>
                <p class="text-blue-100 text-xs font-medium">Available</p>
                <p class="text-2xl font-bold mt-0.5 stat-number">{{ $availableBooks ?? 856 }}</p>
            </div>

            <!-- Issued Books -->
            <div class="stat-card bg-gradient-to-br from-orange-500 to-orange-700 rounded-xl shadow-lg p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-white">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-medium bg-white/20 px-1.5 py-0.5 rounded-md backdrop-blur-sm">On-going</span>
                </div>
                <p class="text-orange-100 text-xs font-medium">Issued</p>
                <p class="text-2xl font-bold mt-0.5 stat-number">{{ $issuedBooks ?? 324 }}</p>
            </div>

            <!-- Total Members -->
            <div class="stat-card bg-gradient-to-br from-purple-500 to-purple-700 rounded-xl shadow-lg p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-white">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-medium bg-white/20 px-1.5 py-0.5 rounded-md backdrop-blur-sm">+5%</span>
                </div>
                <p class="text-purple-100 text-xs font-medium">Members</p>
                <p class="text-2xl font-bold mt-0.5 stat-number">{{ $totalMembers ?? 1432 }}</p>
            </div>

            <!-- Overdue Books -->
            <div class="stat-card bg-gradient-to-br from-red-500 to-red-700 rounded-xl shadow-lg p-4 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 text-white">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-9 h-9 bg-white/20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <span class="text-[10px] font-medium bg-white/20 px-1.5 py-0.5 rounded-md backdrop-blur-sm">Alert</span>
                </div>
                <p class="text-red-100 text-xs font-medium">Overdue</p>
                <p class="text-2xl font-bold mt-0.5 stat-number">{{ $overdueBooks ?? 23 }}</p>
            </div>
        </div>

        <!-- Charts Section (Compact) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
            <!-- Borrowing Trends Chart -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-4 hover:shadow-lg transition-all duration-300">
                <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-3">Borrowing Trends</h3>
                <div class="chart-container">
                    <canvas id="borrowingChart"></canvas>
                </div>
            </div>

            <!-- Category Distribution -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-4 hover:shadow-lg transition-all duration-300">
                <h3 class="text-sm font-bold text-gray-900 dark:text-white mb-3">Books by Category</h3>
                <div class="chart-container">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

            <!-- Quick Actions -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-4 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white">Quick Actions</h3>
                        <span class="w-7 h-7 bg-emerald-100 dark:bg-emerald-900/50 rounded-lg flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </span>
                    </div>

                    <div class="space-y-2">
                        <a href="{{ route('admin.books.create') }}" class="group flex items-center p-2.5 rounded-lg bg-gradient-to-r from-emerald-50 to-emerald-50/50 dark:from-emerald-900/20 dark:to-emerald-900/10 hover:from-emerald-100 hover:to-emerald-100/50 dark:hover:from-emerald-900/30 dark:hover:to-emerald-900/20 border border-emerald-100 dark:border-emerald-800 transition-all duration-300 hover:shadow-md">
                            <div class="w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center mr-2.5 shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform action-icon">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white group-hover:text-emerald-700 dark:group-hover:text-emerald-400 text-xs">Add New Book</p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400">Add a book to library</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-emerald-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        <a href="{{ route('admin.members.index') }}" class="group flex items-center p-2.5 rounded-lg bg-gradient-to-r from-blue-50 to-blue-50/50 dark:from-blue-900/20 dark:to-blue-900/10 hover:from-blue-100 hover:to-blue-100/50 dark:hover:from-blue-900/30 dark:hover:to-blue-900/20 border border-blue-100 dark:border-blue-800 transition-all duration-300 hover:shadow-md">
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-2.5 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform action-icon">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-9a3 3 0 11-6 0 3 3 0 016 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white group-hover:text-blue-700 dark:group-hover:text-blue-400 text-xs">Manage Members</p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400">View all members</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        <a href="{{ route('admin.borrows.index') }}" class="group flex items-center p-2.5 rounded-lg bg-gradient-to-r from-purple-50 to-purple-50/50 dark:from-purple-900/20 dark:to-purple-900/10 hover:from-purple-100 hover:to-purple-100/50 dark:hover:from-purple-900/30 dark:hover:to-purple-900/20 border border-purple-100 dark:border-purple-800 transition-all duration-300 hover:shadow-md">
                            <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center mr-2.5 shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform action-icon">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white group-hover:text-purple-700 dark:group-hover:text-purple-400 text-xs">Borrow/Return</p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400">Manage transactions</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-purple-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>

                        <a href="/" class="group flex items-center p-2.5 rounded-lg bg-gradient-to-r from-gray-50 to-gray-50/50 dark:from-gray-700/20 dark:to-gray-700/10 hover:from-gray-100 hover:to-gray-100/50 dark:hover:from-gray-700/30 dark:hover:to-gray-700/20 border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-md">
                            <div class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center mr-2.5 shadow-lg shadow-gray-500/30 group-hover:scale-110 transition-transform action-icon">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 dark:text-white group-hover:text-gray-700 dark:group-hover:text-gray-400 text-xs">View Library</p>
                                <p class="text-[10px] text-gray-500 dark:text-gray-400">Public view</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-4 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white">Recent Activity</h3>
                        <div class="flex items-center gap-2">
                            <span class="w-7 h-7 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Last 24 hours</span>
                        </div>
                    </div>

                    <!-- Activity Timeline -->
                    <div class="space-y-3">
                        @forelse($recentActivities ?? [] as $activity)
                            @php
                                $color = match($activity->status) {
                                    'returned' => 'emerald',
                                    'borrowed' => 'orange',
                                    'overdue' => 'red',
                                    default => 'blue'
                                };

                                if ($activity->status === 'returned') {
                                    $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                                    $actionText = 'returned';
                                    $detailText = 'Due date: ' . $activity->due_date->format('M d, Y') . ' • Returned on time';
                                } elseif ($activity->status === 'overdue') {
                                    $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>';
                                    $actionText = 'is overdue on';
                                    $daysOverdue = now()->diffInDays($activity->due_date);
                                    $detailText = 'Due date: ' . $activity->due_date->format('M d, Y') . ' • ' . $daysOverdue . ' days overdue';
                                } else {
                                    $icon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                                    $actionText = 'borrowed';
                                    $detailText = 'Due date: ' . $activity->due_date->format('M d, Y') . ' • 14 days';
                                }
                            @endphp

                            <div class="activity-item flex items-start gap-3 p-3 rounded-lg bg-gradient-to-r from-{{ $color }}-50/50 dark:from-{{ $color }}-900/20 to-transparent border-l-4 border-{{ $color }}-500 hover:shadow-md transition-all">
                                <div class="w-8 h-8 bg-{{ $color }}-100 dark:bg-{{ $color }}-900/50 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-{{ $color }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        {!! $icon !!}
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-0.5">
                                        <p class="font-semibold text-gray-900 dark:text-white capitalize text-xs">Book {{ $activity->status }}</p>
                                        <span class="text-[10px] text-gray-500 dark:text-gray-400">{{ $activity->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        <span class="font-medium text-{{ $color }}-600">{{ $activity->user->name ?? 'Unknown User' }}</span>
                                        {{ $actionText }}
                                        <span class="font-medium">"{{ $activity->book->title ?? 'Unknown Book' }}"</span>
                                    </p>
                                    <p class="text-[10px] text-gray-500 dark:text-gray-400 mt-0.5">{{ $detailText }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <svg class="w-10 h-10 mx-auto text-gray-300 dark:text-gray-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-xs">No recent activity found.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- View All Button -->
                    <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('admin.borrows.index') }}" class="flex items-center justify-center gap-2 w-full py-2 px-3 bg-gradient-to-r from-emerald-50 to-emerald-50 dark:from-emerald-900/20 dark:to-emerald-900/10 hover:from-emerald-100 hover:to-emerald-100/50 dark:hover:from-emerald-900/30 dark:hover:to-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-lg text-emerald-700 dark:text-emerald-400 font-semibold text-xs transition-all hover:shadow-md">
                            View All Activity
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
// Animated Counter
function animateValue(element, start, end, duration) {
    let startTimestamp = null;
    const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const value = Math.floor(progress * (end - start) + start);
        element.textContent = value.toLocaleString();
        if (progress < 1) {
            window.requestAnimationFrame(step);
        }
    };
    window.requestAnimationFrame(step);
}

// Initialize animations when page loads
document.addEventListener('DOMContentLoaded', () => {
    // Animate stat numbers
    document.querySelectorAll('.stat-number').forEach(el => {
        const finalValue = parseInt(el.textContent.replace(/,/g, ''));
        animateValue(el, 0, finalValue, 1000);
    });

    // Borrowing Chart (Compact)
    const ctx1 = document.getElementById('borrowingChart');
    if (ctx1) {
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Books Borrowed',
                    data: [65, 59, 80, 81, 56, 55], // পরে এটি @json($borrowingData) দিয়ে রিপ্লেস করতে পারেন
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointRadius: 3,
                    pointHoverRadius: 5,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 8,
                        cornerRadius: 6,
                        titleFont: { size: 11 },
                        bodyFont: { size: 11 }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: document.documentElement.classList.contains('dark') ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.03)'
                        },
                        ticks: {
                            font: { size: 10 },
                            color: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#6b7280'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { size: 10 },
                            color: document.documentElement.classList.contains('dark') ? '#9ca3af' : '#6b7280'
                        }
                    }
                }
            }
        });
    }

    // Category Chart (Compact)
    const ctx2 = document.getElementById('categoryChart');
    if (ctx2) {
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Fiction', 'Science', 'History', 'Technology'], // পরে এটি @json($categoryData) দিয়ে রিপ্লেস করতে পারেন
                datasets: [{
                    data: [30, 25, 20, 25],
                    backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6'],
                    borderWidth: 2,
                    borderColor: document.documentElement.classList.contains('dark') ? '#1f2937' : '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: document.documentElement.classList.contains('dark') ? '#fff' : '#000',
                            padding: 10,
                            font: { size: 10 },
                            boxWidth: 12
                        }
                    }
                }
            }
        });
    }
});
</script>

@endsection
