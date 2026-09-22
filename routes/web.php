<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Models\Category;

// লাইব্রেরি হোমপেজ - বইয়ের তালিকা
Route::get('/', function () {
    $books = Book::with('category')->where('available_copies', '>', 0)->paginate(12);
    return view('library.home', compact('books'));
})->name('library.home');

// বইয়ের বিস্তারিত
Route::get('/books/{id}', function ($id) {
    $book = Book::with('category')->findOrFail($id);
    return view('library.books.show', compact('book'));
})->name('books.show');

// বই খোঁজা (Search)
Route::get('/search', function (\Illuminate\Http\Request $request) {
    $query = $request->input('query');

    if ($query) {
        $books = Book::where('title', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
            ->orWhere('isbn', 'LIKE', "%{$query}%")
            ->paginate(12);

        return view('library.search', compact('books', 'query'));
    }

    return redirect('/');
})->name('library.search');

// ==========================================
//  BORROW BOOK ROUTE (লগইন প্রয়োজন, কিন্তু Admin নয়)
// ==========================================
Route::middleware(['auth'])->post('/books/{id}/borrow', function ($id) {
    $book = \App\Models\Book::findOrFail($id);

    // ১. চেক করুন বইটি available কিনা
    if ($book->available_copies <= 0) {
        return redirect()->back()->with('error', 'দুঃখিত, এই বইটি বর্তমানে অনুপলব্ধ।');
    }

    // . চেক করুন ব্যবহারকারী ইতিমধ্যে এই বইটি ধার নিয়েছেন কিনা
    $existingBorrow = \App\Models\Borrow::where('user_id', auth()->id())
        ->where('book_id', $book->id)
        ->where('status', 'borrowed')
        ->first();

    if ($existingBorrow) {
        return redirect()->back()->with('error', 'আপনি ইতিমধ্যে এই বইটি ধার নিয়েছেন।');
    }

    // ৩. নতুন Borrow রেকর্ড তৈরি করুন
    \App\Models\Borrow::create([
        'user_id' => auth()->id(),
        'book_id' => $book->id,
        'borrow_date' => now(),
        'due_date' => now()->addDays(14),
        'status' => 'borrowed',
    ]);

    // ৪. বইয়ের available_copies ১ কমান
    $book->decrement('available_copies');

    // ৫. যদি available_copies ০ হয়ে যায়, স্ট্যাটাস আপডেট করুন
    if ($book->available_copies == 0) {
        $book->update(['status' => 'unavailable']);
    }

    // ৬. সফল মেসেজ
    return redirect()->back()->with('success', ' বইটি সফলভাবে ধার নেওয়া হয়েছে! ফেরত দেওয়ার শেষ তারিখ: ' . now()->addDays(14)->format('d M, Y'));
})->name('books.borrow');

// ==========================================
// 📚 RETURN BOOK ROUTE (ঐচ্ছিক - ভবিষ্যতে কাজে লাগবে)
// ==========================================
Route::middleware(['auth'])->post('/borrows/{id}/return', function ($id) {
    $borrow = \App\Models\Borrow::findOrFail($id);

    if ($borrow->user_id !== auth()->id()) {
        abort(403, 'অনুমতি নেই');
    }

    $borrow->update([
        'return_date' => now(),
        'status' => 'returned',
    ]);

    $borrow->book->increment('available_copies');

    return redirect()->back()->with('success', 'বইটি সফলভাবে ফেরত দেওয়া হয়েছে!');
})->name('books.return');

// Admin Routes (লগইন প্রয়োজন)
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // ✅ পরিবর্তন করা হয়েছে: Dashboard Route - নতুন ভেরিয়েবল যোগ করা হয়েছে
    Route::get('/dashboard', function () {
        $totalBooks = Book::count();
        $availableBooks = Book::where('available_copies', '>', 0)->count();
        $issuedBooks = \App\Models\Borrow::where('status', 'borrowed')->count();
        $totalMembers = \App\Models\Member::count();
        $overdueBooks = \App\Models\Borrow::where('status', 'borrowed')
            ->where('due_date', '<', now())->count();

        // ✅ নতুন যোগ করা হয়েছে: Recent Activities
        $recentActivities = \App\Models\Borrow::with(['book', 'user'])
            ->latest()
            ->take(4)
            ->get();

        // ✅ নতুন যোগ করা হয়েছে: Borrowing Data for Chart (গত ৬ মাস)
        $borrowingData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('M');

            $count = \App\Models\Borrow::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

            $borrowingData[] = [
                'month' => $monthName,
                'count' => $count
            ];
        }

        // ✅ নতুন যোগ করা হয়েছে: Category Data for Chart
        $categoryData = \App\Models\Book::select('category_id', \Illuminate\Support\Facades\DB::raw('count(*) as count'))
            ->groupBy('category_id')
            ->with('category')
            ->get();

        // ✅ পরিবর্তন করা হয়েছে: compact() এ নতুন ভেরিয়েবল যোগ করা হয়েছে
        return view('admin.dashboard', compact(
            'totalBooks',
            'availableBooks',
            'issuedBooks',
            'totalMembers',
            'overdueBooks',
            'recentActivities',   // ✅ নতুন যোগ করা হয়েছে
            'borrowingData',      // ✅ নতুন যোগ করা হয়েছে
            'categoryData'        // ✅ নতুন যোগ করা হয়েছে
        ));
    })->name('admin.dashboard');

    // Books Management
    Route::get('/books', function () {
        $books = \App\Models\Book::with('category')->paginate(15);
        return view('admin.books.index', compact('books'));
    })->name('admin.books.index');

    Route::get('/books/create', function () {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    })->name('admin.books.create');

    Route::post('/books', function (\Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|unique:books,isbn',
            'category_id' => 'required|exists:categories,id',
            'publisher' => 'required|string|max:255',
            'published_year' => 'required|integer',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'shelf_location' => 'nullable|string',
        ]);

        $validated['status'] = $validated['available_copies'] > 0 ? 'available' : 'unavailable';

        Book::create($validated);

        return redirect()->route('admin.books.index')->with('success', 'Book added successfully!');
    })->name('admin.books.store');

    Route::get('/books/{id}/edit', function ($id) {
        $book = \App\Models\Book::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    })->name('admin.books.edit');

    Route::put('/books/{id}', function ($id, \Illuminate\Http\Request $request) {
        $book = \App\Models\Book::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
            'category_id' => 'required|exists:categories,id',
            'publisher' => 'required|string|max:255',
            'published_year' => 'required|integer',
            'total_copies' => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'shelf_location' => 'nullable|string',
        ]);

        $validated['status'] = $validated['available_copies'] > 0 ? 'available' : 'unavailable';

        $book->update($validated);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully!');
    })->name('admin.books.update');

    // Members Management
    Route::get('/members', function () {
        $members = \App\Models\Member::paginate(10);
        return view('admin.member.index', compact('members'));
    })->name('admin.members.index');

    // Borrow/Return Management
    Route::get('/borrows', function () {
        $borrows = \App\Models\Borrow::with(['book', 'member', 'user'])->latest()->paginate(15);
        return view('admin.borrow.index', compact('borrows'));
    })->name('admin.borrows.index');
});

// Dashboard (Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
