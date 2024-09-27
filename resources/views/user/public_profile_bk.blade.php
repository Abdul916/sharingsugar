@extends('app')
@section('title', 'Public Profile')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Public Profile</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Public Profile</li>
            </ul>
        </div>
    </div>
</section>
<section class="profile-section user-setting-section">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="left-profile-area">
                    @if(!empty($user->profile_image))
                    <img src="{{ asset('assets/app_images') }}/{{$user->profile_image}}" alt="" style="width: 100%; border-radius: 5%">
                    @else
                    <img src="{{ asset('assets/images/profile/profile-user.png') }}" alt="" style="border-radius: 5%">
                    @endif
                </div>
            </div>

            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 l-dtl-rgt-col-m">
                <div class="page-title">
                    Public Profile
                    @if($user->id == Auth::user()->id)
                    <div class="right">
                        <a href="{{ url('edit_profile') }}" class="accept">Edit Profile</a>
                    </div>
                    @endif
                </div>

                <div class="input-info-box">
                    <div class="header" style="font-size: 40px;">
                        @if(!empty($user->username))
                        {{$user->username}},
                        @else
                        {{ strstr($user->email, '@', true) }},
                        @endif
                        <span class="left">
                            {{ number_format($user->age, 0) }}
                        </span>
                    </div>

                    <div class="row">
                        <div class="col-md-9">
                            <a href="javascript:void(0)" class="custom_button">{{ $user->iam }}</a>
                        </div>
                        <div class="col-md-3">
                            <a href="javascript:void(0)" class="font_awesome_bg icon"><i class="far fa-comments"></i></a>
                        </div>

                    </div>

                    <div class="row mt-30">
                        <div class="col-md-12">
                            <button type="button" class="custom-button mb-2 @if($user->id == Auth::user()->id) disabled @else btn_block_user @endif" data-id="{{$user->id}}" title="Block this user"><i class="fas fa-ban"></i> Block</button>
                            <button type="button" class="custom-button mb-2 @if($user->id == Auth::user()->id) disabled @else btn_block_user @endif" data-id="{{$user->id}}" title="Report this user"><i class="fas fa-flag"></i> Report User</button>
                            <button type="button" class="custom-button mb-2 @if($user->id == Auth::user()->id) disabled @else btn_block_user @endif" data-id="{{$user->id}}" title="Add to my favirate list"><i class="fas fa-heart"></i> Favorite</button>
                            <button type="button" class="custom-button mb-2 @if($user->id == Auth::user()->id) disabled @else btn_block_user @endif" data-id="{{$user->id}}" title="Allow this user to view your private photos"><i class="fas fa-eye-slash"></i> Private Photos</button>
                        </div>
                    </div>
                    <hr>
                    <div class="content mt-30">
                        <div class="header">Basic Information</div>

                        <a href="javascript:void(0)" class="widget_tags mb-3">Last Login: {{ date('Y-m-d') }}</a>
                        <a href="javascript:void(0)" class="widget_tags mb-3">
                            Body Type:
                            @if($user->body_type == 1)
                            Skinny
                            @elseif($user->body_type == 2)
                            Thin
                            @elseif($user->body_type == 3)
                            Median
                            @elseif($user->body_type == 4)
                            Athletic
                            @elseif($user->body_type == 5)
                            Curvilinear
                            @else
                            Full Height
                            @endif
                        </a>
                        <a href="javascript:void(0)" class="widget_tags mb-3">
                            Height:
                            @php
                            $inch = $user->height / 2.54;
                            $feet   = intval( $inch / 12 );
                            $inches = $inch % 12;
                            $feet_inch   = $feet.' (ft) & '.$inches.' (ins)';

                            $kmeter    = $user->height % 100000;
                            $mmeter      = floor($kmeter / 100);
                            $cmeter     = $kmeter % 100;
                            $meter      = $mmeter.'.'.$cmeter.'(m)';
                            @endphp
                            {{ $feet_inch }} {{ $meter }}
                        </a>
                        <a href="javascript:void(0)" class="widget_tags mb-3">Weight:
                            {{ $user->weight }} (kg) | {{ ($user->weight * 2.20462)}} (lbs)
                        </a>

                        <a href="javascript:void(0)" class="widget_tags mb-3">DOB: {{ $user->dob }}</a>
                        <a href="javascript:void(0)" class="widget_tags mb-3">Age: {{$user->age}}</a>
                        <a href="javascript:void(0)" class="widget_tags mb-3">
                            Marital status:
                            @if($user->marital_status == 1)
                            Single
                            @elseif($user->marital_status == 2)
                            Married
                            @elseif($user->marital_status == 3)
                            Widowed
                            @else
                            Divorced
                            @endif
                        </a>
                        <a href="javascript:void(0)" class="widget_tags mb-3">Children: {{ $user->child }}</a>
                        <a href="javascript:void(0)" class="widget_tags mb-3">City: {{ $user->city }}</a>
                        <a href="javascript:void(0)" class="widget_tags mb-3">State: {{ $user->state }}</a>
                        <a href="javascript:void(0)" class="widget_tags mb-3">Country: {{ $user->country }}</a>

                        <div class="header mt-30">Looking For</div>
                        <a href="javascript:void(0)" class="custom_button">{{ $user->interestedin }}</a>

                        <div class="header mt-30">About Me</div>
                        {{ $user->about_me }}
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