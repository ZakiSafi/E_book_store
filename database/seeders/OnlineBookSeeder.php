<?php

namespace Database\Seeders;

use App\Models\OnlineBook;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OnlineBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OnlineBook::factory()
            ->count(50)
            ->create();
    }
}
