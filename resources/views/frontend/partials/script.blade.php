<script src="{{ asset('js/jquery-3.3.1.slim.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery-3.4.1.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/popper.min.js') }}" crossorigin="anonymous"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" crossorigin="anonymous"></script>

<!-- alertify js JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>



{{-- function to add items to cart --}}
<script type="text/javascript">
	{{-- below part is to insert csrf into jquery post method --}}
		$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    	}
		});
	// end part
	
	function addToCart(product_id) {
		// alert(product_id);
		$.post( "http://localhost/ecommerce/public/api/carts/store", { product_id: product_id })
		  .done(function( data ) {
		    // alert( "Data Loaded: " + data );
		    // console.log(data)
		    data = JSON.parse(data)
		    if (data.status=='success') {
		    	// toast
		    	alertify.set('notifier','position', 'top-center');
				// alertify.success('Item added successfully! Total items in cart: ' +data.totalItems);
				alertify.message('Item added successfully! Total items in cart: ' +data.totalItems);
				// end toast

		    	$("#nav-totalItems").html(data.totalItems);

		    }
		  });
	}
</script>