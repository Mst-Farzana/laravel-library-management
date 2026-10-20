<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LibraryBorrowTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_cannot_borrow_the_same_book_twice(): void
    {
        $user = User::factory()->create();
        $book = $this->createBook();

        $this->actingAs($user)
            ->from(route('books.show', $book))
            ->post(route('books.borrow', $book))
            ->assertRedirect(route('books.show', $book))
            ->assertSessionHas('success');

        $this->actingAs($user)
            ->from(route('books.show', $book))
            ->post(route('books.borrow', $book))
            ->assertRedirect(route('books.show', $book))
            ->assertSessionHas('error');

        $this->assertDatabaseCount('borrows', 1);
        $this->assertSame(1, $book->fresh()->available_copies);
    }

    public function test_a_borrowed_book_can_only_be_returned_once(): void
    {
        $user = User::factory()->create();
        $book = $this->createBook(totalCopies: 2, availableCopies: 1);
        $borrow = Borrow::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => now(),
            'due_date' => now()->addDays(14),
            'status' => 'borrowed',
        ]);

        $this->actingAs($user)
            ->from(route('books.show', $book))
            ->post(route('books.return', $borrow))
            ->assertRedirect(route('books.show', $book))
            ->assertSessionHas('success');

        $this->actingAs($user)
            ->from(route('books.show', $book))
            ->post(route('books.return', $borrow))
            ->assertRedirect(route('books.show', $book))
            ->assertSessionHas('error');

        $this->assertSame('returned', $borrow->fresh()->status);
        $this->assertSame(2, $book->fresh()->available_copies);
        $this->assertSame('available', $book->fresh()->status);
    }

    private function createBook(int $totalCopies = 3, int $availableCopies = 2): Book
    {
        $category = Category::create(['name' => 'Fiction']);

        return Book::create([
            'title' => 'Test Book',
            'author' => 'Test Author',
            'isbn' => '9780000000001',
            'category_id' => $category->id,
            'publisher' => 'Test Publisher',
            'published_year' => 2024,
            'total_copies' => $totalCopies,
            'available_copies' => $availableCopies,
            'status' => $availableCopies > 0 ? 'available' : 'unavailable',
        ]);
    }
}
