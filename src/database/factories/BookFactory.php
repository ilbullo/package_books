<?php

namespace Ilbullo\Books\Database\Factories;

use Ilbullo\Books\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ilbullo\Books\Models\Book;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'     => $this->faker->sentence(),
            'author_id' => function() {
                            return Author::factory()->create();
                        },
            'path'      => $this->faker->url()
        ];
    }
}
