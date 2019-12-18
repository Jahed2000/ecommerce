@extends('frontend.layouts.master')

@section('content')



	<div class="container">
		<div class="row">
			<div class="col-md-4">

@include('frontend.partials.product-sidebar')

			</div>

			<div class="col-md-8">
				<div class="widget">
					<h3 style="padding-bottom: 15px">all products in <span class="badge badge-info">{{$category->name}}</span></h3>

{{-- everything is done in below page --}}
@php 
	$products = $category->products()->paginate(6); //ekhan theke paginate korle method theke korte hobe $category->products->paginate(6) will not work
@endphp

@if($products->count()>0)
	@include('frontend.pages.product.partials.all_products')
@else
	<div class="alert alert-warning">
		no products found!
	</div>
@endif



				</div>
			</div>
		</div>
	</div>

	

	




@endsection