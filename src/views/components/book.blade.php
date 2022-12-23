<tr>
    <td>{{ $book->title }}</td>
    <td>{{ $book->author->fullName }}</td>
    <td>{{ $book->categories->pluck('name')->implode(', ') }}</td>
    <td>{{ $book->filetype}}</td>
    <td>
        <div class="row">
            @if($edit)
            <div class="col-6">
                <button data-bs-toggle="modal" data-bs-target="#UpdateBookModal"
                    wire:click="$emit('editBook',{{ $book->id }})" class="btn btn-outline-primary btn-sm"
                    title="{{ __('Edit') }}"><i class="fa-regular fa-pen-to-square"></i></button>
            </div>
            @endif
            <div class="col-6">
                @if (!empty($book->path))
                    <x:books::booklink :path="$book->path" :author="$book->author_id" />
                @endif
            </div>
        </div>

    </td>
</tr>
