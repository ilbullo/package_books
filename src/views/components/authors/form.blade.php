<!-- Modal -->
<div wire:ignore.self class="modal fade" id="{{$modalName?:"modal"}}" tabindex="-1" role="dialog" aria-labelledby="{{$modalName?:"modal"}}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="{{$modalName?:"modal"}}Label">@if($mode == "update"){{ __($modalLabels['update'])}}@else {{ __($modalLabels['create'])}} @endif</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>

           <div class="modal-body">
                <form>
                    @if($mode ?? '' == "update")
                        <input type="hidden" wire.model="form.author_id">
                    @endif
                    <div class="form-group">
                        <label for="authorName">{{__('Name')}}</label>
                        <input type="text" class="form-control @error('form.name') border-danger @enderror" id="authorName" placeholder="{{__('Enter Name')}}" wire:model="form.name">
                        @error('form.name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label for="authorLastname">{{__('Lastname')}}</label>
                        <input type="text" class="form-control @error('form.lastname') border-danger @enderror" id="authorLastname" placeholder="{{__('Enter Lastname')}}" wire:model="form.lastname">
                        @error('form.lastname') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <x:books::action_buttons :mode="$mode" />
            </div>
        </div>
    </div>
</div>
