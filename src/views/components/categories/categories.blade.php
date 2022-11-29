<div class="col-12">
    @section('page_title')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ __('Categories') }}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" wire:click="cancel()" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#categoryModal">
                        {{ __($createButtonLabel) }} <i class="fa-regular fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    @endsection

    @include('books::components.categories.create')
    @include('books::components.categories.update')
    @include('books::layout.partials.alerts')
    <div class="row">
        <x:books::searchbar />
        <div class="col-12">
            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#UpdateCategoryModal"
                                    wire:click="edit({{ $category->id }})" class="btn btn-outline-primary btn-sm"
                                    title="{{ __('Edit') }}"><i class="fa-regular fa-pen-to-square"></i></button>
                                @include('books::layout.partials.delete', ['id' => $category->id])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>

    @section('footer_scripts')
    <script type="text/javascript">
        // category modals
        window.livewire.on('categoriesStore', () => {
            $('#categoryModal').modal('hide');
        });

        window.livewire.on('categoryUpdate', () => {
            $('#UpdateCategoryModal').modal('hide');
        });
    </script>
    @endsection
</div>
