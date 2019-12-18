<div class="list-group sidebar">
	@foreach(App\Models\Category::orderBy('name','asc')->where('parent_id',NULL)->get() as $parent )

		  <a href="#main-{{$parent->id}}" data-toggle="collapse" class="list-group-item list-group-item-action">
		  	<span style="color:#2F4F4F;">{{ strtoupper($parent->name) }}</span>
		  </a>

		  <div class="child-rows collapse 
					@if(Route::is('categories.show'))
						@if( App\Models\Category::ParentOrNot( $parent->id, $category->id ) ) {{-- calling ParentOrNot function from category model --}}
							show
						@endif
					@endif
		  " id="main-{{$parent->id}}">

		  	@foreach(App\Models\Category::orderBy('name','asc')->where('parent_id', $parent->id)->get() as $child )
			
			<a href="{{route('categories.show',$child->id)}}" class="list-group-item list-group-item-active
					@if(Route::is('categories.show'))
						@if( $child->id == $category->id )
							active
						@endif
					@endif
				">
		  	<span style="color:black;padding-left: 30px;">{{ $child->name }}</span>
		  	</a>

		  	@endforeach
		  	
		  </div>

	@endforeach


</div>