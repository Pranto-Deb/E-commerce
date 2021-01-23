
<div class="list-group">

     @foreach(App\Models\Category::orderBy('name', 'asc')
                               ->where('parent_id', NULL)->get() as $main_category)
	<a href="#main-{{ $main_category->id }}" class="list-group-item list-group-item-action" data-toggle="collapse">
		<img src="{!! asset('images/categories/'.$main_category->image) !!}" width="30" height="40">
		{{$main_category->name}}
	</a>
	
	<div class="collapse
			@if (Route::is('categories.show')) 
       		@if (App\Models\Category::ParentOrNotCategory($main_category->id, $category->id))
       				show
       		@endif 
       		@endif
	" id="main-{{ $main_category->id }}">
		<div class="child-rows">
		@foreach(App\Models\Category::orderBy('name', 'asc')
                               ->where('parent_id', $main_category->id)->get() as $sub)
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
	@endforeach
</div>