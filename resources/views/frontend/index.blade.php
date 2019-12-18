@extends('frontend.layouts.master')

@section('content')

		{{-- sidebar section --}}

	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<ul class="list-group sidebar">
				  <li class="list-group-item">Active item</li>
				  <li class="list-group-item">Second item</li>
				  <li class="list-group-item">Third item</li>
				</ul>
			</div>

			<div class="col-md-8">
				<div class="widget">
					<h3 style="padding-bottom: 15px">products</h3>
					<div class="row">
						<div class="col-md-3">
							<div class="card">
							  <img class="card-img-top" src="{{asset('images/products/'.'pepsi.jpg')}}" alt="Card image">
							  <div class="card-body">
							    <h4 class="card-title">Product name</h4>
							    <p class="card-text">Price 400tk</p>
							    <a href="#" class="btn btn-outline-primary">add to cart</a>
							  </div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card">
							  <img class="card-img-top" src="{{asset('images/products/'.'pepsi.jpg')}}" alt="Card image">
							  <div class="card-body">
							    <h4 class="card-title">Product name</h4>
							    <p class="card-text">Price 400tk</p>
							    <a href="#" class="btn btn-outline-primary">add to cart</a>
							  </div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card">
							  <img class="card-img-top" src="{{asset('images/products/'.'pepsi.jpg')}}" alt="Card image">
							  <div class="card-body">
							    <h4 class="card-title">Product name</h4>
							    <p class="card-text">Price 400tk</p>
							    <a href="#" class="btn btn-outline-primary">add to cart</a>
							  </div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card">
							  <img class="card-img-top" src="{{asset('images/products/'.'pepsi.jpg')}}" alt="Card image">
							  <div class="card-body">
							    <h4 class="card-title">Product name</h4>
							    <p class="card-text">Price 400tk</p>
							    <a href="#" class="btn btn-outline-primary">add to cart</a>
							  </div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card">
							  <img class="card-img-top" src="{{asset('images/products/'.'pepsi.jpg')}}" alt="Card image">
							  <div class="card-body">
							    <h4 class="card-title">Product name</h4>
							    <p class="card-text">Price 400tk</p>
							    <a href="#" class="btn btn-outline-primary">add to cart</a>
							  </div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card">
							  <img class="card-img-top" src="{{asset('images/products/'.'pepsi.jpg')}}" alt="Card image">
							  <div class="card-body">
							    <h4 class="card-title">Product name</h4>
							    <p class="card-text">Price 400tk</p>
							    <a href="#" class="btn btn-outline-primary">add to cart</a>
							  </div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	{{-- end sidebar section --}}

	
	<div class="container">
		
		<h2>test</h2>
	</div>



@endsection