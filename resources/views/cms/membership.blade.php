@extends('app')
@section('title', 'Membership')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Memebership Plans</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Memebership Plans</li>
            </ul>
        </div>
    </div>
</section>

<section class="membership-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="content">
                    <div class="section-header">
                        <h2 class="title">
                            Premium Memebership Plan
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="pricing-plan-wrapper">
                    <img class="left-img" src="{{ asset('assets/images/membership/left-img.png') }}" alt="">
                    <img class="right-img" src="{{ asset('assets/images/membership/right-img.png') }}" alt="">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="single-plan">
                                <p class="duration">Monthly</p>
                                <h4 class="number">$ 4.95</h4>
                                <p class="stamet mb-30 mt-30">
                                    A premium membership will allow you to view messages from other members. Being a premium member allows you to communicate with others on the site
                                </p>
                                <p class="duration">Basic<br>(Save 0%)</p>
                                <button type="button" class="custom-button">Buy Now!</button>
                                <img class="shape" src="{{ asset('assets/images/membership/plan-bg.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="single-plan">
                                <p class="duration">Quarterly</p>
                                <h4 class="number">$ 9.95</h4>
                                <p class="stamet mb-30 mt-30">
                                    A premium membership will allow you to view messages from other members. Being a premium member allows you to communicate with others on the site
                                </p>
                                <p class="duration">Regular<br>(Save 32%)</p>
                                <button type="button" class="custom-button">Buy Now!</button>
                                <img class="shape" src="{{ asset('assets/images/membership/plan-bg.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="single-plan">
                                <p class="duration">Half Year</p>
                                <h4 class="number">$ 19.95</h4>
                                <p class="stamet mb-30 mt-30">
                                    A premium membership will allow you to view messages from other members. Being a premium member allows you to communicate with others on the site
                                </p>
                                <p class="duration">Intermediate<br>(Save 32%)</p>
                                <button type="button" class="custom-button">Buy Now!</button>
                                <img class="shape" src="{{ asset('assets/images/membership/plan-bg.png') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="single-plan">
                                <p class="duration">Yearly</p>
                                <h4 class="number">$ 29.95</h4>
                                <p class="stamet mb-30 mt-30">
                                    A premium membership will allow you to view messages from other members. Being a premium member allows you to communicate with others on the site
                                </p>
                                <p class="duration">Advanced<br>(Save 50%)</p>
                                <button type="button" class="custom-button">Buy Now!</button>
                                <img class="shape" src="{{ asset('assets/images/membership/plan-bg.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pricing-plans">
        <img class="shape1" src="{{ asset('assets/images/join/heartshape.png') }}" alt="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="contact-link">
                        If you have any questions <a href="{{url('contact_us')}}">Contact Us</a>
                    </p>
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