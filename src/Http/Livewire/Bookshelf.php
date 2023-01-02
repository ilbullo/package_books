<?php

namespace Ilbullo\Books\Http\Livewire;

use Ilbullo\Books\Models\Author;
use Ilbullo\Books\Models\Book;
use Ilbullo\Books\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Bookshelf extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected const ITEMS_PER_PAGE = 20;   //set how many rows per paginated page

    public $search = null;

    public $authorsFilter = [];

    public $categoriesFilter = [];

    public $authors = [];

    public $categories = [];

    protected $listeners = ['updateBookShelf' =>'render'];

    /***********************************************************
     * Set authors and categories used on select and checkboxes
     * @return View
     **********************************************************/

    public function mount() {

        $this->authors = Author::orderBy('lastname')->get();
        $this->categories = Category::orderBy('name')->get();

    }

    /***********************************************************
     * Render component as a list of elements
     * @return View
     **********************************************************/

    public function render()
    {
        $books = Book::with(['author','categories'])
                ->when($this->search, function($query){
                    return $query->whereLike(['title','author.name','author.lastname','categories.name'], $this->search ?? '');
                })
                ->when($this->authorsFilter, function($query) {
                    foreach($this->authorsFilter as $author_id) {
                        $query->orWhere('author_id',$author_id);
                    }
                })
                ->when($this->categoriesFilter, function($query) {
                    foreach($this->categoriesFilter as $category_id) {
                        $query->orWhereHas('categories',function($query) use ($category_id) {
                            return $query->where('category_id',$category_id);
                        });
                    }
                })
                ->paginate(self::ITEMS_PER_PAGE);

        return view('books::components.bookshelf',['books' => $books])->extends(config('books.layout'));
    }
}
