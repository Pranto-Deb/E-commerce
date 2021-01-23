<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('title', 'Laravel Ecommerce Project')
	</title>
	
  @include('frontend.partials.styles')

</head>
<body>

	<div class="wrapper">
	<!-- navigation -->			
	@include('frontend.partials.nav')
<!-- End Navigation -->
	@include('frontend.partials.messages')
<!-- Start Sidebar + Content --> 	
 	@yield('content')
<!-- End Sidebar + Content -->	

		<!-- footer -->
	 @include('frontend.partials.footer')
  <!--     end-footer -->	
</div>
	
  @include('frontend.partials.scripts')
  @yield('scripts')
</body>
</html>