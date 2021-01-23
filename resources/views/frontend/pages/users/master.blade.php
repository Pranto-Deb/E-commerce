@extends('frontend.layouts.master')

@section('content')
	<div class="container mt-2">
		<div class="row">
			<div class="col-md-4">
				<div class="list-group">
					<a class="list-group-item" href="">
						<img src="{{ App\Helpers\ImageHelper::getUserImage(Auth::user()->id) }}" class="img rounded-circle" style="width: 100px">
					</a>
					<a class="list-group-item {{Route::is('user.dashboard')?'active':''}}" href="{{route('user.dashboard')}}">Dashboard</a>
					<a class="list-group-item {{Route::is('user.profile')?'active':''}}" href="{{route('user.profile')}}">Update Profile</a>	
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