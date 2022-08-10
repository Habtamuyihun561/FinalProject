@extends('frontend.layouts.master')
<?php 

use Carbon\Carbon;
?>

@section('title','AUS | Home Page')

@section('main-content')
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="javascript:void(0);">Free Auction</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Breadcrumbs -->
    <!-- <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                     <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Auction Grid Sidebar</a></li>
                        </ul> 
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End Breadcrumbs -->
        
    <!-- Start Blog Single -->
    {{-- <div class="row">
				<div class="col-12"> --}}
                    {{-- <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Auction Document Detail</a></li>
                        </ul>
                    </div> --}}
					{{-- <div class="bread-inner">
						<ul class="bread-list">
							<li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="blog-single.html">About Us</a></li>
						</ul>
					</div> --}}
				{{-- </div>
			</div> --}}
    <section class="blog-single shop-blog grid section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        @foreach($posts as $post)
                        {{-- {{$post}} --}}
                            <div class="col-lg-6 col-md-6 col-12">
                                <!-- Start Single Blog  -->
                                <div class="shop-single-blog">
                                <img src="{{$post->photo}}" alt="{{$post->photo}}">
                                    <div class="content" style="text-align:left;">
                                        @php 
                                            $author_info=DB::table('users')->select('name')->where('id',$post->user_id)->get();
                                        @endphp
                                        <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i> {{$post->created_at->format('d M, Y. D')}}
                                            <span class="float-right">
                                                <i class="fa fa-user" aria-hidden="true"></i> 
                                                @foreach($author_info as $data)
                                                    @if($data->name)
                                                        {{$data->name}}
                                                    @else
                                                        Anonymous
                                                    @endif
                                                @endforeach
                                            </span>
                                        </p>
                                        <a href="{{route('blog.detail',$post->id)}}" class="title">{{$post->title}}</a>
                                        {{-- <p class="two_chars large"> {!! html_entity_decode($post->description) !!}</p> --}}
                                        <hr>
                                        <p>Ende date: <i style="color: red;"> {{ Carbon::createFromFormat('Y-m-d',$post->endDate)->format('d M, Y. D') }} </i> </p>
                                        <p>Intial price:  <b>{{ $post->min_price}} Birr </b></p>
                                        <a href="{{route('free-blog-detail',$post->id)}}" class="more-btn">Continue Reading</a>
                                    </div>
                                </div>
                                <!-- End Single Blog  -->
                            </div>
                        @endforeach
                        <div class="col-12">
                            <!-- Pagination -->
                            {{-- {{$posts->appends($_GET)->links()}} --}}
                            <!--/ End Pagination -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="main-sidebar">
                        <!-- Single Widget -->
                        <div class="single-widget search">
                            <form class="form" method="GET" action="{{route('blog.search')}}">
                                <input type="text" placeholder="Search Here..." name="search">
                                <button class="button" type="sumbit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget category">
                            <h3 class="title">Auction Categories</h3>
                            <ul class="categor-list">
                                @if(!empty($_GET['category']))
                                    @php 
                                        $filter_cats=explode(',',$_GET['category']);
                                    @endphp
                                @endif
                            <form action="{{route('blog.filter')}}" method="POST">
                                    @csrf
                                    {{-- {{count(Helper::postCategoryList())}} --}}
                                    @foreach(Helper::postCategoryList('posts') as $cat)
                                    <li>
                                        <a href="{{route('blog.category',$cat->slug)}}">{{$cat->title}} </a>
                                    </li>
                                    @endforeach
                                </form>
                                
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget recent-post">
                            <h3 class="title">Recent Auction</h3>
                            @foreach($recent_posts as $post)
                                <!-- Single Post -->
                                <div class="single-post">
                                    <div class="image">
                                        <img src="{{$post->photo}}" alt="{{$post->photo}}">
                                    </div>
                                    <div class="content">
                                        <h5><a href="#">{{$post->title}}</a></h5>
                                        <ul class="comment">
                                        @php 
                                            $author_info=DB::table('users')->select('name')->where('id',$post->added_by)->get();
                                        @endphp
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$post->created_at->format('d M, y')}}</li>
                                            <li><i class="fa fa-user" aria-hidden="true"></i> 
                                                @foreach($author_info as $data)
                                                    @if($data->name)
                                                        {{$data->name}}
                                                    @else
                                                        Anonymous
                                                    @endif
                                                @endforeach
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single Post -->
                            @endforeach
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                       
                        <!--/ End Single Widget -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Blog Single -->
@endsection
@push('styles')
    <style>
        .pagination{
            display:inline-flex;
        }
        .two_chars{
        font-family: monospace;
        width: 2ch;
        overflow: hidden;
        white-space: nowrap;
        }

        .large{
        font-size: 2em;
        }
    </style>

@endpush