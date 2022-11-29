<?php

namespace Ilbullo\Books\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        return view('books::books.index');
    }
}
