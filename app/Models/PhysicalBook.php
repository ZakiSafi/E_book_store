<?php

namespace App\Models;

use App\Models\BorrowedBook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhysicalBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'author',
        'translator',
        'language',
        'publication_year',
        'printing_house',
        'cover_image',
        'edition',
        'copies',
        'shelf_no',
        'available_copies',
        'category_id'
    ];
    public function borrowedBooks()
    {
        return $this->hasMany(BorrowedBook::class);
    }

    public function borrowRequests()
    {
        return $this->hasMany(BorrowRequest::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
