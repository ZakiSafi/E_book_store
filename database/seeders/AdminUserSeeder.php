<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // Unique identifier
            [
                'name' => 'Zakiullah',
                'email' => 'zakiullahsafi00@gmail.com',
                'password' => Hash::make('123321'), // Change this password!
                'role' => 'admin', // Assuming you have a 'role' column
            ]
        );
    }
}
