<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DemoBookSeeder extends Seeder
{
    public function run(): void
    {
        // Categories তৈরি
        $categories = [
            'Fiction',
            'Non-Fiction',
            'Science',
            'Technology',
            'History',
            'Biography',
            'Programming',
            'Business',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'description' => "Books about {$category}",
            ]);
        }

        // Demo Books with 100% Working Cover Images
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'isbn' => '9780743273565',
                'category_id' => 1,
                'publisher' => 'Scribner',
                'published_year' => 1925,
                'total_copies' => 5,
                'available_copies' => 3,
                'description' => 'A classic American novel about the Jazz Age',
                'cover_image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=400&h=600&fit=crop',
                'shelf_location' => 'A-1-1',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'isbn' => '9780061120084',
                'category_id' => 1,
                'publisher' => 'Harper Perennial',
                'published_year' => 1960,
                'total_copies' => 4,
                'available_copies' => 2,
                'description' => 'A powerful story of racial injustice',
                'cover_image' => 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=400&h=600&fit=crop',
                'shelf_location' => 'A-1-2',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'isbn' => '9780451524935',
                'category_id' => 1,
                'publisher' => 'Signet Classic',
                'published_year' => 1949,
                'total_copies' => 6,
                'available_copies' => 4,
                'description' => 'A dystopian social science fiction novel',
                'cover_image' => 'https://images.unsplash.com/photo-1535905557558-afc4877a26fc?w=400&h=600&fit=crop', // ✅ আপডেটেড লিঙ্ক
                'shelf_location' => 'A-2-1',
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'isbn' => '9780132350884',
                'category_id' => 7,
                'publisher' => 'Prentice Hall',
                'published_year' => 2008,
                'total_copies' => 3,
                'available_copies' => 1,
                'description' => 'A Handbook of Agile Software Craftsmanship',
                'cover_image' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=400&h=600&fit=crop', // ✅ আপডেটেড লিঙ্ক
                'shelf_location' => 'T-1-1',
            ],
            [
                'title' => 'The Pragmatic Programmer',
                'author' => 'Andrew Hunt, David Thomas',
                'isbn' => '9780201616224',
                'category_id' => 7,
                'publisher' => 'Addison-Wesley',
                'published_year' => 1999,
                'total_copies' => 4,
                'available_copies' => 3,
                'description' => 'Your Journey to Mastery',
                'cover_image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=400&h=600&fit=crop',
                'shelf_location' => 'T-1-2',
            ],
            [
                'title' => 'Sapiens: A Brief History of Humankind',
                'author' => 'Yuval Noah Harari',
                'isbn' => '9780062316097',
                'category_id' => 5,
                'publisher' => 'Harper',
                'published_year' => 2011,
                'total_copies' => 5,
                'available_copies' => 2,
                'description' => 'From the dawn of evolution to the present',
                'cover_image' => 'https://images.unsplash.com/photo-1465101162946-4377e57745c3?w=400&h=600&fit=crop',
                'shelf_location' => 'H-1-1',
            ],
            [
                'title' => 'Atomic Habits',
                'author' => 'James Clear',
                'isbn' => '9780735211292',
                'category_id' => 8,
                'publisher' => 'Avery',
                'published_year' => 2018,
                'total_copies' => 7,
                'available_copies' => 5,
                'description' => 'An Easy & Proven Way to Build Good Habits',
                'cover_image' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?w=400&h=600&fit=crop',
                'shelf_location' => 'B-1-1',
            ],
            [
                'title' => 'Thinking, Fast and Slow',
                'author' => 'Daniel Kahneman',
                'isbn' => '9780374533557',
                'category_id' => 2,
                'publisher' => 'Farrar, Straus and Giroux',
                'published_year' => 2011,
                'total_copies' => 3,
                'available_copies' => 1,
                'description' => 'The two systems that drive the way we think',
                'cover_image' => 'https://images.unsplash.com/photo-1516979187457-637abb4f9353?w=400&h=600&fit=crop',
                'shelf_location' => 'N-1-1',
            ],
            [
                'title' => 'A Brief History of Time',
                'author' => 'Stephen Hawking',
                'isbn' => '9780553380163',
                'category_id' => 3,
                'publisher' => 'Bantam',
                'published_year' => 1988,
                'total_copies' => 4,
                'available_copies' => 2,
                'description' => 'From the Big Bang to black holes',
                'cover_image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=400&h=600&fit=crop',
                'shelf_location' => 'S-1-1',
            ],
            [
                'title' => 'The Lean Startup',
                'author' => 'Eric Ries',
                'isbn' => '9780307887894',
                'category_id' => 8,
                'publisher' => 'Crown Business',
                'published_year' => 2011,
                'total_copies' => 5,
                'available_copies' => 4,
                'description' => 'How Today\'s Entrepreneurs Use Continuous Innovation',
                'cover_image' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=400&h=600&fit=crop',
                'shelf_location' => 'B-2-1',
            ],
            [
                'title' => 'Laravel: Up & Running',
                'author' => 'Matt Stauffer',
                'isbn' => '9781492041214',
                'category_id' => 7,
                'publisher' => 'O\'Reilly Media',
                'published_year' => 2019,
                'total_copies' => 3,
                'available_copies' => 2,
                'description' => 'A Framework for Building PHP Applications',
                'cover_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop',
                'shelf_location' => 'T-2-1',
            ],
            [
                'title' => 'Steve Jobs',
                'author' => 'Walter Isaacson',
                'isbn' => '9781451648539',
                'category_id' => 6,
                'publisher' => 'Simon & Schuster',
                'published_year' => 2011,
                'total_copies' => 4,
                'available_copies' => 3,
                'description' => 'The exclusive biography of Steve Jobs',
                'cover_image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=400&h=600&fit=crop',
                'shelf_location' => 'BIO-1-1',
            ],
        ];

        foreach ($books as $book) {
            $book['status'] = $book['available_copies'] > 0 ? 'available' : 'unavailable';
            Book::create($book);
        }

        $this->command->info('✅ Demo books and categories created successfully!');
    }
}
