<!DOCTYPE html>
<html lang="eng">
<head>
	@include('frontend.layouts.head')	
</head>
<body class="js">

	<!-- Preloader -->
	
	<!-- End Preloader -->
	
	@include('frontend.layouts.notification')
	<!-- Header -->
	@include('frontend.layouts.header')
	<!--/ End Header -->
	
	@yield('main-content')
	
	@include('frontend.layouts.footer')
	@stack('scripts')
</body>
</html>