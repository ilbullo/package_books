<?php

namespace Ilbullo\Books\Database\Factories;

use Ilbullo\Books\Models\Book;
use Ilbullo\Books\Models\BookCategory;
use Ilbullo\Books\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookCategory>
 */
class BookCategoryFactory extends Factory
{

    protected $model = BookCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'category_id' => function() {
                return Category::factory(1)->create();
            },
            'book_id'   => function() {
                return Book::factory(1)->create();
            }
        ];
    }

}
