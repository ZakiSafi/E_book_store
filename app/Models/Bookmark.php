<?php

namespace App\Models;
use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['book_id','user_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function book(){
        return $this->belongsTo(Book::class);
    }

}
