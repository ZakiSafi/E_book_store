<?php

namespace Database\Seeders;

use App\Models\Order_item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order_item::factory()
            ->count(10)
            ->create();
    }
}
