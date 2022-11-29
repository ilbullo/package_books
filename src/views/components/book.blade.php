<tr>
    <td>{{ $book->title }}</td>
    <td>{{ $book->author->fullName }}</td>
    <td>{{ $book->categories->pluck('name')->implode(', ') }}</td>
    <td><a class="text-primary" href="{{ $book->path }}" target="__blank">{{ __('Download')}}</a></td>
</tr>
