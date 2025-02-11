<?php

namespace Database\Seeders;

use App\Models\PhysicalBook;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PhysicalBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PhysicalBook::factory()
            ->count(50)
            ->create();
    }
}
