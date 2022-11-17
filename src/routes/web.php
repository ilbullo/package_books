<?php

use Ilbullo\Books\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('books', [BookController::class, 'index']);
