{{-- this page extends a different master layout --}}
@extends('frontend.pages.users.master') 

@section('sub-content')


	<div class="container">
		<h2>Welcome {{ $user->first_name." ".$user->last_name }}</h2>
		
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime sit beatae at quod, eveniet temporibus id natus enim omnis earum, dolorem explicabo quaerat ducimus neque dolores, voluptatem mollitia nihil sint.</p>
		<hr>

		<div class="row">
			<div class="col-md-4">
				<div class="card card-body mt-2 pointer" onclick="location.href='{{route('user.profile')}}' ">
					<h3>Update Profile</h3>
				</div>
			</div>
			<div class="col-md-4"></div>
			<div class="col-md-4"></div>
		</div>

	</div>

@endsection