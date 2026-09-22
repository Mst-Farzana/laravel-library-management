<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'membership_id',
        'membership_date',
        'expiry_date',
        'status',
    ];

    // ✅ Borrows Relationship
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
