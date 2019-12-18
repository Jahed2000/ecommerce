@if( session()->has('success') )

<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>{{ session()->get('success') }}</strong> 
</div>


@elseif( session()->has('update') )

<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>{{ session()->get('update') }}</strong> 
</div>

@elseif( session()->has('delete') )

<div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>{{ session()->get('delete') }}</strong> 
</div>

@endif