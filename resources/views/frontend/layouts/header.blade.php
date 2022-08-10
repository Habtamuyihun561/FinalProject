<header class="header shop">
    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Left -->
                    <div class="top-left">
                        <ul class="list-main">
                            @php
                                $settings=DB::table('settings')->get();
                                
                            @endphp
                            <li><i class="ti-headphone-alt"></i>@foreach($settings as $data) {{$data->phone}} @endforeach</li>
                            <li><i class="ti-email"></i> @foreach($settings as $data) {{$data->email}} @endforeach</li>
                        </ul>
                    </div>
                    <!--/ End Top Left -->
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <!-- Top Right -->
                    <div class="right-content">
                        <ul class="list-main">
                       
                            {{-- <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li> --}}
                            @auth 
                                @if(Auth::user()->role=='admin')
                                    <li><i class="ti-user"></i> <a href="{{route('admin')}}"  target="_blank">{{ __('routes.dashboard') }}</a></li>
                                @else 
                                    <li><i class="ti-user"></i> <a href="{{route('user', app()->getLocale())}}"  target="_blank">{{ __('routes.dashboard') }}</a></li>
                                @endif
                                <li><i class="ti-power-off"></i> <a href="{{route('user.logout', app()->getLocale())}}">Logout</a></li>

                            @else
                            
                                <li><i class="ti-power-off"></i><a href="{{route('login.form', app()->getLocale())}}">{{__('routes.login')}} /</a> <a href="{{route('register.form')}}">Register</a></li>
                            @endauth
                           
                    </div>
                    <!-- End Top Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-12">
                    <!-- Logo -->
                    <div class="logo">
                        @php
                            $settings=DB::table('settings')->get();
                        @endphp                    
                    </div>
                    <!--/ End Logo -->
                   
                    <div class="mobile-nav">
                    
                    </div>
                </div>
                
              
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">	
                                    <div class="nav-inner">	
                                        <ul class="nav main-menu menu navbar-nav">
                                            <li class="{{Request::path()=='home' ? 'active' : ''}}"><a href="{{route('blog')}}">{{ ('Home') }}</a></li>
                                            <li class="{{Request::path()=='about-us' ? 'active' : ''}}"><a href="{{route('about-us')}}">{{ ('About Us') }}</a></li>
                                            <li class=""><a href="{{route('free-auction')}}">{{ ('Free Auction') }}</a></li>												
                                               
                                            <li class="{{Request::path()=='service' ? 'active' : ''}}"><a href="{{route('service')}}">{{ ('Service') }}</a></li>									
                                               
                                            <li class="{{Request::path()=='contact' ? 'active' : ''}}"><a href="{{route('contact')}}">{{ __('message.contact_us') }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>