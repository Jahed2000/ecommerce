@extends('frontend.layouts.master')

@section('content')

{{--slider start--}}
		<div class="our-slider">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			  <ol class="carousel-indicators">
			  	@foreach($sliders as $slider)
			  		<li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index}}" class="{{ $loop->index==0?'active':'' }}"></li>
			  	@endforeach
			  </ol>
			  <div class="carousel-inner">
			  	@foreach($sliders as $slider)
				<div class="carousel-item {{ $loop->index==0?'active':'' }}">
			      	<img class="d-block w-100" src="{{ asset('images/sliders/'.$slider->image) }}" alt="First slide" style="width: 1000px;height: 300px;">
			      	<div class="carousel-caption d-none d-md-block">
			      			<h5>{{ $slider->title }}</h5>{{-- 
					    	<p>join our ventures now or pay the price</p> --}}
					    	<a class="btn btn-danger" href="{{$slider->button_link}}" target="_blank">{{$slider->button_text}}</a>
					</div>
			    </div>
			  	@endforeach
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
			</div>
		</div>
		{{-- slider end --}}


	<div class="container">
		
		

		<div class="row">
			<div class="col-md-4">


@include('frontend.partials.product-sidebar')

			</div>

			<div class="col-md-8">

{{-- @include('frontend.partials.messages') --}}
				
				<div class="widget">
					<h3 style="padding-bottom: 15px">products</h3>

{{-- everything is done in below page --}}
@include('frontend.pages.product.partials.all_products')


				</div>
			</div>
		</div>
	</div>

	

	




@endsection