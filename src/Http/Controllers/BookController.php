<?php

namespace Ilbullo\Books\Http\Controllers;

class BookController extends Controller {

    public function index() {
        return view('books::books.index');
    }
}
