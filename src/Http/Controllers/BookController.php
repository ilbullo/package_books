<?php

namespace Ilbullo\Books\Http\Controllers;

use \Ilbullo\Books\Models\Book;
use Ilbullo\Books\Models\Category;

class BookController extends Controller {

    public function index() {

        $book = Book::all();
        $category = Category::all()->first();
        dd($category->books);
        return view('books::books.index', ['books' => $book]);
    }
}
