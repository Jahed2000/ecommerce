@if($errors->any())
<div class="container"> 
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="alert alert-danger">
				<a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<ul>
					@foreach($errors->all() as $error)
						<p>{{ $error }}</p>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>
@endif


@if( session()->has('error') )

<div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>{{ session()->get('error') }}</strong> 
</div>

@elseif( session()->has('success') )

<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>{{ session()->get('success') }}</strong> 
</div>

@endif