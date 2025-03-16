<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BorrowRequest extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = ['user_id','book_id','status'];

    public function user(){
        $this->belongsTo(User::class);
    }

    public function book()
    {
        $this->belongsTo(PhysicalBook::class);
    }
}

