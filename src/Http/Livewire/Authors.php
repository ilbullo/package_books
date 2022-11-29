<?php

namespace Ilbullo\Books\Http\Livewire;

use Ilbullo\Books\Models\Author;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class Authors extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $model = Author::class;

    public $updateMode = false;

    //form elements
    public $form = [
        'author_id'       => '',
        'name'            => '',
        'lastname'        => ''
    ];

    //various messages
    public $messages = [
        'delete'    => 'Author Deleted Successfully',
        'update'    => 'Author Updated Successfully',
        'create'    => 'Author Created Successfully',
        'error'     => 'Something wrong on request'
    ];

    public $createButtonLabel = 'Add author';

    public $modalLabels = [
        'create'    => 'New author',
        'update'    => 'Update author'
    ];

    public $search = "";

    /***********************************************************
     * Render component as a list of elements
     * @return View
     **********************************************************/

    public function render()
    {
        $items = $this->model::whereLike(['name','lastname'],$this->search)->paginate(15);
        return view('books::components.authors.authors', ['items' => $items])->extends(config('books.layout'));
    }

    /***********************************************************
     * Show modal and form for edit an element
     * @param Int $id
     * @return void
     **********************************************************/

    public function edit($id)
    {
        $this->updateMode = true;
        $author = $this->model::where('id', $id)->first();
        $this->form['author_id'] = $id;
        $this->form['name']      = $author->name;
        $this->form['lastname']  = $author->lastname;
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

        $item = $this->model::create(
            [
                'name'      => $this->form['name'],
                'lastname'  => $this->form['lastname']
            ]);

        session()->flash('message', __($this->messages['create']));
        session()->flash('type', 'success');

        //reset fields
        $this->resetInputFields();
        $this->emit('authorStore');
    }

    /***********************************************************
     * Update an element after validation pass
     * @return void
     **********************************************************/

    public function update()
    {
        $this->formValidator();

        if ($this->form['author_id']) {

            $user = $this->model::find($this->form['author_id']);

            $user->update([
                'name'     => $this->form['name'],
                'lastname' => $this->form['lastname'],
            ]);

            $this->updateMode = false;
            session()->flash('message', $this->messages['update']);
            session()->flash('type', 'success');

            $this->resetInputFields();
            $this->emit('authorUpdate');
        }
    }

    /***********************************************************
     * Put in the bin an element
     * @param Int $id
     * @return void
     **********************************************************/

    public function delete($id)
    {
        if ($id) {

            try {
                $this->model::find($id)->delete();

                session()->flash('message', $this->messages['delete']);
                session()->flash('type', 'success');
            } catch (\Exception $e) {
                session()->flash('message', $this->messsages['errror']);
                session()->flash('type', 'danger');
                Log::error("Errore cancellazione autore: " . $e->getMessage());
            }
        }
    }


    /***********************************************************
     * Reset all input fields of the form
     **********************************************************/

    private function resetInputFields()
    {
        $this->form = \array_fill_keys(\array_keys($this->form), '');
    }

    /***********************************************************
     * Validate form inputs
     ***********************************************************/

    private function formValidator() {

        return $this->validate([
                'form.name'     => 'required|string',
                'form.lastname' => 'required|string'
            ],
            [
                'form.name.required'     => __('This field is required'),
                'form.lastname.required' => __('This field is required')
            ]);
    }
}
