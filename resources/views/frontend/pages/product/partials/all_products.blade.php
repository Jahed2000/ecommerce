

					<div class="row">



						@foreach($products as $product)
						<div class="col-md-4">
							<div class="card">
							
							@php $i=1; @endphp

							@foreach($product->images as $image)
							
							@if($i>0)
							  <img class="card-img-top" src="{{asset('images/products/'.$image->image)}}" alt="Card image">
							@endif
							@php $i--; @endphp

							 @endforeach
							  
							  <div class="card-body">
							    <a href="{{route('products.show',$product->slug)}}">
							    	<h4 class="card-title">{{$product->title}}</h4>
							    </a>
							    <p class="card-text">{{$product->price}}</p>
@include('frontend.pages.product.partials.cart-button')
							  </div>
							</div>
						</div>
						@endforeach

					</div>
					<div class="pagination mt-4">
						{{ $products->links() }}
					</div>

				</div>
			