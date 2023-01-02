<!-- Modal -->
<div wire:ignore.self class="modal fade" id="{{ $modalName ?: 'modal' }}" tabindex="-1" role="dialog"
    aria-labelledby="{{ $modalName ?: 'modal' }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalName ?: 'modal' }}Label">
                    @if ($mode == 'update')
                        {{ __($modalLabels['update']) }}
                    @else
                        {{ __($modalLabels['create']) }}
                    @endif
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>

            <div class="modal-body">
                @include('books::layout.partials.alerts')
                <form>
                    <div class="form-group mb-3">
                        <label for="authorName">{{ __('Author') }}</label>
                        <select class="form-select" id="authorName" aria-label="{{ __('Author') }}"
                            wire:model="form.author_id">
                            <option selected value="">{{ __('Select an author') }}</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->fullName }}</option>
                            @endforeach
                        </select>
                        @error('form.author_id')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="bookTitle">{{ __('Title') }}</label>
                        <input type="text" class="form-control @error('form.title') border-danger @enderror"
                            id="bookTitle" placeholder="{{ __('Enter Title') }}" wire:model="form.title">
                        @error('form.title')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>
                    <p>{{ __('Categories')}}</p>
                    <div class="form-group mb-3" style="column-count:2;">
                        @foreach ($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" wire:key="category-{{ $loop->index }}"
                                    wire:model="form.categories" value="{{ $category->id }}"
                                    id="category_{{ $category->id }}">
                                <label class="form-check-label" for="category_{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                        @error('form.categories')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    @if (!empty($form['path']))
                        {{ $form['path'] }}
                        <x:books::booklink :author="$form['author_id']" :path="$form['path']" />
                        <button class="btn btn-sm btn-danger" wire:click.prevent="deleteFile()" title="{{__('Delete file')}}"><i class="fa fa-trash"></i></button>
                    @else
                        <div class="mb-3">
                            <label for="bookFile" class="form-label">{{ __('Load Book') }}</label>
                            <input class="form-control" type="file" id="bookFile" wire:model="form.path">
                            @error('form.path')
                                <span class="text-danger error">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                    <input type="hidden" wire:model="form.filetype">

                    @if ($mode ?? '' == 'update')
                        <input type="hidden" wire:model="form.book_id">
                    @endif
                </form>
            </div>

            <div class="modal-footer">
                <x:books::action_buttons :mode="$mode" />
            </div>
        </div>
    </div>
</div>
