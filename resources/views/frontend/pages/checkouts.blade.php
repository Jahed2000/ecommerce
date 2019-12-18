@extends('frontend.layouts.master')

@section('content')
<div class="container">
		
	<div class="card card-body mt-3">
		<h2>Confirm Order</h2>
		<hr>

		<div class="row">
			<div class="col-md-7">
				@foreach(App\Models\Cart::totalCarts() as $cart)

				<p>{{ $cart->product->title }}
				<strong>{{ $cart->product->price }} taka</strong>-
				{{ $cart->product_quantity }} unit</p>
				
				@endforeach
			</div>
			<div class="col-md-5 border-left">
				@php 
				$total_price = 0;
				@endphp

				@foreach(App\Models\Cart::totalCarts() as $cart)
				@php
				$total_price += $cart->product->price*$cart->product_quantity;
				@endphp
				@endforeach
				<p><strong>Total price: {{$total_price}} Taka</strong></p>
				<p><strong>Total price + shipping cost: {{ $total_price + App\Models\Setting::first()->shipping_cost}} Taka</strong></p>
			</div>
		</div>

		<a href="{{route('carts')}}">Change Cart Items</a>
	</div>

	<div class="card card-body mt-3 mb-5">
		<h2>Shipping Address</h2>
		<hr>
		<form method="POST" action="{{route('checkouts.store')}}">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::check() ? Auth::user()->first_name.' '.Auth::user()->last_name :''}}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::check() ? Auth::user()->email:''}}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                        <div class="col-md-6">
                            <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{Auth::check() ? Auth::user()->phone_no:''}}" required autocomplete="phone_no">

                            @error('phone_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="shipping_address" class="col-md-4 col-form-label text-md-right">{{ __('Shipping Adress') }}</label>

                        <div class="col-md-6">
                            <textarea id="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" autocomplete="shipping_address" required> {{Auth::check() ? Auth::user()->shipping_address:''}} </textarea>

                            @error('shipping_address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Additional Message (if necessary)') }}</label>

                        <div class="col-md-6">
                            <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" autocomplete="message" rows="1"> </textarea>

                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="payment_method" class="col-md-4 col-form-label text-md-right">{{ __('Payment Method') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="payment_method_name" required id="payments">
                            	<option>Select a payment method</option>
                            	@foreach($payments as $payment)
                            	<option value="{{$payment->short_name}}">{{$payment->name}}</option>
                            	@endforeach
                            </select>
							

							@foreach($payments as $payment)

							
								@if($payment->short_name=="cash_on_delivery")
								<div id="payment_{{$payment->short_name}}" class="hidden mt-3">
									<div class="alert alert-success text-center">
										<p>product will be sent to your shipping address</p>
									</div>
								</div>

								@else

								<div id="payment_{{$payment->short_name}}" class="hidden mt-3 text-center alert alert-success">
									<h3>{{$payment->name}}</h3>
									<p>
										<strong>
											{{$payment->name}} no: {{$payment->no}}
										</strong>
										<br>
										<strong>
											account type: {{$payment->type}}
										</strong>
									</p>
									<p>
										send the amount to the provided number and enter the transacrtion code below
									</p>
									
								</div>

								@endif
							

							@endforeach
								<div class="hidden" id="transaction_id">
									<input type="text" name="transaction_id" class="form-control" placeholder="enter transaction id">
								</div>
                        </div>
                    </div>


                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Order now') }}
                            </button>
                        </div>
                    </div>
                </form>
	</div>

</div>
@endsection

@section('scripts')

<script type="text/javascript">
	$("#payments").change( function() {
		$payment_method = $("#payments").val();

		if ($payment_method=="cash_on_delivery") {
			$("#payment_rocket").addClass('hidden');
			$("#payment_bkash").addClass('hidden');
			$("#payment_cash_on_delivery").removeClass('hidden');

		} else if ($payment_method=="bkash") {
			$("#payment_cash_on_delivery").addClass('hidden');
			$("#payment_rocket").addClass('hidden');
			$("#payment_bkash").removeClass('hidden');
			$("#transaction_id").removeClass('hidden');

		} else if ($payment_method=="rocket") {
			$("#payment_cash_on_delivery").addClass('hidden');
			$("#payment_bkash").addClass('hidden');
			$("#payment_rocket").removeClass('hidden');
			$("#transaction_id").removeClass('hidden');

		}
		
	})
</script>

@endsection