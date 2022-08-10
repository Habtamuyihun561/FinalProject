@extends('frontend.layouts.master')

@section('title','AUS| About Us')

@section('main-content')

	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="blog-single.html">About Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
	
	<!-- About Us -->
	<section class="about-us section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="about-content">
							@php
								$settings=DB::table('settings')->get();
							@endphp
							<h3>Welcome To <span>Ethio OAS</span></h3>
							<p>@foreach($settings as $data) {{$data->description}} @endforeach</p>
							<div class="button">
								<a href="{{route('blog')}}" class="btn">Our Blog</a>
								<a href="{{route('contact')}}" class="btn primary">Contact Us</a>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="about-img overlay">
							{{-- <div class="button">
								<a href="https://www.youtube.com/watch?v=nh2aYrGMrIE" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
							</div> --}}
							<img src="@foreach($settings as $data) {{$data->photo}} @endforeach" alt="@foreach($settings as $data) {{$data->photo}} @endforeach">
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- End About Us -->
	
	<!-- Start Team -->
	{{-- <section id="team" class="team section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Our Expert Team</h2>
						<p>Business consulting excepteur sint occaecat cupidatat consulting non proident, sunt in culpa qui officia deserunt laborum market. </p>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- Single Team -->
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-team">
						<!-- Image -->
						<div class="image">
							<img src="images/team/team1.jpg" alt="#">
						</div>
						<!-- End Image -->
						<div class="info-head">
							<!-- Info Box -->
							<div class="info-box">
								<h4 class="name"><a href="#">Dahlia Moore</a></h4>
								<span class="designation">Senior Manager</span>
							</div>
							<!-- End Info Box -->
							<!-- Social -->
							<div class="social-links">
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-behance"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
							<!-- End Social -->
						</div>
					</div>
				</div>	
				<!-- End Single Team -->
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-team">
						<!-- Image -->
						<div class="image">
							<img src="images/team/team2.jpg" alt="#">
						</div>
						<!-- End Image -->
						<div class="info-head">
							<!-- Info Box -->
							<div class="info-box">
								<h4 class="name"><a href="#">Jhone digo</a></h4>
								<span class="designation">Markeitng</span>
							</div>
							<!-- End Info Box -->
							<!-- Social -->
							<div class="social-links">
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-behance"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
							<!-- End Social -->
						</div>
					</div>
				</div>	
				<!-- End Single Team -->
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-team">
						<!-- Image -->
						<div class="image">
							<img src="images/team/team3.jpg" alt="#">
						</div>
						<!-- End Image -->
						<div class="info-head">
							<!-- Info Box -->
							<div class="info-box">
								<h4 class="name"><a href="#">Zara tingo</a></h4>
								<span class="designation">Web Developer</span>
							</div>
							<!-- End Info Box -->
							<!-- Social -->
							<div class="social-links">
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-behance"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
							<!-- End Social -->
						</div>
					</div>
				</div>	
				<!-- End Single Team -->
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-team">
						<!-- Image -->
						<div class="image">
							<img src="images/team/team4.jpg" alt="#">
						</div>
						<!-- End Image -->
						<div class="info-head">
							<!-- Info Box -->
							<div class="info-box">
								<h4 class="name"><a href="#">David Zone</a></h4>
								<span class="designation">SEO Expert</span>
							</div>
							<!-- End Info Box -->
							<!-- Social -->
							<div class="social-links">
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-behance"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
							<!-- End Social -->
						</div>
					</div>
				</div>	
				<!-- End Single Team -->
			</div>	
		</div>
	</section> --}}
	<!--/ End Team Area -->
	
	<!-- Start Shop Services Area -->
	<section class="shop-services section">
		<div class="container">
			<h1 style="color: #ffde20;" class="justify-content-center">Developers</h1>
			<div class="row">
				<div class="col-xl-4 col-lg-5">
					<div class="card shadow mb-4">
					  <!-- Card Header - Dropdown -->
					  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Habtamu</h6>
					  </div>
					  <!-- Card Body -->
					  <div class="card-body" style="overflow:hidden">
						<div id="pie_chart" style="width:350px; height:320px;">
							<img src="" alt="image of me">
							<p>«Sed ut perspiciatis unde omnis 
								iste natus error sit voluptatem 
								accusantium doloremque laudantium,
								 totam rem aperiam eaque ipsa, quae
								  ab illo inventore veritatis et quasi
								   architecto beatae vitae dicta sunt, explicabo.
								    Nemo enim ipsam voluptatem, quia voluptas sit,
									 aspernatur aut odit aut fugit, sed quia consequuntur
									  magni dolores eos, qui ratione voluptatem sequi 
									  nesciunt, neque porro quisquam est, qui dolorem 
									  ipsum, quia dolor sit, amet, consectetur, adipisci velit, 
								sed quia non numquam eius modi tempora incidunt, ut labore</p>
					  </div>
					</div>
				  </div>
				</div>
				<div class="col-xl-4 col-lg-5">
					<div class="card shadow mb-4">
					  <!-- Card Header - Dropdown -->
					  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Belsti</h6>
					  </div>
					  <!-- Card Body -->
					  <div class="card-body" style="overflow:hidden">
						<div id="pie_chart" style="width:350px; height:320px;">
							<img src="" alt="image of me">
							<p>«Sed ut perspiciatis unde omnis 
								iste natus error sit voluptatem 
								accusantium doloremque laudantium,
								 totam rem aperiam eaque ipsa, quae
								  ab illo inventore veritatis et quasi
								   architecto beatae vitae dicta sunt, explicabo.
								    Nemo enim ipsam voluptatem, quia voluptas sit,
									 aspernatur aut odit aut fugit, sed quia consequuntur
									  magni dolores eos, qui ratione voluptatem sequi 
									  nesciunt, neque porro quisquam est, qui dolorem 
									  ipsum, quia dolor sit, amet, consectetur, adipisci velit, 
								sed quia non numquam eius modi tempora incidunt, ut labore</p>
					  </div>
					</div>
				  </div>
				</div>
				<div class="col-xl-4 col-lg-5">
					<div class="card shadow mb-4">
					  <!-- Card Header - Dropdown -->
					  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">Fikreselam</h6>
					  </div>
					  <!-- Card Body -->
					  <div class="card-body" style="overflow:hidden">
						<div id="pie_chart" style="width:350px; height:320px;">
							<img src="" alt="image of me">
							<p>«Sed ut perspiciatis unde omnis 
								iste natus error sit voluptatem 
								accusantium doloremque laudantium,
								 totam rem aperiam eaque ipsa, quae
								  ab illo inventore veritatis et quasi
								   architecto beatae vitae dicta sunt, explicabo.
								    Nemo enim ipsam voluptatem, quia voluptas sit,
									 aspernatur aut odit aut fugit, sed quia consequuntur
									  magni dolores eos, qui ratione voluptatem sequi 
									  nesciunt, neque porro quisquam est, qui dolorem 
									  ipsum, quia dolor sit, amet, consectetur, adipisci velit, 
								sed quia non numquam eius modi tempora incidunt, ut labore</p>
					  </div>
					</div>
				  </div>
				</div>
				{{-- <div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div> --}}
			</div>
		</div>
	</section>

	{{-- <section class="shop-services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Free Auction Post</h4>
						<p>Auction Documents 100 ETB</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Free Auction Post</h4>
						<p>Winner Selected Every Day</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Sucure Payment</h4>
						<p>100% secure payment</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Best Peice</h4>
						<p>Guaranteed price</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Shop Services Area -->
	
	{{-- @include('frontend.layouts.newsletter') --}}
@endsection