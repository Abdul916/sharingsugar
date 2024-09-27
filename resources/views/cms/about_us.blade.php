@extends('app')
@section('title', 'About Us')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">About Us</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>About Us</li>
            </ul>
        </div>
    </div>
</section>
<section class="flirting-section about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center">
                    <div class="img">
                        <img src="{{ asset('assets/images/about/about-page-left.html.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="content">
                        <div class="section-header">
                            <h6 class="sub-title">
                                Get to Know More
                            </h6>
                            <h2 class="title">
                                About us
                            </h2>
                            <p>
                                We are here to build emotion, connect people and create happy stories.Online dating sites are the way to go for people seeking love or to meet singles while they don’t know where to find them. There are lots of online dating sites available which makes it .
                            </p>
                            <br>
                            <p class="mb-0">
                                As a result, the customer service desk recommends that
                                customers should consider contacting them via their website. We realize that it’s not a simple task to understand what options you have when it comes to contact with their help desk. We,
                                therefore, find it helpful if we share some of our research work with you.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="w-c-u-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="content">
                        <div class="section-header">
                            <h6 class="sub-title">
                                How We’re different
                            </h6>
                            <h2 class="title extra-padding">
                                Why Choose Us?
                            </h2>
                            <p class="text">
                                There are lots of online dating sites available which makes it difficult
                                to choose the one which can give you a serious partner....
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-w-c-u-box">
                        <div class="icon">
                            <img src="{{ asset('assets/images/e-c-u/icon1.png') }}" alt="">
                        </div>
                        <h4 class="title">
                            Dating
                        </h4>
                        <p>
                            Dating - Where two people who are attracted to each other spend time together.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-w-c-u-box">
                        <div class="icon">
                            <img src="{{ asset('assets/images/e-c-u/icon2.png') }}" alt="">
                        </div>
                        <h4 class="title">
                            Great Advices
                        </h4>
                        <p>
                            Dating - Where two people who are attracted to each other spend time together.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-w-c-u-box">
                        <div class="icon">
                            <img src="{{ asset('assets/images/e-c-u/icon3.png') }}" alt="">
                        </div>
                        <h4 class="title">
                            24/7Support
                        </h4>
                        <p>
                            Dating - Where two people who are attracted to each other spend time together.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-w-c-u-box">
                        <div class="icon">
                            <img src="{{ asset('assets/images/e-c-u/icon4.png') }}" alt="">
                        </div>
                        <h4 class="title">
                            Relationship
                        </h4>
                        <p>
                            Dating - Where two people who are attracted to each other spend time together.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="feature-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="content">
                        <div class="section-header">
                            <h6 class="sub-title extra-padding">
                                An Exhaustive List Of
                            </h6>
                            <h2 class="title extra-padding">
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
                            <div class="single-feature-list">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/feature/i1.png') }}" alt="">
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
                            <div class="single-feature-list">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/feature/i2.png') }}" alt="">
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
                            <div class="single-feature-list">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/feature/i3.png') }}" alt="">
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
                            <div class="single-feature-list">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/feature/i4.png') }}" alt="">
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
    <section class="join-now-section">
        <img class="shape1" src="{{ asset('assets/images/join/heartshape.png') }}" alt="">
        <img class="shape2" src="{{ asset('assets/images/join/img.png') }}" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="content">
                        <div class="section-header white-color">
                            <h2 class="title">
                                Best Ways to Find Your
                                True Sole Mate
                                </h2>
                        </div>
                        <a href="javascript:void(0)" class="custom-button">Join Now !</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sucess-stories-section">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content">
                    <div class="section-header">
                        <h6 class="sub-title">
                            Love in faith
                        </h6>
                        <h2 class="title">
                            Success Stories
                        </h2>
                        <p class="text">
                            Aliquam a neque tortor. Donec iaculis auctor turpis. Eporttitor
                            mattis ullamcorper urna. Cras quis elementum
                        </p>
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-story-box">
                        <div class="img">
                            <img src="{{ asset('assets/images/sucess/img1.jpg') }}" alt="">
                        </div>
                        <div class="content">
                            <div class="author">
                                <img src="{{ asset('assets/images/sucess/p1.png') }}" alt="">
                                <span></span>
                            </div>
                            <h4 class="title">
                                Love horoscope for Cancer
                                There will be...
                            </h4>
                            <p class="date">
                                December 10, 2021
                            </p>
                        </div>
                        <div class="box-footer">
                            <div class="left">
                                <ul class="box-social-links">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="right">
                                <a href="javascript:void(0)">
                                    Read More<i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-story-box">
                        <div class="img">
                            <img src="{{ asset('assets/images/sucess/img2.png') }}" alt="">
                        </div>
                        <div class="content">
                            <div class="author">
                                <img src="{{ asset('assets/images/sucess/p2.png') }}" alt="">
                                <span></span>
                            </div>
                            <h4 class="title">
                                ‘love at first sight’ is all
                                about initial attraction...
                            </h4>
                            <p class="date">
                                December 11, 2021
                            </p>
                        </div>
                        <div class="box-footer">
                            <div class="left">
                                <ul class="box-social-links">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="right">
                                <a href="javascript:void(0)">
                                    Read More<i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-story-box">
                        <div class="img">
                            <img src="{{ asset('assets/images/sucess/img3.png') }}" alt="">
                        </div>
                        <div class="content">
                            <div class="author">
                                <img src="{{ asset('assets/images/sucess/p3.png') }}" alt="">
                                <span></span>
                            </div>
                            <h4 class="title">
                                What women actually
                                want to feel on their...
                            </h4>
                            <p class="date">
                                December 14, 2021
                            </p>
                        </div>
                        <div class="box-footer">
                            <div class="left">
                                <ul class="box-social-links">
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="right">
                                <a href="javascript:void(0)">
                                    Read More<i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script>
</script>
@endpush