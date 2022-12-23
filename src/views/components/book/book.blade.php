<div>
    @include('books::components.book.create')
    @include('books::components.book.update')

    @section('footer_scripts')
        <script type="text/javascript">

            // Book modal hide event hook
            window.livewire.on('bookStore', () => {
                $('#bookModal').modal('hide');
            });

            // Book update modal hide event hook
            window.livewire.on('bookUpdate', () => {
                $('#UpdateBookModal').modal('hide');
            });

        </script>
    @endsection
</div>
