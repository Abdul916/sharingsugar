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

<section class="profile-section user-setting-section mt-50">
    @php
    $logged_id = Auth::user()->id;
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7">
                <div class="left-profile-area">
                    <div class="profile-about-box">
                        <div class="top-bg"></div>
                        <div class="p-inner-content">
                            <div class="profile-img">
                                @if(!empty($user->profile_image))
                                <img src="{{ asset('assets/app_images') }}/{{$user->profile_image}}" alt="" style="width: 100px; border-radius: 50%">
                                @else
                                <img src="{{ asset('assets/images/profile/profile-user.png') }}" alt="" style="border-radius: 5%">
                                @endif
                                <div class="active-online"></div>
                            </div>
                            <h5 class="name" style="color: #d72993">{{$user->username }}</h5>
                            <span>{{$user->first_name.' '. $user->last_name}}</span>
                            <ul class="p-b-meta-one">
                                <li>
                                    <span>{{ number_format($user->age, 0)}} Years Old</span>
                                </li>
                                <li>
                                    <span> <i class="fas fa-map-marker-alt"></i>{{$user->city}}, {{$user->country}}</span>
                                </li>
                            </ul>
                            <div class="p-b-meta-two">
                                @if($user->id != $logged_id)
                                <div class="left btn-block">
                                    <a href="{{ url('chat') }}?q={{ $user->unique_id }}" target="_blank" title="Chat Now" class="custom-button">
                                        <i class="far fa-envelope"></i> Go to Chat
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- <div class="profile-meta-box"> --}}
                        {{-- <ul class="p-m-b"> --}}
                            {{-- <li>
                                <a href="{{ url('chat') }}?q={{ $user->unique_id }}" target="_blank">
                                    <i class="far fa-envelope"></i>
                                </a>
                            </li> --}}
                            {{-- <li>
                                <a href="javascript:void(0)">
                                    <i class="far fa-bell"></i>
                                    <div class="number">04</div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fas fa-cogs"></i>
                                </a>
                            </li> --}}
                        {{-- </ul> --}}
                    {{-- </div> --}}

                    <div class="profile-uplodate-photo">
                        <h4 class="p-u-p-header">My Interest</h4>
                        <hr>
                        <span class="custom_button mb-2">I am a: {{ $user->iam }}</span>
                        <span class="custom_button mb-2">Looking for: {{ $user->interestedin }}</span>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-7">
                <div class="page-title">
                    Public Profile
                    @if($user->id == $logged_id)
                    <div class="right">
                        <a href="{{ url('profile') }}" class="accept">Back to Profile</a>
                    </div>
                    @endif
                </div>
                <div class="input-info-box">
                    @if($user->id == $logged_id)
                    <button type="button" class="custom-button configs_custom_button mb-2 disabled" title="Block this user"><i class="fas fa-ban"></i> Block</button>
                    <button type="button" class="custom-button configs_custom_button mb-2 disabled" title="Report this user"><i class="fas fa-flag"></i> Report User</button>
                    <button type="button" class="custom-button configs_custom_button mb-2 disabled" title="Add to my favirate list"><i class="fas fa-heart"></i> Favorite</button>
                    <button type="button" class="custom-button configs_custom_button mb-2 disabled" title="Allow this user to view your private photos"><i class="fas fa-eye-slash"></i> Private Photos</button>
                    @else

                    @php
                    $blocked = check_record_existing('user_configs', 'user_id', $logged_id, 'config_user_id', $user->id, 'type', '3', '', '');
                    $favorite = check_record_existing('user_configs', 'user_id', $logged_id, 'config_user_id', $user->id, 'type', '1', '', '');
                    // $report = check_record_existing('user_configs', 'user_id', $logged_id, 'config_user_id', $user->id, 'type', '4', '', '');
                    $allow = get_single_row('user_configs', 'user_id', $logged_id, 'config_user_id', $user->id, 'type', '5');
                    @endphp

                    @if ($blocked)
                    <button type="button" class="custom-button configs_custom_button mb-2 btn_user_configs" data-id="{{ $user->id }}" data-action="unblock" title="Unblock this user"><i class="fas fa-ban"></i> Unblock</button>
                    @else
                    <button type="button" class="custom-button configs_custom_button mb-2 btn_user_configs" data-id="{{ $user->id }}" data-action="block" title="Block this user"><i class="fas fa-ban"></i> Block</button>
                    @endif

                    {{-- @if($report)
                    <button type="button" class="custom-button configs_custom_button mb-2 disabled" title="User allready reported"><i class="fas fa-flag"></i> User Reported</button>
                    @else --}}
                    <button type="button" class="custom-button configs_custom_button mb-2 btn_report_user_modalbox" title="Report this user" data-id="{{ $user->id }}"><i class="fas fa-flag"></i> Report User</button>
                    {{-- @endif --}}

                    @if($favorite)
                    <button type="button" class="custom-button configs_custom_button mb-2 btn_user_configs" data-id="{{ $user->id }}" data-action="unfavorite" title="Add to my favirate list"><i class="fas fa-heart"></i> Unfavorite</button>
                    @else
                    <button type="button" class="custom-button configs_custom_button mb-2 btn_user_configs" data-id="{{ $user->id }}" data-action="favorite" title="Add to my favirate list"><i class="fas fa-heart"></i> Favorite</button>
                    @endif

                    @if (!empty($allow))
                    @if($allow->status != 2)
                    <button type="button" class="custom-button configs_custom_button mb-2 btn_user_configs" data-id="{{ $user->id }}" data-action="allow_private_photos" data-requested-id="{{ $allow->id }}" title="Allow this user to view your private photos"><i class="fas fa-eye-slash"></i> Allow Private Photos</button>
                    @else
                    <button type="button" class="custom-button configs_custom_button mb-2 btn_user_configs" data-id="{{ $user->id }}" data-action="block_private_photos" title="Block this user to view your private photos"><i class="fas fa-eye"></i> Block Private Photos</button>
                    @endif
                    @else
                    <button type="button" class="custom-button configs_custom_button mb-2 btn_user_configs" data-id="{{ $user->id }}" data-action="allow_private_photos" data-requested-id="" title="Allow this user to view your private photos"><i class="fas fa-eye-slash"></i> Allow Private Photos</button>
                    @endif

                    @endif


                </div>

                <div class="profile-main-content">
                    <div class="info-box">
                        <div class="header">
                            <h4 class="title">Basic Information</h4>
                        </div>
                        <div class="content">
                            <ul class="infolist">
                                <li>
                                    <span>last Login</span>
                                    <span class="text_align">{{ time_elapsed_string($user->last_login) }}</span>
                                </li>
                                <li>
                                    <span>Name</span>
                                    <span class="text_align">{{ $user->first_name }} {{ $user->last_name }}</span>
                                </li>
                                <li>
                                    <span>Birthday</span>
                                    <span class="text_align">{{ $user->dob }}</span>
                                </li>

                                <li>
                                    <span>Age</span>
                                    <span class="text_align">{{ number_format($user->age, 0) }}</span>
                                </li>

                                {{-- <li> --}}
                                    {{-- <span>I am a</span> --}}
                                    {{-- <span class="custom_button">{{ $user->iam }}</span> --}}
                                {{-- </li> --}}
                                {{-- <li> --}}
                                    {{-- <span>Looking for a</span> --}}
                                    {{-- <span class="custom_button">{{ $user->interestedin }}</span> --}}
                                {{-- </li> --}}
                                <li>
                                    <span>Marital status</span>
                                    <span class="text_align">
                                        @if($user->marital_status == 1)
                                        Single
                                        @elseif($user->marital_status == 2)
                                        Married
                                        @elseif($user->marital_status == 3)
                                        Widowed
                                        @else
                                        Divorced
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <span>Children</span>
                                    <span class="text_align">{{ $user->child }}</span>
                                </li>
                                <li>
                                    <span>City</span>
                                    <span class="text_align">{{ $user->city}}</span>
                                </li>
                                <li>
                                    <span>Country</span>
                                    <span class="text_align">{{ $user->country}}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="info-box">
                        <div class="header">
                            <h4 class="title">
                                Physical
                            </h4>
                        </div>
                        <div class="content">
                            <ul class="infolist">
                                <li>
                                    <span>
                                        Height
                                    </span>
                                    <span class="text_align">
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
                                    </span>
                                </li>
                                <li>
                                    <span>
                                        Weight
                                    </span>
                                    <span class="text_align">
                                        {{ $user->weight }} (kg) | {{ ($user->weight * 2.20462)}} (lbs)
                                    </span>
                                </li>
                                <li>
                                    <span>
                                        Body Type
                                    </span>
                                    <span class="text_align">
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
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="header">
                            <h4 class="title">
                                My Self
                            </h4>
                        </div>
                        <div class="content">
                            <p class="text">{{ $user->about_me }}</p>
                        </div>
                    </div>

                </div>
            </div>

            @php
            $public_photos = get_photos('user_photos', $user->id, '1', array('1, 2'));
            @endphp
            @if(!$public_photos->isEmpty())
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="profile-section single-community">
                    <div class="profile-aside-area">
                        <div class="recent-photo">
                            <h4 class="title">
                                <i class="fas fa-camera custom_color"></i> Recent Uploaded Photos
                            </h4>
                            <ul class="member-list">
                                @foreach($public_photos as $public)

                                @php
                                $liked = check_record_existing('like_images', 'user_id', $logged_id, 'photo_id', $public->id, '', '', '', '');
                                @endphp

                                <li>
                                    <img src="{{ asset('assets/app_images/user_photos') }}/{{$public->photo}}" alt="" class="photo_width">
                                    @if($liked)
                                    <a href="javascript:void(0)" class="heart_icon btn_like_photos" photo-user-id="{{$user->id}}" data-id="{{ $public->id }}" data-user-id="{{ $logged_id }}" data-action="unlike" title="Unlike this photo">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" class="heart_icon btn_like_photos" data-id="{{ $public->id }}" data-user-id="{{ $logged_id }}" photo-user-id="{{$user->id}}" data-action="like" title="Like this photo">
                                        <i class="far fa-heart"></i>
                                    </a>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @php
            $private_photos = get_photos('user_photos', $user->id, '2', array('1, 2'));
            @endphp
            @if(!$private_photos->isEmpty())

            @php
            $request_private_photo = get_single_row('user_configs', 'config_user_id', $logged_id, 'user_id', $user->id, 'type', '5');
            @endphp

            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="profile-section single-community">
                    <div class="profile-aside-area">
                        <div class="recent-photo">
                            <h4 class="title">
                                <i class="fas fa-camera custom_color"></i> Recent Uploaded Private Photos
                            </h4>
                            <ul class="member-list @if(@$request_private_photo->status != 2) private_img @endif">
                                @foreach($private_photos as $private)
                                @php
                                $private_liked = check_record_existing('like_images', 'user_id', $logged_id, 'photo_id', $private->id, '', '', '', '');
                                @endphp
                                <li>
                                    <img src="{{ asset('assets/app_images/user_photos') }}/{{$private->photo}}" alt="" class="photo_width">
                                    @if($private_liked)
                                    <a href="javascript:void(0)" class="heart_icon btn_like_photos" data-id="{{ $private->id }}" data-user-id="{{ $logged_id }}" data-action="unlike" title="Unlike this photo">
                                        <i class="fas fa-heart"></i>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" class="heart_icon btn_like_photos" data-id="{{ $private->id }}" data-user-id="{{ $logged_id }}" data-action="like" title="Like this photo">
                                        <i class="far fa-heart"></i>
                                    </a>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($request_private_photo))
            @if ($request_private_photo->status != 2)
            <div class="row mt-30">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="alert alert-success">
                        <span>Your request has been forwarded please wait for the approval.</span>
                    </div>
                </div>
            </div>
            @endif
            @else
            @if($user->id != $logged_id)
            <button type="button" class="custom-button configs_custom_button mb-2 mt-30 btn_user_configs" data-id="{{ $user->id }}" data-action="request_private_photos" title="Request for view user private photos"><i class="fas fa-eye-slash"></i> Request For Private Photos</button>
            @endif
            @endif

            @endif
        </div>
    </div>
</section>
<input type="hidden" name="logged_user_id" id="logged_user_id" value="{{$logged_id}}">
<input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
@endsection
@push('scripts')

@if($user->id != $logged_id)
<script>
    $(document).ready(function() {
        var visitor_user_id = $("#logged_user_id").val();
        var user_id = $("#user_id").val();
        $.ajax({
            url:'{{ url('visit_profile') }}',
            type: 'POST',
            data:{"_token": "{{ csrf_token() }}", 'user_id': user_id, 'visitor_user_id': visitor_user_id},
            dataType:'json'
        });
    });
</script>
@endif
@endpush