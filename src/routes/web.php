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

        Route::get('loadCat', function() {

            $books = \Ilbullo\Books\Models\Book::where('author_id',96)->get();
            foreach($books as $book) {
                $category = new \Ilbullo\Books\Models\BookCategory();
                $category->book_id = $book->id;
                $category->category_id = 2;
                $category->save();
            }
        });

        Route::get('loader', function() {

        //File class
        $fileClass = \Illuminate\Support\Facades\File::class;

        //list all directories
        $directories = \Illuminate\Support\Facades\Storage::directories('public/libri');

        foreach($directories as $directory) {

            //get author name from foldername
            $fullName = explode('/',$directory)[2];
            $authorFullName = explode(" ", $fullName);
            $authorName="";
            $authorLastName="";

            foreach($authorFullName as $key => $name) {
                if($key == 0) {$authorLastName = $name; continue;}
                $authorName .=$name;
            }

            //create author
            $author = \Ilbullo\Books\Models\Author::create(
                [
                    'name'      => $authorName,
                    'lastname'  => $authorLastName
                ]
            );
            $author_path = public_path('storage/libri/'. $fullName);

            $files = $fileClass::allFiles($author_path);

            foreach ($files as $file) {

                //clean filename
                $bookTitle = \Str::remove('(ita)',$file->getFileName());
                $bookTitle = \Str::remove('(z-lib.org)', $bookTitle);
                $bookTitle = \Str::remove($author->name, $bookTitle);
                $bookTitle = \Str::remove($author->lastname, $bookTitle);
                $bookTitle = \Str::remove("Valerio Massimo Manfredi", $bookTitle);
                $bookTitle = \Str::remove("Valerio M. Manfredi", $bookTitle);
                $bookTitle = \Str::remove("Jack Whyte", $bookTitle);
                $bookTitle = \Str::remove("Clare Cassandra", $bookTitle);
                $bookTitle = \Str::remove("DIana Gabaldon", $bookTitle);
                $bookTitle = \Str::remove("Diana Gabaldon", $bookTitle);
                $bookTitle = \Str::remove("Zafon Carlos Ruiz", $bookTitle);
                $bookTitle = \Str::remove("Lindsay Clarke", $bookTitle);
                $bookTitle = \Str::remove("Licia Troisi", $bookTitle);
                $bookTitle = \Str::remove("(Alberto Angela)", $bookTitle);
                $bookTitle = \Str::remove("(Dario Bressanini)", $bookTitle);
                $bookTitle = \Str::remove("Sophie Jordan", $bookTitle);
                $bookTitle = \Str::remove("Ian McEwan", $bookTitle);
                $bookTitle = \Str::remove("Giorgio Ieranò", $bookTitle);
                $bookTitle = \Str::remove("Ieranò, Giorgio", $bookTitle);
                $bookTitle = \Str::remove("JackWhite", $bookTitle);
                $bookTitle = \Str::remove("Rick Riordan", $bookTitle);
                $bookTitle = \Str::remove("Cassandra Clare", $bookTitle);
                $bookTitle = \Str::remove("Lisa Jane Smith", $bookTitle);
                $bookTitle = \Str::remove("Lisa J.Smith", $bookTitle);
                $bookTitle = \Str::remove("(Eco, Umberto)", $bookTitle);
                $bookTitle = \Str::remove("(Umberto Eco)", $bookTitle);
                $bookTitle = \Str::remove("(Walter Isaacson)", $bookTitle);
                $bookTitle = \Str::remove("Bosco Federica", $bookTitle);
                $bookTitle = \Str::remove("Federica Bosco", $bookTitle);
                $bookTitle = \Str::remove("(Elena Maggi)", $bookTitle);
                $bookTitle = \Str::remove("LaurenKate", $bookTitle);
                $bookTitle = \Str::remove("Paolo Giordano", $bookTitle);
                $bookTitle = \Str::remove("(Max Tegmark)", $bookTitle);
                $bookTitle = \Str::remove("(Nick Bostrom)", $bookTitle);
                $bookTitle = \Str::remove("(Keith Devlin)", $bookTitle);
                $bookTitle = \Str::remove("(Kondo, Marie)", $bookTitle);
                $bookTitle = \Str::remove("(Emilie Wapnick [Wapnick, Emilie])", $bookTitle);
                $bookTitle = \Str::remove("(Madeline Miller)", $bookTitle);
                $bookTitle = \Str::remove("Follett Ken", $bookTitle);
                $bookTitle = \Str::remove("Ken Follet", $bookTitle);
                $bookTitle = \Str::remove("(Coelho, Paulo)", $bookTitle);
                $bookTitle = \Str::remove("(Kahlil Gibran [Gibran, Kahlil])", $bookTitle);
                $bookTitle = \Str::remove("(Nassim Nicholas Taleb)", $bookTitle);
                $bookTitle = \Str::remove("(Italian Edition)", $bookTitle);
                $bookTitle = \Str::remove("(Snorri Sturluson)", $bookTitle);
                $bookTitle = \Str::remove("Carlos Ruiz Zafón", $bookTitle);
                $bookTitle = \Str::remove("C4rl05 Ru1z Z470n", $bookTitle);
                $bookTitle = \Str::remove("([Angela, Alberto])", $bookTitle);
                $bookTitle = \Str::remove("James", $bookTitle);
                $bookTitle = \Str::remove("E. L. James", $bookTitle);
                $bookTitle = \Str::remove("(Carlo M. Cipolla)", $bookTitle);
                $bookTitle = \Str::remove("(Isaac Asimov)", $bookTitle);


                $bookTitle = \Str::before($bookTitle, 'by');
                $bookTitle = \Str::before($bookTitle,'.'.$file->getExtension());
                $bookTitle = \Str::remove("@jukeboxlibri.",$bookTitle);
                //$bookTitle.=".".$file->getExtension();
                $bookTitle = \Str::replace('-','',$bookTitle);
                $bookTitle = trim($bookTitle);
                \Ilbullo\Books\Models\Book::factory(1)->create([
                    'author_id' => $author->id,
                    'title'     => $bookTitle,
                    //'path'      => $file->getFileName()
                    'filetype'  => $file->getExtension(),
                    'path'      => \Str::slug($bookTitle).'.'.$file->getExtension()
                ]);
                //move file to correct folder
                if (!\Illuminate\Support\Facades\File::isDirectory(public_path() . '/storage/books/'.$author->id)) {
                    \Illuminate\Support\Facades\File::makeDirectory(public_path() . '/storage/books/'.$author->id);
                }
                if (\Illuminate\Support\Facades\File::exists(public_path() . '/storage/libri/'.$fullName . '/' . $file->getFileName())) {
                \Illuminate\Support\Facades\File::copy(
                    public_path() . '/storage/libri/'.$fullName . '/' . $file->getFileName(),
                    BookLink::path($author->id,\Str::slug($bookTitle).'.'.$file->getExtension())
                    );
                }
                else {
                    dump("NOT COPIED: " . public_path() . '/storage/libri/'.$fullName . '/' . $file->getFileName());
                }
            }
        }

        });

    }
);



