@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Welcome Header -->
        <div class="bg-white rounded-3xl shadow-xl p-8 mb-8">
            <h1 class="text-3xl font-bold text-slate-900 mb-2">
                Welcome back, {{ Auth::user()->name }}!
            </h1>
            <p class="text-slate-600">Library Management System Dashboard</p>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('library.home') }}" class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <h3 class="text-lg font-bold text-slate-900 mb-2">Browse Books</h3>
                <p class="text-slate-600 text-sm">Explore our collection</p>
            </a>

            <a href="{{ route('admin.books.index') }}" class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <h3 class="text-lg font-bold text-slate-900 mb-2">Manage Books</h3>
                <p class="text-slate-600 text-sm">Add, edit or delete books</p>
            </a>

            <a href="{{ route('admin.borrows.index') }}" class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <h3 class="text-lg font-bold text-slate-900 mb-2">Borrow Records</h3>
                <p class="text-slate-600 text-sm">View all borrows</p>
            </a>
        </div>

        <!-- Logout -->
        <div class="mt-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl font-semibold transition-colors">
                    Logout
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
