<?php
// filepath: /c:/xampp/htdocs/E_book_store/database/factories/BookFactory.php
namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

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
            'book7.jfif',
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
        $imagePath = 'images/' . $this->faker->randomElement($images);

        $books = [
            'book1.pdf',
            'book2.pdf',
            'book3.pdf',
            'book4.pdf',
            'book5.pdf',
            'book6.pdf',
            'book7.pdf',
            'book8.pdf',
            'book9.pdf',
            'book11.pdf',
            'book12.pdf',
            'book13.pdf',
            'book14.pdf',
            'book15.pdf',
        ];
        $filePath = 'books/' . $this->faker->randomElement($books);

        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'file_type' => 'pdf',
            'description' => $this->faker->paragraph,
            'book_file' => $this->faker->randomElement($books),
            'downloads' => $this->faker->numberBetween(0, 1000),
            'file_size' => $this->faker->numberBetween(1000, 10000),
            'cover_image' => $imagePath,
            'file_path' => $filePath,
            'language' => $this->faker->randomElement(['English', 'pashto', 'Dari', 'Persian', 'Urdu']),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? \App\Models\User::factory(),
            'release_date' => $this->faker->date(),
            'edition' => $this->faker->numberBetween(0,5)

        ];
    }
}
