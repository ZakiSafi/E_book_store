<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'password', 'role', 'last_login_at', 'profile_picture'];

    // Relationship with orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relationship with books added by the user
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // Relationship with carts (many-to-many via pivot)
    public function booksInCart()
    {
        return $this->belongsToMany(Book::class, 'carts')->withPivot('quantity');
    }

    // Relationship with wishlists (many-to-many via pivot)
    public function booksInWishlist()
    {
        return $this->belongsToMany(Book::class, 'wishlists');
    }

    // relationship with bookmark
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime', // Add this line
        ];
    }
}
