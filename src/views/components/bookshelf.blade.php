<div class="col-12">
    @include('books::layout.partials.alerts')
    <h1>{{ __('Book List') }}</h1>
    <hr>
    <div class="col-12 row justify-content-end my-3">
        <div class="col-8">
            <x:books::searchbar />
        </div>
        <div class="col-4 text-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal"
            data-bs-target="#bookModal">{{__('Add book')}}</button>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <h4>{{ __('Filter by') }}</h4>
            <div class="card">
                <div class="card-body">
                    <x:books::filters.authors :authors="$authors" />
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <x:books::filters.categories :categories="$categories" />
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div wire:loading>
                <p>{{ __('Processing search') }}...</p>
            </div>
            <div wire:loading.remove>
                <table class="table">
                    <thead>
                        <tr>
                            <th>{{ __('Book Title') }}</th>
                            <th>{{ __('Author') }}</th>
                            <th>{{ __('Categories') }}</th>
                            <th>{{ __('File')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <x:books::book :book="$book" />
                        @endforeach
                    </tbody>
                </table>
                {{ $books->links() }}
                <div>
                </div>
            </div>
            <livewire:book />
        </div>
