<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalBook extends Model
{
    protected $fillable =[
        'title',
        'author',
        'traqnslator',
        'publication_year',
        'printing_house',
        'edition',
        'copies',
        'available_copies',
    ];
    public function Borrowers(){
        return $this->belongsToMany(User::class,'borrowed_books')
        ->withPivot('borrowed_at','due_date','returned_at','is_returned')
        ->withTimestamps();
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
