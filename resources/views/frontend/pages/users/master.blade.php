@extends('frontend.layouts.master')

@section('content')
	
	<div class="cont mt-3">
		<div class="row">
			<div class="col-md-3 ml-3 mt-1">
				<div class="list-group">
					<a href="" class="list-group-item">
						<img src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}" style="width: 120px;" class="img rounded-circle">
					</a>
					<a href="{{route('user.dashboard')}}" class="list-group-item {{ Route::is('user.dashboard') ? 'active' : ''}}">Dashboard</a>
					<a href="{{route('user.profile')}}" class="list-group-item {{ Route::is('user.profile') ? 'active' : ''}}">Update Profile</a>
					<a href="" class="list-group-item">Logout</a>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card card-body">

				@yield('sub-content')

				</div>
			</div>
		</div>
	</div>

@endsection