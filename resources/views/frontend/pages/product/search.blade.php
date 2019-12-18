@extends('frontend.layouts.master')

@section('content')



	<div class="container">
		<div class="row">
			<div class="col-md-4">

@include('frontend.partials.product-sidebar')

			</div>

			<div class="col-md-8">
				<div class="widget">
					<h3 style="padding-bottom: 15px">search results for "{{$search}}"</h3>

{{-- everything is done in below page --}}
@include('frontend.pages.product.partials.all_products')


				</div>
			</div>
		</div>
	</div>

	

	




@endsection