<?php

namespace App\Policies;

use App\Models\OnlineBook;
use App\Models\User;

class BookPolicy
{
    public function update(User $user, OnlineBook $book)
    {
        return $user->id === $book->user_id || $user->role === 'admin';
    }

    public function delete(User $user, OnlineBook $book)
    {
        return $user->id === $book->user_id || $user->role === 'admin';
    }
}
