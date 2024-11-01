@extends('app')
@section('title', 'Privacy Settings')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Privacy Settings</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Privacy Settings</li>
            </ul>
        </div>
    </div>
</section>
<section class="user-setting-section profile-section user-setting-section mt-50">
    <div class="container">
        <div class="row justify-content-center">
            @include('common.user_sidebar')
            <div class="col-xl-8 col-md-7">
                <div class="page-title">
                    Privacy Settings
                </div>
                <div class="input-info-box mt-30">
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="my-notification-box">
                                    <div class="left">
                                        <div class="top">
                                            <div class="icon">
                                                <i class="fas fa-user-lock"></i>
                                            </div>
                                            <h5>
                                                Do you want to show your last login time?
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="toggle-button">
                                            <input type="checkbox" class="btn_privacy_settings last_login" data-action="last_login" id="switch" @if($user->show_last_login == 1) checked @endif><label for="switch">Yes</label>
                                            <span>Yes</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-20">
                                <div class="my-notification-box">
                                    <div class="left">
                                        <div class="top">
                                            <div class="icon">
                                                <i class="fas fa-ban"></i>
                                            </div>
                                            <h5>
                                                Who can texting you?
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="toggle-button">
                                            <input type="checkbox" class="btn_privacy_settings block_male" data-action="block_male" id="switch1" @if($user->block_male_msg == 1) checked @endif><label for="switch1">Male</label>
                                            <span>Male</span>
                                        </div>
                                        <div class="toggle-button">
                                            <input type="checkbox" class="btn_privacy_settings block_female" data-action="block_female" id="switch2" @if($user->block_female_msg == 1) checked @endif><label for="switch2">Female</label>
                                            <span>Female</span>
                                        </div>
                                        <div class="toggle-button">
                                            <input type="checkbox" class="btn_privacy_settings block_trans" data-action="block_trans" id="switch3" @if($user->block_trans_msg == 1) checked @endif><label for="switch3">Trans</label>
                                            <span>Trans</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-20">
                                <div class="my-notification-box">
                                    <div class="left">
                                        <div class="top">
                                            <div class="icon">
                                                <i class="fas fa-envelope"></i>
                                            </div>
                                            <h5>Email Notification:</h5>
                                        </div>
                                        <div class="toggle-button mt-2">
                                            <input type="checkbox" class="btn_privacy_settings block_all_email" data-action="block_all_email" id="switch5" @if($user->block_all_email == 1) checked @endif ><label for="switch5">Toggle</label>
                                            <span>Subscribe All Emails</span>
                                        </div>
                                        <div class="toggle-button">
                                            <input type="checkbox" class="btn_privacy_settings block_money_opp" data-action="block_money_opp" id="switch6" @if($user->block_money_making_opp_email == 1) checked @endif ><label for="switch6">Toggle</label>
                                            <span>Money Making opportunities Helping the Site</span>
                                        </div>
                                        <div class="toggle-button">
                                            <input type="checkbox" class="btn_privacy_settings block_local_event" data-action="block_local_event" id="switch7" @if($user->block_local_event_meet_up_email == 1) checked @endif ><label for="switch7">Toggle</label>
                                            <span>Local Events and Meet Up News</span>
                                        </div>
                                        <div class="toggle-button">
                                            <input type="checkbox" class="btn_privacy_settings block_like_favorite" data-action="block_like_favorite" id="switch8" @if($user->block_like_favorite_email == 1) checked @endif ><label for="switch8">Toggle</label>
                                            <span>Likes, Favorites, and Matches</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-20">
                                <div class="my-notification-box">
                                    <div class="accordion" id="accordion_blocked_users" style="width: 100%;">
                                        <div class="card">
                                            <div class="card-header" id="blocked_users">
                                                <button class="collapsed" type="button" data-toggle="collapse" data-target="#collapse_blocked_users" aria-expanded="false" aria-controls="collapse_blocked_users">
                                                    <div class="icon">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <span>Blocked Users ({{ count($blocked)}})</span>
                                                    <div class="t-icon">
                                                        <i class="fas fa-plus"></i>
                                                        <i class="fas fa-minus"></i>
                                                    </div>
                                                </button>
                                            </div>
                                            <div id="collapse_blocked_users" class="collapse" aria-labelledby="blocked_users" data-parent="#accordion_blocked_users">
                                                <div class="card-body">
                                                    <div class="profile-main-content">
                                                        <div class="profile-friends">
                                                            @if(!$blocked->isEmpty())
                                                            @foreach($blocked as $user)
                                                            <div class="single-friend">
                                                                @php
                                                                $data = get_single_row('users', 'id', $user->config_user_id, '', '', '', '');
                                                                @endphp
                                                                @if(!empty($data->profile_image))
                                                                <a href="{{ url('public_profile') }}/{{$data->unique_id}}" class="name" target="_blank">
                                                                    <img src="{{ asset('assets/app_images') }}/{{$data->profile_image}}" alt="" style="width: 80px; height: 95px;">
                                                                </a>
                                                                @else
                                                                <a href="{{ url('public_profile') }}/{{ $data->unique_id }}" class="name" target="_blank">
                                                                    <img src="{{ asset('assets/app_images/user.png') }}" alt="" style="width: 80px; height: 95px;">
                                                                </a>
                                                                @endif
                                                                <div class="content">
                                                                    <a href="{{ url('public_profile') }}/{{ $data->unique_id }}" class="name" target="_blank">
                                                                        {{ $data->first_name.' '. $data->last_name}},
                                                                        {{ number_format($data->age, 0) }}
                                                                    </a>
                                                                    <p class="date">
                                                                        {{ $data->city }}, {{ $data->country }}<br>
                                                                        {{ $data->iam }}
                                                                    </p>
                                                                    <a href="javascript:void(0)" class="connnect-btn onnnect_btn btn_user_configs" title="Unblock this user" data-id="{{ $user->config_user_id }}" data-action="unblock">Unblock</a>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @else
                                                            <div class="alert alert-primary mt-4" role="alert">
                                                                <span>You have not blocked any users.</span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-20">
                                <div class="my-notification-box">
                                    <div class="accordion" id="accordion_visitors" style="width: 100%;">
                                        <div class="card">
                                            <div class="card-header" id="visitors">
                                                <button class="collapsed" type="button" data-toggle="collapse" data-target="#collapse_visitors" aria-expanded="false" aria-controls="collapse_visitors">
                                                    <div class="icon">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                    <span>Who Viewed Your Profile? ({{$today_visitor_count}})</span>
                                                    <div class="t-icon">
                                                        <i class="fas fa-plus"></i>
                                                        <i class="fas fa-minus"></i>
                                                    </div>
                                                </button>
                                            </div>
                                            <div id="collapse_visitors" class="collapse" aria-labelledby="visitors" data-parent="#accordion_visitors">
                                                <div class="card-body">
                                                    <div class="profile-main-content">
                                                        <h5 class="mt-30">Today </h5>
                                                        <div class="profile-friends">
                                                            @if(!$today_visitors->isEmpty())
                                                            @foreach($today_visitors as $today_visit)
                                                            <div class="single-friend">
                                                                @php
                                                                $data = get_single_row('users', 'id', $today_visit->visitor_user_id, '', '', '', '');
                                                                @endphp
                                                                @if(!empty($data->profile_image))
                                                                <a href="{{ url('public_profile') }}/{{$data->unique_id}}" class="name" target="_blank">
                                                                    <img src="{{ asset('assets/app_images') }}/{{$data->profile_image}}" alt="" style="width: 80px; height: 95px;">
                                                                </a>
                                                                @else
                                                                <a href="{{ url('public_profile') }}/{{ $data->unique_id }}" class="name" target="_blank">
                                                                    <img src="{{ asset('assets/app_images/user.png') }}" alt="" style="width: 80px; height: 95px;">
                                                                </a>
                                                                @endif
                                                                <div class="content">
                                                                    <a href="{{ url('public_profile') }}/{{ $data->unique_id }}" class="name" target="_blank">
                                                                        {{ $data->first_name.' '. $data->last_name}}<sup class="count"> {{check_record_existing('visitors', 'user_id', Auth::user()->id, 'visitor_user_id', $today_visit->visitor_user_id, '', '', 'created_at', date("Y-m-d")) }} </sup>,
                                                                        {{ number_format($data->age, 0) }}
                                                                    </a>
                                                                    <p class="date">
                                                                        {{ $data->city }}, {{ $data->country }}<br>
                                                                        {{ $data->iam }}
                                                                    </p>
                                                                    <a href="{{ url('public_profile') }}/{{ $data->unique_id }}" class="connnect-btn onnnect_btn" title="View">View</a>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @else
                                                            <div class="alert alert-primary mt-4" role="alert">
                                                                <span>Null.</span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <h5 class="mt-30">All </h5>
                                                        <div class="profile-friends">
                                                            @if(!$visitors->isEmpty())
                                                            @foreach($visitors as $all_visit)
                                                            <div class="single-friend">
                                                                @php
                                                                $data1 = get_single_row('users', 'id', $all_visit->visitor_user_id, '', '', '', '');
                                                                @endphp
                                                                @if(!empty($data1->profile_image))
                                                                <a href="{{ url('public_profile') }}/{{$data1->unique_id}}" class="name" target="_blank">
                                                                    <img src="{{ asset('assets/app_images') }}/{{$data1->profile_image}}" alt="" style="width: 80px; height: 95px;">
                                                                </a>
                                                                @else
                                                                <a href="{{ url('public_profile') }}/{{ $data1->unique_id }}" class="name" target="_blank">
                                                                    <img src="{{ asset('assets/app_images/user.png') }}" alt="" style="width: 80px; height: 95px;">
                                                                </a>
                                                                @endif
                                                                <div class="content">
                                                                    <a href="{{ url('public_profile') }}/{{ $data1->unique_id }}" class="name" target="_blank">
                                                                        {{ $data1->first_name.' '. $data1->last_name}}<sup class="count"> {{check_record_existing('visitors', 'user_id', Auth::user()->id, 'visitor_user_id', $all_visit->visitor_user_id, '', '', '', '', '', '') }} </sup>,
                                                                        {{ number_format($data1->age, 0) }}
                                                                    </a>
                                                                    <p class="date">
                                                                        {{ $data1->city }}, {{ $data1->country }}<br>
                                                                        {{ $data1->iam }}
                                                                    </p>
                                                                    <a href="{{ url('public_profile') }}/{{ $data1->unique_id }}" class="connnect-btn onnnect_btn" title="View">View</a>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                            @else
                                                            <div class="alert alert-primary mt-4" role="alert">
                                                                <span>Null.</span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mt-20">
                                <div class="my-notification-box">
                                    <div class="left">
                                        <div class="top">
                                            <div class="icon">
                                                <i class="fas fa-certificate"></i>
                                            </div>
                                            <h5>Account Status:</h5>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="toggle-button">
                                            <strong><span class="icon"><i class="fas fa-check"></i></span> Verified</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-20">
                                <div class="my-notification-box">
                                    <div class="left">
                                        <div class="top">
                                            <div class="icon">
                                                <i class="fas fa-trash"></i>
                                            </div>
                                            <h5>Close Account:</h5>
                                        </div>
                                    </div>
                                    <div class="right">
                                        <div class="toggle-button">
                                            <a href="javascript:void(0)" class="custom-button" data-toggle="modal" data-target="#delete_account_modalbox"> Delete Account</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade filter-p" id="delete_account_modalbox" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h6 class="modal-title">Delete My Account</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="delete_account_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="content">
                        <h5>Warning:</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <p>If you delete your account, you will lose your data and access forever.</p>
                                <div class="my-input-box">
                                    <input type="password" name="password" placeholder="Enter Your Password">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="join-now-box">
                            <div class="joun-button">
                                <button type="button" class="custom-button btn_delete_account" title="Do you want to delete your account">Delete Account</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    $(document).on("click" , ".btn_privacy_settings" , function() {
        var action = $(this).attr('data-action');
        if(action == 'last_login'){
            if ($('input.last_login').is(':checked')) {
                var value = 1;
            }else{
                var value = 0;
            }
            update_user_settings(action, value);
        }else if(action == 'block_male'){
            if ($('input.block_male').is(':checked')) {
                var value = 1;
            }else{
                var value = 0;
            }
            update_user_settings(action, value);
        }else if(action == 'block_female'){
            if ($('input.block_female').is(':checked')) {
                var value = 1;
            }else{
                var value = 0;
            }
            update_user_settings(action, value);
        }else if(action == 'block_trans'){
            if ($('input.block_trans').is(':checked')) {
                var value = 1;
            }else{
                var value = 0;
            }
            update_user_settings(action, value);
        }else if(action == 'block_all_email'){
            if ($('input.block_all_email').is(':checked')) {
                var value = 1;
            }else{
                var value = 0;
            }
            update_user_settings(action, value);
        }else if(action == 'block_money_opp'){
            if ($('input.block_money_opp').is(':checked')) {
                var value = 1;
            }else{
                var value = 0;
            }
            update_user_settings(action, value);
        }else if(action == 'block_local_event'){
            if ($('input.block_local_event').is(':checked')) {
                var value = 1;
            }else{
                var value = 0;
            }
            update_user_settings(action, value);
        }else if(action == 'block_like_favorite'){
            if ($('input.block_like_favorite').is(':checked')) {
                var value = 1;
            }else{
                var value = 0;
            }
            update_user_settings(action, value);
        }
    });

    function update_user_settings(action, value){
        $.ajax({
            url:'{{ url('update_user_privacy_settings') }}',
            type:'post',
            data:{"_token": "{{ csrf_token() }}", 'action': action, 'value': value},
            dataType:'json',
            success:function(status){
                $(".confirm").prop("disabled", false);
                if(status.msg == 'success'){
                    toastr.success(status.response,"Success");
                    location.reload(true);
                } else if(status.msg=='error'){
                    toastr.error(status.response,"Error");
                }
            }
        });
    }

    $(document).on("click" , ".btn_delete_account" , function() {
        $(".btn_delete_account").text('Please wait...');
        $(".btn_delete_account").prop('disabled', 'true');
        var formData =  new FormData($("#delete_account_form")[0]);
        $.ajax({
            url:'{{ url('delete_account') }}',
            type: 'POST',
            data: formData,
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            success:function(status){
                if(status.msg=='success') {
                    toastr.success(status.response,"Success");
                    setTimeout(function(){
                        window.location.href = '{{ url('home') }}';
                    }, 2000);
                } else if(status.msg == 'error') {
                    $(".btn_delete_account").prop('disabled', false);
                    $(".btn_delete_account").text('Delete Account');
                    toastr.error(status.response,"Error");
                }
            }
        });
    });
</script>
@endpush