<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BorrowRequest extends Model
{
    use HasFactory, Notifiable;
    const STATUS_APPROVED = 'approved';
    const STATUS_PENDING = 'pending';
    protected $fillable = ['user_id', 'book_id', 'status',
        'requested_at','admin_id',
        'processed_at',];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(PhysicalBook::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
