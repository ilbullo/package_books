
<h5>{{__('Authors')}}</h5>
@foreach($authors as $author)
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="{{$author->id}}" wire:model="authorsFilter" id="authorsFilter{{$author->id}}">
  <label class="form-check-label" for="authorsFilter{{$author->id}}">
    {{$author->fullName}}
  </label>
</div>
@endforeach
