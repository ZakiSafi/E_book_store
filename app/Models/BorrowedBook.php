<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowedBook extends Model
{
    const STATUS_BORROWED = 'borrowed';
    const STATUS_PENDING = 'pending';
    protected $fillable = ['user_id', 'book_id','admin_id', 'borrowed_at', 'due_date', 'returned_at','status'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function book()
    {
        return $this->belongsTo(PhysicalBook::class);
    }

    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_date' => 'datetime',
        'returned_at' => 'datetime',
    ];
}
