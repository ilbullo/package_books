<h5>{{__('Categories')}}</h5>
@foreach($categories as $category)
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="{{$category->id}}" wire:model="categoriesFilter" id="categoriesFilter{{$category->id}}">
  <label class="form-check-label" for="categoriesFilter{{$category->id}}">
    {{$category->name}}
  </label>
</div>
@endforeach
