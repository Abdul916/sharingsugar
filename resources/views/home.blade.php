@extends('app')
@section('title', 'Home')
@section('content')

<section class="banner-section">
    <img class="img1 wow fadeInLeft" src="{{asset('assets/images/banner/aimg1.png')}}" alt="">
    <img class="img2 wow fadeInRight" src="{{asset('assets/images/banner/aimg2.png')}}" alt="">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-5">
                <h1 class="main-title wow fadeInLeft">
                    Find Love Your Life
                </h1>
                <div class="join-now-box wow fadeInUp">
                    <form id="search-form" action="members" method="GET">
                        <div class="single-option gender">
                            <p class="title">
                                Seeking a:
                            </p>
                            <div class="option">
                                <div class="s-input mr-4">
                                    <input type="radio" name="interestedin" id="Sugar_Daddy" value="Sugar Daddy" checked><label for="Sugar_Daddy">Sugar Daddy</label>
                                </div>
                                <div class="s-input">
                                    <input type="radio" name="interestedin" id="Sugar_Mommy" value="Sugar Mommy"><label for="Sugar_Mommy">Sugar Mommy</label>
                                </div>
                                {{-- <div class="s-input">
                                    <input type="radio" name="interestedin" id="Sugar_Daddy_Mommy" value="Sugar Daddy Mommy"><label for="Sugar_Daddy_Mommy">Sugar Daddy Mommy</label>
                                </div>
                                <div class="s-input">
                                    <input type="radio" name="interestedin" id="Sugar_Baby_Man" value="Sugar Baby Man"><label for="Sugar_Baby_Man">Sugar Baby Man</label>
                                </div>
                                <div class="s-input">
                                    <input type="radio" name="interestedin" id="Sugar_Baby_Women" value="Sugar Baby Women"><label for="Sugar_Baby_Women">Sugar Baby Women</label>
                                </div>
                                <div class="s-input">
                                    <input type="radio" name="interestedin" id="Sugar_Baby_Trans" value="Sugar Baby Trans"><label for="Sugar_Baby_Trans">Sugar Baby Trans</label>
                                </div> --}}
                            </div>
                        </div>
                        <div class="single-option age">
                            <input type="hidden" name="Age" value="Age">
                            <p class="title">
                                Ages :
                            </p>
                            <div class="option">
                                <div class="s-input mr-3">
                                    <select class="select-bar" name="minAge">
                                        <option value="18">18</option>
                                        <option value="20">20</option>
                                        <option value="24">24</option>
                                    </select>
                                </div>
                                <div class="separator">
                                    -
                                </div>
                                <div class="s-input ml-3">
                                    <select class="select-bar" name="maxAge">
                                        <option value="40">40</option>
                                        <option value="45">45</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="joun-button mt-2">
                            <button type="submit" class="custom-button">Join Now!</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="feature-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-feature wow fadeInUp" data-wow-delay="0.1s">
                    <div class="icon">
                        <img src="{{asset('assets/images/feature/icon01.png')}}" alt="">
                    </div>
                    <h4>
                        100% Verifide
                    </h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-feature wow fadeInUp" data-wow-delay="0.2s">
                    <div class="icon">
                        <img src="{{asset('assets/images/feature/icon02.png')}}" alt="">
                    </div>
                    <h4>
                        Most Secure
                    </h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-feature wow fadeInUp" data-wow-delay="0.3s">
                    <div class="icon">
                        <img src="{{asset('assets/images/feature/icon03.png')}}" alt="">
                    </div>
                    <h4>
                        100% Privacy
                    </h4>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-feature wow fadeInUp" data-wow-delay="0.4s">
                    <div class="icon">
                        <img src="{{asset('assets/images/feature/icon04.png')}}" alt="">
                    </div>
                    <h4>
                        Smart Matching
                    </h4>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- <section class="flirting-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="content">
                    <div class="section-header">
                        <h6 class="sub-title extra-padding wow fadeInUp">
                            Meet New People Today!
                        </h6>
                        <h2 class="title extra-padding wow fadeInUp">
                            Start Flirting
                        </h2>
                        <p>
                            In our modern day and age dating apps have become an
                            integral part of our lives. They allow you to check the profile of singles living near
                            you, to chat with them, to meet them and maybe to fall in love.
                        </p>
                        <br>
                        <p>
                            If you’re searching for a simple dating app with free features
                            allowing to meet singles, you’re in good hands with Pairko. With Pairko you get all you
                            need from a mobile dating app, which presents you thousands of users through your
                            smartphone in a very pleasant experience.
                        </p>
                    </div>
                    <a href="#" class="custom-button">Seek Your Partner</a>
                </div>
            </div>
            <div class="col-lg-6 align-self-center">
                <div class="img">
                    <img class="bg-shape" src="/assets/images/flirting/circle.png')}}" alt="">
                    <img src="/assets/images/flirting/illutration.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</section> --}}
