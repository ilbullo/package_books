<?php

use Ilbullo\Books\Helpers\BookLink;
use Ilbullo\Books\Http\Controllers\BookController;
use Ilbullo\Books\Http\Livewire\Authors;
use Ilbullo\Books\Http\Livewire\Categories;
use Ilbullo\Books\Http\Livewire\Books;
use Ilbullo\Books\Models\Book;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'middleware' => "web"
    ],
    function () {
        Route::get('books',[BookController::class,'index'])->name('ilbullo.books.books.index');
        Route::get('authors',Authors::class)->name('ilbullo.books.authors');
        Route::get('categories',Categories::class)->name('ilbullo.books.categories');

    }
);



