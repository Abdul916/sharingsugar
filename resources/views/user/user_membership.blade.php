@extends('app')
@section('title', 'Membership')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Membership</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Membership</li>
            </ul>
        </div>
    </div>
</section>
<section class="profile-section user-setting-section mt-50">
    <div class="container">
        <div class="row justify-content-center">
            @include('common.user_sidebar')


            <div class="col-xl-8 col-md-7">
                <div class="page-title">
                    My Membership
                    <div class="right">
                        <a href="{{ url('profile') }}" class="accept">Go to Profile</a>
                    </div>
                </div>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12 mb-30">
                        <div class="badge-box">
                            <div class="img text-center">
                                <img src="{{ asset('assets/images/badge/1.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">

                    @if(!empty($user->membership_price))
                    <div class="col-md-4 mb-30">
                        <div class="badge-box">
                            <div class="img"><i class="fas fa-calendar-alt icon_size"></i></div>
                            <div class="content">
                                <h6>{{ date_formated($user->membership_start) }}</h6>
                                <p>Started Date</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-30">
                        <div class="badge-box">
                            <div class="img"><i class="fas fa-calendar-alt icon_size"></i></div>
                            <div class="content">
                                <h6>{{ date_formated($user->membership_end) }}</h6>
                                <p>Ended Date</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-30">
                        <div class="badge-box">
                            <div class="img"><i class="far fa-money-bill-alt icon_size"></i></div>
                            <div class="content">
                                <h6>{{ '$'.number_format($user->membership_price, 0) }}</h6>
                                <p>Bought for</p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-12 mb-30">
                        <div class="badge-box">
                            <div class="content">
                                <h6>No Plan Selected</h6>
                                <p></p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="col-md-12 mb-30">
                        <div class="badge-box">
                            <div class="content">
                                <p>A premium membership will allow you to view messages from other members. Being a premium member allows you to communicate with others on the site.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-title">
                    Membership Plans
                    <div class="right">
                        <a href="{{ url('membership') }}" class="accept">Plan Options</a>
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