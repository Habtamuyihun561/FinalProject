@extends('frontend.layouts.master')

@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="javascript:void(0);">Service</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->
  
	<!-- Start Contact -->
	<section id="contact-us" class="contact-us section bg-white mb-1">
		<div class="container">
            
				<div class="contact-head">
					<div class="row">
                        <div class="col-lg-4 col-12">
                            <div> Here You Can Post Auctions</div>
                            <hr>
                        </div>
                        <div class="col-lg-4 col-12">
                        <div> You can Participate in Diffreent Auctions</div>
                        <hr>
                        </div>
                        <div class="col-lg-4 col-12">
                         <div>  You can pay For Documents Online</div>
                         <hr>
                        </div>
						
				</div>
			</div>
           
	</section>
	
	<!--================Contact Success  =================-->
	
	<!-- Modals error -->
	
@endsection

@push('styles')
<style>
	.modal-dialog .modal-content .modal-header{
		position:initial;
		padding: 10px 20px;
		border-bottom: 1px solid #e9ecef;
	}
	.modal-dialog .modal-content .modal-body{
		height:100px;
		padding:10px 20px;
	}
	.modal-dialog .modal-content {
		width: 50%;
		border-radius: 0;
		margin: auto;
	}
</style>
@endpush
@push('scripts')
<script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/js/contact.js') }}"></script>
@endpush