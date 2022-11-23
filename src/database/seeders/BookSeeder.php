<?php

namespace Ilbullo\Books\Database\Seeders;

use Ilbullo\Books\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return Book::factory(10)->create();
    }
}
