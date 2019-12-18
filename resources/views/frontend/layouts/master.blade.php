<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('title','laravel ecommerce')
	</title>
	{{-- below meta is used to incorporate csrf token into jquery post request --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">
	{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> --}}
	<script src="https://kit.fontawesome.com/05ca3f0c27.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	{{-- app.css contains bootstrap libraries so no additional files --}}

	{{-- below css and bootstrap theme for alertify js --}}
	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	<!-- Bootstrap theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
	<style type="text/css"></style>
	{{-- end alertify js --}}
	
</head>
<body>

	{{-- navbar section --}}
@include('frontend.partials.nav')
	{{-- end navbar section --}}
	
	{{-- notifications section --}}
 @include('frontend.partials.messages') 
	{{-- end notifications section --}}

@yield('content')

	{{-- footer --}}
@include('frontend.partials.footer')
	{{-- end footer --}}


@include('frontend.partials.script')
@yield('scripts') {{-- yields from checkout.blade --}}

</body>
</html>