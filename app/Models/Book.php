<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author', 'category_id', 'cover_image', 'book_file', 'user_id', 'file_type', 'file_size', 'downloads', 'file_path', 'language','description','release_date','edition'];

    // Relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with reviews
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function relatedBooks(){
        return $this->category->books()->where('id', '!=',$this->id)->take(8);
    }

    // Relationship with users (many-to-many via pivot for wishlist)
    public function usersWithWishlist()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }
    public function bookmarks() {
        return $this->hasMany(Bookmark::class);
    }
}
