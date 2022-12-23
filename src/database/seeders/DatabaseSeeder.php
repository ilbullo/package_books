<?php

namespace Ilbullo\Books\Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Ilbullo\Books\Models\Author;
use Ilbullo\Books\Models\Book;
use Ilbullo\Books\Models\BookCategory;
use Ilbullo\Books\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * TO RUN SEEDER: php artisan db:seed --class=Ilbullo\\Books\\Database\\Seeders\\DatabaseSeeder
     *
     * @return void
     */
    public function run()
    {
        /*****  TEST DATA!! ***/
        Author::factory(10)->create();
        Category::factory(10)->create();

        foreach(Author::all() as $author) {
            Book::factory(\random_int(1,6))->create(['author_id' => $author->id]);
        }

        foreach(Book::all() as $book) {
            BookCategory::factory(\random_int(1,6))->create(['book_id' => $book->id,'category_id' => Category::inRandomOrder()->first()]);
        }
        /** END TEST DATA ***/

    }
}
