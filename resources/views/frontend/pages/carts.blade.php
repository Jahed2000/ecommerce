@extends('frontend.layouts.master')

@section('content')
	<div class="container">
		<h2>Cart Items</h2>
			
		@if(App\Models\Cart::totalItems() > 0)
			<table class="table table-bordered table-stripe">
				<thead>
					<tr>
						<th>No.</th>
						<th>Product</th>
						<th>Image</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Sub Total</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					
						@php
							$total_price = 0;
						@endphp

						@foreach(App\Models\Cart::totalCarts() as $cart)
						<tr>
						<td> {{ $loop->index+1 }} </td>
						<td>
							<a href="{{route('products.show',$cart->product->slug)}}">{{ $cart->product->title }}</a> 
						</td>

						<td>
							{{-- if product has atleast one image --}}
							@if( $cart->product->images->count() > 0 ) 
							{{--returns the first among multiple images --}}
								<img src="{{ asset('images/products/'.$cart->product->images->first()->image) }}" alt="no image" width="60px">
							@endif
						</td>

						<td>
							<form class="form-inline" action="{{route('carts.update',$cart->id)}}" method="post">
								@csrf
								<input class="form-control" type="number" name="product_quantity" value="{{$cart->product_quantity}}">
								<button class="btn btn-success ml-2" type="submit">update</button>
							</form>
						</td>
						<td>
							{{ $cart->product->price }} Taka
						</td>
						
						@php
							$total_price += $cart->product->price*$cart->product_quantity;
						@endphp

						<td>
							{{ $cart->product->price*$cart->product_quantity }} Taka
						</td>
						<td>
							<form class="form-inline" action="{{route('carts.delete',$cart->id)}}" method="get">
								<button class="btn btn-danger" type="submit">delete</button>
							</form>
						</td>
					</tr>

					

					@endforeach

					<tr>
						<td colspan="4"></td>
						<td><strong>Total Amount:</strong></td>
						<td colspan="2">
							<strong>{{ $total_price }} taka</strong>
						</td>
					</tr>

				</tbody>
			</table>

			<div class="float-right">
				<a class="btn btn-success" href="{{ route('products') }}">conitnue shopping</a>
				<a class="btn btn-warning" href="{{ route('checkouts') }}">checkout</a>
			</div>
		@else

			<div class="alert alert-danger text-center">
				<p>Your cart is empty</p>
			</div>
		@endif

	</div>
	
@endsection