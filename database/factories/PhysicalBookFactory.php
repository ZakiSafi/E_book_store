<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhysicalBook>
 */
class PhysicalBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            'book1.jfif',
            'book2.jfif',
            'book3.jfif',
            'book4.jfif',
            'book5.jfif',
            'book6.jfif',
            'book8.jfif',
            'book9.jfif',
            'book10.jfif',
            'book11.jfif',
            'book12.jfif',
            'book13.jfif',
            'book14.jfif',
            'book15.jfif',
            'book16.jfif',
            'book17.jfif',
            'book18.jfif',
            'book19.jfif',
            'book20.jfif',
            'book21.jfif',
            'book23.jfif',
            'book24.jfif',
            'book26.jfif',
            'book27.jfif'

        ];
        $language = ['English',  'Arabic', 'Urdu', 'Pashto', 'Farsi', 'Dari'];
        $imagePath = 'physical_books_images/' . $this->faker->randomElement($images);
        return [
            'title' => $this->faker->sentence(2),
            'author' => $this->faker->name(),
            'language' => $this->faker->randomElement($language),
            'translator' => $this->faker->name(),
            'cover_image' => $imagePath,
            'printing_house' => $this->faker->company(),
            'publication_year' => $this->faker->year(),
            'edition' => $this->faker->numberBetween(1, 5),
            'copies' => $this->faker->numberBetween(1, 5),
            'available_copies' => $this->faker->numberBetween(1, 5),
            'shelf_no' => $this->faker->numberBetween(1, 20),
            'category_id' => Category::inRandomOrder()->value('id') ?? 1,
        ];
    }
}
