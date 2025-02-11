<?php

namespace App\Models;

use App\Models\OnlineBook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    // Relationship with books
    public function Onlinebooks()
    {
        return $this->hasMany(OnlineBook::class);
    }
    public function physicalBooks()
    {
        return $this->hasMany(PhysicalBook::class);
    }
}
