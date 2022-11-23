<?php

namespace Ilbullo\Books\Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Ilbullo\Books\Models\Author;
use Ilbullo\Books\Models\Book;
use Ilbullo\Books\Models\BookCategory;
use Ilbullo\Books\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Author::factory(10)->create();
        Category::factory(10)->create();

        foreach(Author::all() as $author) {
            Book::factory(\random_int(1,6))->create(['author_id' => $author->id]);
        }

        foreach(Book::all() as $book) {
            BookCategory::factory(\random_int(1,6))->create(['book_id' => $book->id,'category_id' => Category::inRandomOrder()->first()]);
        }

    }
}
