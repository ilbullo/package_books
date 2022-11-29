<div class="d-inline" x-data="{ confirmDelete: false }"  wire:key="'{{$id}}'">
    <button x-show="!confirmDelete" x-on:click="confirmDelete=true" class="btn btn-outline-danger btn-sm"
        data-bs-toggle="tooltip" data-bs-placement="top" rel="tooltip" title="{{ __('Delete') }}">
        @if($label) {{$label}}
        @else
        <i class="fa fa-light fa-trash"></i>
        @endif
    </button>

    <button x-show="confirmDelete" x-on:click="confirmDelete=false" wire:click="{{$action}}({{ $id }})"
        class="btn btn-outline-success btn-sm">{{ __('Yes') }}</button>

    <button x-show="confirmDelete" x-on:click="confirmDelete=false"
        class="btn btn-outline-danger btn-sm">{{ __('No') }}</button>

</div>
