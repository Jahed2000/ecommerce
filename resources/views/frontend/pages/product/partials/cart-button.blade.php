<form class="form-inline" action="{{ route('carts.store') }}" method="post">
	@csrf
	
	<input type="hidden" value="{{ $product->id }}" name="product_id">

	<button type="button" class="btn btn-primary" onclick="addToCart({{ $product->id }})"><i class="fa fa-plus"></i>add to cart</button>
</form>