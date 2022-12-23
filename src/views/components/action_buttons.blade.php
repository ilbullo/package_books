<button type="button" wire:click="cancel()" class="btn btn-secondary close-btn"
    data-bs-dismiss="modal">{{ __('Close') }}</button>
@if ($mode == 'update')
    <button type="button" wire:click.prevent="update()" class="btn btn-primary close-modal">{{ __('Update') }}</button>
@else
    <button type="button" wire:click.prevent="store()" class="btn btn-primary close-modal">{{ __('Save') }}</button>
@endif
