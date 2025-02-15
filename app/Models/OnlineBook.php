<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlineBook extends Model
{
    use HasFactory;
    const STATUS_APPROVED = 'approved';
    const STATUS_PENDING = 'pending';
    const STATUS_REJECTED = 'rejected';
    protected $fillable = ['title', 'author', 'category_id', 'cover_image', 'book_file', 'user_id', 'file_type', 'file_size', 'downloads', 'file_path', 'language', 'description', 'release_date', 'edition', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}
