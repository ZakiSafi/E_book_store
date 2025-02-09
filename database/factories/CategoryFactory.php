<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $categories = [

            'Management and Leadership',
            'Investment and Stock Market',
            'Islamic Banking and Finance',
            'Banking and Finance',
            'Financial Analysis and Planning',
            'Risk Management',
            'Marketing and Sales',
            'Microfinance and Rural Banking',
            'Human Resource Management',
            'Economics',
            'Fraud Detection and Prevention',

        ];
        return [
            'name' => $this->faker->unique()->randomElement($categories),
        ];
    }
}
