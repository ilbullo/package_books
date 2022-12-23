<?php

namespace Ilbullo\Books\Http\Livewire;

use Ilbullo\Books\Models\{Author, Book as BookModel, Category};
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use \Ilbullo\Books\Helpers\BookLink;

class Book extends Component
{
    use WithFileUploads;

    public $form = [
        'book_id'   => '',
        'author_id' => '',
        'title'     => '',
        'path'      => '',
        'categories'=> []
    ];

    //various messages
    public $messages = [
        'delete'    => 'Book Deleted Successfully',
        'update'    => 'Book Updated Successfully',
        'create'    => 'Book Created Successfully',
        'error'     => 'Something wrong on request'
    ];

    public $modalLabels = [
        'create'    => 'New book',
        'update'    => 'Update update'
    ];

    protected $model = BookModel::class;

    public $updateMode = false;

    protected $listeners = [
        'editBook' => 'edit'
    ];

    /***********************************************************
     * Reset form fields and validation errors every time
     * the component is rendered
     * @return void
     **********************************************************/

    public function hydrate() {

        $this->resetErrorBag();
        $this->resetValidation();

    }

    public function render() {
        return view('books::components.book.book',[
            'authors'       => Author::orderBy('lastname','ASC')->orderBy('name','ASC')->get(),
            'categories'    => Category::orderBy('name','ASC')->get()
        ])->extends(config('books.layout'));
    }

    /***********************************************************
     * Reset input fields and close modal
     * @return void
     **********************************************************/

     public function cancel()
     {
         $this->updateMode = false;
         $this->resetInputFields();
     }

    /**********************************************************
     * Store a new element on DB after validation
     * @return void
     **********************************************************/

    public function store()
    {

        $this->formValidator();

        $item = $this->model::create($this->getData());
        $item->categories()->sync($this->form['categories']);
        $item->filetype = $this->form['path']->getExtension();
        $item->save();
        $this->form['path']->storeAs(BookLink::storeLink($this->form['author_id']) , $this->getFileName());

        session()->flash('message', __($this->messages['create']));
        session()->flash('type', 'success');

        //reset fields
        $this->resetInputFields();
        //emit event to close modal window
        $this->emit('bookStore');
        //emit the event to update bookShelf component
        $this->emit('updateBookShelf');
    }

    /***********************************************************
     * Show modal and form for edit an element
     * @param Int $id
     * @return void
     **********************************************************/

     public function edit($id)
     {
         $this->updateMode = true;
         $book = $this->model::where('id', $id)->first();
         $this->form['book_id']     = $id;
         $this->form['title']       = $book->title;
         $this->form['author_id']   = $book->author_id;
         $this->form['path']        = $book->path;
         $this->form['categories']  = $book->categories->pluck('id')->toArray();
     }

     /***********************************************************
     * Unlink the book file on the folder and set the db field
     * as empty.
     * @return void
     **********************************************************/

     public function deleteFile() {

        File::delete(BookLink::path($this->form['author_id'],$this->form['path']));
        $this->form['path'] = '';
        $this->model::where('id',$this->form['book_id'])
                    ->update(['path' => $this->form['path']]);

        session()->flash('message', __('Book file deleted'));
        session()->flash('type', 'success');
     }

         /***********************************************************
     * Update an element after validation pass
     * @return void
     **********************************************************/

    public function update()
    {
        $this->formValidator();

        if ($this->form['book_id']) {

            $item = $this->model::find($this->form['book_id']);
            $item->categories()->sync($this->form['categories']);

            //check if there is a new uploaded file and store it
            if (is_object($this->form['path'])) {

                $item->filetype = $this->form['path']->getExtension();
                $this->form['path']->storeAs(BookLink::storeLink($this->form['author_id']), $this->getFileName());

            }

             //move or change filename if are changed author or book_title

             if ($item->author_id != $this->form['author_id'] || $item->title != $this->form['title']){

                //get the new path from the author_id and book title
                $newPath = Str::replace( Str::before($item->path,'.') , $this->form['title'] , $item->path);

                //update file path from old position to new
                File::move(
                    BookLink::path($item->author_id, $item->path),
                    BookLink::path($this->form['author_id'],$newPath)
                    );

                //update path with new filename
                $this->form['path'] = $newPath;
            }

            $item->save();
            $item->update($this->getData());

            $this->updateMode = false;
            session()->flash('message', $this->messages['update']);
            session()->flash('type', 'success');

            $this->resetInputFields();
            $this->emit('bookUpdate');

            //emit the event to update bookShelf component
            $this->emit('updateBookShelf');
        }
    }

    /***********************************************************
     * Reset all input fields of the form
     **********************************************************/

    private function resetInputFields()
    {
        $this->form = \array_fill_keys(\array_keys($this->form), '');
        $this->form['categories'] = [];
    }

    /***********************************************************
     * Validate form inputs
     ***********************************************************/

    private function formValidator() {

        return $this->validate([
                'form.title'     => 'required|string',
                'form.author_id' => 'required|int',
                'form.path'      => 'required'
            ],
            [
                'form.title.required'     => __('This field is required'),
                'form.author_id.required' => __('This field is required'),
                'form.path.required'      => __('This field is required'),
                'form.path.unique'        => __('A book with this title already exists')
            ]);
    }

    /**
     * Return an array of data to update or create
     * @return array
     */

    private function getData() : array {

        return [
            'title'     => $this->form['title'],
            'author_id' => $this->form['author_id'],
            'path'      => empty($this->form['path']) ? '' : (is_object($this->form['path']) ? $this->getFileName() : $this->form['path']),
            'categories'=> $this->form['categories']
        ];
    }

    /**
     * Return the name of the uploaded file i want to save
     * format: titleOfBook.extensionOfFile
     * @return String
     */

    private function getFileName() : string {
        return Str::slug($this->form['title']) . "." . $this->form['path']->getClientOriginalExtension();
    }
}
