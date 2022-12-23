<div class="col-12">
    @section('page_title')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ __('Authors') }}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" wire:click="cancel()" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#authorModal">
                        {{ __($createButtonLabel) }} <i class="fa-regular fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    @endsection

    @include('books::components.authors.create')
    @include('books::components.authors.update')
    @include('books::layout.partials.alerts')
    <div class="row">
        <x:books::searchbar />
        <div class="col-8">
            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('Lastname') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $author)
                        <tr>
                            <td>{{ $author->id }}</td>
                            <td>{{ $author->lastname }}</td>
                            <td>{{ $author->name }}</td>
                            <td>
                                <button class="btn btn-outline-primary btn-sm" wire:click="loadAuthor({{$author->id}})"><i class="fa-solid fa-book"></i></button>
                                <button data-bs-toggle="modal" data-bs-target="#UpdateAuthorModal"
                                    wire:click="edit({{ $author->id }})" class="btn btn-outline-primary btn-sm"
                                    title="{{ __('Edit') }}"><i class="fa-regular fa-pen-to-square"></i></button>
                                @include('books::layout.partials.delete', ['id' => $author->id])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
        <div class="col-4">
            @if($author_details)
                <h2>{{ $author_details->fullName}}</h2>
                <table class="table table-condensed table-bordered">
                    <tr>
                        <th>{{__('Book Title')}}</th>
                        <th>{{ __('Author')}}</th>
                        <th>{{ __('Categories') }}</th>
                        <th></th>
                    </tr>
                    @foreach($author_details->books as $book)
                        <x:books::book :book="$book" :edit="false" />
                    @endforeach
                </table>

            @endif
        </div>
    </div>

    @section('footer_scripts')
    <script type="text/javascript">
        // Author modals
        window.livewire.on('authorStore', () => {
            $('#authorModal').modal('hide');
        });

        window.livewire.on('authorUpdate', () => {
            $('#UpdateAuthorModal').modal('hide');
        });
    </script>
    @endsection
</div>
