<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'status', 'total_price'];

    // Relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with order items (many-to-many via pivot)
    public function books()
    {
        return $this->belongsToMany(Book::class, 'order_items')->withPivot('quantity', 'price');
    }

    // Relationship with payment (one-to-one)
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
