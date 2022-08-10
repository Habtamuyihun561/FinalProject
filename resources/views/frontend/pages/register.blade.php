@extends('frontend.layouts.master')

@section('title','AUS | Register Page')

@section('main-content')
	<!-- Breadcrumbs -->
    <div class="breadcrumbs ">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Register</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
            
    <!-- Shop Login -->
    <section class="shop login section bg-white">
        <div class="container">
            <div class="row"> 
                <div class="col-lg-6 offset-lg-3 col-12">
                    <div class="login-form">
                        <h2>Register</h2>
                        <p>Please register in order to checkout more quickly</p>
                        <!-- Form -->
                        <form class="form" method="post" action="{{route('register.submit')}}">
                            @csrf
                            <div class="row">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                        <label>First Name<span>*</span></label>
                                        <input type="text" name="fname" placeholder="" required="required" value="{{old('name')}}">
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                    <div class="col-4">
                                    <div class="form-group">
                                        <label>Last Name<span>*</span></label>
                                        <input type="text" name="lname" placeholder="" required="required" value="{{old('name')}}">
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-4">
                                    <div class="form-group">
                                        <label>Grand Father Name<span>*</span></label>
                                        <input type="text" name="gname" placeholder="" required="required" value="{{old('name')}}">
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label>Your Email<span>*</span></label>
                                        <input type="text" name="email" placeholder="example@mail.com" required="required" value="{{old('email')}}">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label>UserName<span>*</span></label>
                                        <input type="text" name="user_name" placeholder="user name" required="required" value="{{old('username')}}">
                                        @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Your Password<span>*</span></label>
                                        <input type="password" name="password" placeholder="" required="required" value="{{old('password')}}">
                                        @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Confirm Password<span>*</span></label>
                                        <input type="password" name="password_confirmation" placeholder="" required="required" value="{{old('password_confirmation')}}">
                                        @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-5">
                                    <div class="row">

                                            <div class="col-4">
                                                <label> Gender<span>*</span></label>
                                            </div>
                                    
                                            <div class="col-sm-4">
                                                <input style="width: 25px" type="radio" name="gender" value="Male"/>Male 
                                            </div>
                                            <div class="col-sm-4">
                                                <input style="width: 25px" type="radio" name="gender" value="Female"/>Female 
                                            </div>
                                            
                                            
                                    
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="form-group">
                                        <label>Phone Number<span>*</span></label>
                                        <input type="phone" value="{{old('phone')}}" name="phone" placeholder="+251......." required="required" >
                                        @error('phone')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label>TIN Number<sm>(optional)</sm></label>
                                        <input type="text" id=""tin_number" name="tin_number" placeholder="Tin number"  autocomplete="on">
                                        @error('tin_number')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    </div>
                                    <div class="col-6">
                                    <div class="form-group">
                                        <label>Company Name<sb>(optional)</sb></label>
                                        <input type="text" name="company_name" placeholder="" value="{{old('company_name')}}">
                                        @error('phone')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group login-btn">
                                        <button class="btn col-6" type="submit">Register</button>  If you have account
                                        <a href="{{route('login.form')}}" class="lost-pass" ><strong>Login</strong></a>
                                       </div>
                                </div>
                            </div>
                        </form>
                        <!--/ End Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Login -->
@endsection



@push('script')
<script type="text/javascript">
        var route = "{{ url('autocomplete-search') }}";
        $('#tin').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script>
@endpush