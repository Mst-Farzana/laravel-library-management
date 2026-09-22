<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'member_id',
        'user_id',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
        'fine',
        'notes',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    // ✅ Book Relationship
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // ✅ Member Relationship
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // ✅ User Relationship
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
