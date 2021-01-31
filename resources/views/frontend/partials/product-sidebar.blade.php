
<div class="list-group">

     @foreach(App\Models\Category::orderBy('name', 'asc')
                               ->where('parent_id', NULL)->get() as $main_category)
   <?php $childCats = App\Models\Category::orderBy('name', 'asc') ->where('parent_id', $main_category->id)->get(); ?>

	   @if(!empty($childCats) && count($childCats) > 0)
	   		<a href="#main-{{ $main_category->id }}" class="list-group-item list-group-item-action" data-toggle="collapse">
			<img src="{!! asset('images/categories/'.$main_category->image) !!}" style="height: 40px; width: 40px;">
			{{$main_category->name}}
		</a>
		
		<div class="collapse show" id="main-{{ $main_category->id }}">
			<div class="child-rows">
			@foreach($childCats as $sub)
	       	<a href="{!! route('categories.show', $sub->id) !!}" class="list-group-item list-group-item-action 
	       		@if (Route::is('categories.show')) 
	       		@if ($sub->id == $category->id)
	       				active 
	       		@endif 
	       		@endif 
	       		">
			<img src="{!! asset('images/categories/'.$sub->image) !!}" width="20">
			{{$sub->name}}
			</a>

			@endforeach
			</div>
			
		</div>
	   @else
		<a href="{!! route('categories.show', $main_category->id) !!}" class="list-group-item list-group-item-action">
			<img src="{!! asset('images/categories/'.$main_category->image) !!}" style="height: 40px; width: 40px;">
			{{$main_category->name}}
		</a>
		@endif
	@endforeach
</div>