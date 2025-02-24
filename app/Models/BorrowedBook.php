<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    protected $fillable = ['user_id', 'book_id', 'borrowed_at', 'due_date', 'returned_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function book()
    {
        return $this->belongsTo(PhysicalBook::class);
    }
}
