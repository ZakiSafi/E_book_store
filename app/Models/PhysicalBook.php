<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalBook extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'translator',
        'publication_year',
        'printing_house',
        'cover_image',
        'edition',
        'copies',
        'shelf_no',
        'available_copies',
    ];
    public function Borrowers()
    {
        return $this->belongsToMany(User::class, 'borrowed_books')
            ->withPivot('borrowed_at', 'due_date', 'returned_at', 'is_returned')
            ->withTimestamps();
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
