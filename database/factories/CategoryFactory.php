<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categroy>
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
        $categories =[
            'Banking and Finance',
            'Investment and Stock Market',
            'Accounting and Auditing',
            'Economics',
            'Law and Regulations',
            'Management and Leadership',
            'Business Development',
            'Marketing and Sales',
            'Technology in Banking',
            'Islamic Banking and Finance',
            'Risk Management',
            'Customer Relationship Management (CRM)',
            'Corporate Social Responsibility (CSR)',
            'Financial Analysis and Planning',
            'Digital Transformation in Banking',
            'Data Analytics and Big Data in Finance',
            'Human Resource Management',
            'Fraud Detection and Prevention',
            'International Banking',
            'Microfinance and Rural Banking'
        ];
        return [

            'name' => $this->faker->unique()->randomElement($categories),
            // 'description' => $this->faker->sentence(),
        ];
    }
}
