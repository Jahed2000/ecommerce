@extends('frontend.layouts.master')

@section('title')
	{{ $product->title }}
@endsection

@section('content')



	<div class="container">
		<div class="row">
			<div class="col-md-4">

{{-- slider start--}}
<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
	
	@php $i=1; @endphp 
	@foreach($product->images as $image)

    <div class="carousel-item {{ $i==1 ? 'active':'' }}">
      <img class="d-block w-100" src="{{ asset('images/products/'.$image->image) }}" alt="First slide">
    </div>
    @php $i++; @endphp
    @endforeach

  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div>
	<p>category <span class="badge badge-info">{{$product->category->name}}</span></p>
	<p>brand <span class="badge badge-info">{{$product->brand->name}}</span></p>
</div>

{{-- slider end --}}

			</div>

			<div class="col-md-8">
				<div class="widget">
					<h4 style="padding-bottom: 15px">{{$product->title}}</h4>
					<h4 style="padding-bottom: 15px">{{$product->price}} taka</h4>
					<h4 style="padding-bottom: 15px">{{ $product->quantity<1 ? 'out of stock' : $product->quantity .' '. 'items in stock' }} </h4>

					<hr>
					<p style="padding-bottom: 15px">{{$product->description}}</p>
					

{{-- everything is done in below page --}}
{{-- @include('frontend.partials.all_products') --}}


				</div>
			</div>
		</div>
	</div>

	

	




@endsection