<section class="how-it-work-section">
    <img class="shape1" src="{{asset('assets/images/h-it-w/circle-shape.png')}}" alt="">
    <img class="shape2" src="{{asset('assets/images/h-it-w/bird.png')}}" alt="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content">
                    <div class="section-header">
                        <h6 class="sub-title extra-padding wow fadeInUp">
                            REASONS TO JOIN
                        </h6>
                        <h2 class="title wow fadeInUp">
                            Why Choose To Become a Member
                        </h2>
                        <p class="text wow fadeInUp">You’re just 3 steps away from a great date </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-work-box wow fadeInUp" data-wow-delay="0.1s">
                    <div class="icon">
                        <a href="{{url('members')}}"><img src="{{ asset('assets/images/h-it-w/icon1.png') }}" alt=""></a>
                        <div class="number">01</div>
                    </div>
                    <h4 class="title">100% FREE Register</h4>
                    <p>You can register and create your profile, and search for members for FREE!</p>
                    {{-- <a href="{{url('members')}}" class="custom-button">Join Now !</a> --}}
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-work-box wow fadeInUp" data-wow-delay="0.2s">
                    <div class="icon">
                        <a href="{{url('membership')}}"><img src="{{ asset('assets/images/h-it-w/icon2.png') }}" alt=""></a>
                        <div class="number">02</div>
                    </div>
                    <h4 class="title">Find The Perfect Arrangement</h4>
                    <p>Our goal is to get you paired with the perfect Sugar Daddy or Sugar Baby!</p>
                    {{-- <a href="{{url('membership')}}" class="custom-button">Join Now !</a> --}}
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-work-box wow fadeInUp" data-wow-delay="0.3s">
                    <div class="icon">
                        <a href="{{url('contact_us')}}"><img src="{{ asset('assets/images/h-it-w/icon3.png') }}" alt=""></a>
                        <div class="number">03</div>
                    </div>
                    <h4 class="title">Make Money!</h4>
                    <p>We will pay you to help others by writing about your experiences with Sugar Dating.</p>
                    {{-- <a href="{{url('membership')}}" class="custom-button">Join Now !</a> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<section class="statistics-section">
    <div class="container">
        <div class="statistics-wrapper">
            <div class="row mb--20">
                <div class="col-md-4 col-sm-6">
                    <div class="stat-item wow fadeInUp" data-wow-delay="0.1s">
                        <div class="icon">
                            <img src="{{asset('assets/images/statistics/stat01.png')}}" alt="">
                        </div>
                        <div class="stat-content">
                            <h3 class="counter-item"><span class=" odometer" data-odometer-final="350"></span>M</h3>
                            <span class="info">Tickets Booked</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="stat-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon">
                            <img src="{{asset('assets/images/statistics/stat02.png')}}" alt="">
                        </div>
                        <div class="stat-content">
                            <h3 class="counter-item"><span class=" odometer" data-odometer-final="447"></span>M</h3>
                            <span class="info">Usefull Sessions</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6">
                    <div class="stat-item wow fadeInUp" data-wow-delay="0.3s">
                        <div class="icon">
                            <img src="{{asset('assets/images/statistics/stat03.png')}}" alt="">
                        </div>
                        <div class="stat-content">
                            <h3 class="counter-item"><span class=" odometer" data-odometer-final="60"></span>M</h3>
                            <span class="info">Talented Speakers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="join-now-section">
    <img class="shape1" src="{{ asset('assets/images/join/heartshape.png') }}" alt="">
    <img class="shape2" src="{{ asset('assets/images/join/img.png') }}" alt="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="content text-center">
                    <div class="section-header white-color">
                        <p class=" section_header_title">100% FREE TO JOIN</p>
                        <h2 class="title wow fadeInUp text-center">Where Romance Meets Finance.</h2>
                        <p class="section_header_title">Combine the wealthy and generous Sugar Daddies and Mommies, with the beautiful and sexy Sugar Babies!</p>
                    </div>
                    <a href="javascript:void(0)" class="custom-button">Share Your Experience</a>
                    <a href="javascript:void(0)" class="custom-button">Share Your Experience</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="feature-section extra-feature">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content">
                    <div class="section-header">
                        <h6 class="sub-title wow fadeInUp">
                            An Exhaustive List Of
                        </h6>
                        <h2 class="title extra-padding wow fadeInUp">
                            Amazing Features
                        </h2>
                        <p class="text">
                            To find meaningful connections, dates, and life partners.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content-area">
        <div class="left-image">
            <div class="offer">
                <div class="offer-inner-content">
                    <span class="fs">START NOW FOR</span>
                    <h2>
                        FREE
                    </h2>
                    <span class="ss">7 DAY TRIAL</span>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-5">
                    <div class="feature-lists">
                        <div class="single-feature-list wow fadeInUp" data-wow-delay="0.1s">
                            <div class="icon">
                                <img src="{{asset('assets/images/feature/i1.png')}}" alt="">
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    Simple to use
                                </h4>
                                <p>
                                    Simple steps to follow to have a matching
                                    connection.
                                </p>
                            </div>
                        </div>
                        <div class="single-feature-list wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon">
                                <img src="{{asset('assets/images/feature/i2.png')}}" alt="">
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    Smart Matching
                                </h4>
                                <p>
                                    Simple steps to follow to have a matching
                                    connection.
                                </p>
                            </div>
                        </div>
                        <div class="single-feature-list wow fadeInUp" data-wow-delay="0.3s">
                            <div class="icon">
                                <img src="{{asset('assets/images/feature/i3.png')}}" alt="">
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    Filter very fast
                                </h4>
                                <p>
                                    Simple steps to follow to have a matching
                                    connection.
                                </p>
                            </div>
                        </div>
                        <div class="single-feature-list wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon">
                                <img src="{{asset('assets/images/feature/i4.png')}}" alt="">
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    Cool community
                                </h4>
                                <p>
                                    Simple steps to follow to have a matching
                                    connection.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="latest-registered-section">
    <img class="shape" src="{{asset('assets/images/registered/shape.png')}}" alt="">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <div class="content">
                    <div class="section-header">
                        <h6 class="sub-title extra-padding wow fadeInUp">
                            Latest Registered
                        </h6>
                        <h2 class="title wow fadeInUp">
                            Members
                        </h2>
                        <p class="text">
                            if you have been looking for the someone
                            special of your life for long, then your
                            search ends here
                        </p>
                    </div>
                    <a href="#" class="custom-button">Join Now !</a>
                </div>
            </div>
            <div class="col-xl-6 align-self-center">
                <div class="registered-slider owl-carousel">
                    @foreach($latest_users as $user)
                    <div class="single-slider">
                        <div class="img">
                            @if(!empty($user->profile_image))
                            <img src="{{ asset('assets/app_images') }}/{{$user->profile_image}}" alt="" style="width: 100px;">
                            @else
                            <img src="{{ asset('assets/app_images/user.png') }}" alt="">
                            @endif
                        </div>
                        <div class="inner-content">
                            <h4 class="name">{{ $user['username'] }}</h4>
                            <p>{{ number_format($user['age'], 0)}} Years Old</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-50">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content">
                    <div class="section-header">
                        <h6 class="sub-title wow fadeInUp">YOU MIGHT ALSO LIKE</h6>
                        <h2 class="title wow fadeInUp">Related Posts</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach(get_random_posts('1', '3') as $rpost)
            <div class="col-lg-4 col-md-6">
                <a href="{{url('blog-detail')}}/{{$rpost->slug}}">
                    <div class="single-story-box wow fadeInUp" data-wow-delay="0.3s">
                        <div class="img">
                            @if(!empty($rpost->thumbnail))
                            <img src="{{asset('assets/posts_img')}}/{{$rpost->thumbnail }}" style="width: 340px; height: 240px;">
                            @else
                            <img src="{{ asset('assets/posts_img/no_image.png') }}" style="width: 340px; height: 240px;">
                            @endif
                        </div>
                        <div class="content">
                            <h4 class="title">
                                @php
                                echo mb_strimwidth($rpost->title, 0, 35, '...');
                                @endphp
                            </h4>
                            <p class="date text-dark">{{ date_with_month($rpost->created_at)}}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection