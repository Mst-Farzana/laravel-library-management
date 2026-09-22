<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'category_id',
        'publisher',
        'published_year',
        'total_copies',
        'available_copies',
        'description',
        'cover_image',
        'shelf_location',
        'status',
    ];

    // ✅ Category Relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ✅ Borrow Relationship
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
