@extends('app')
@section('title', 'Requests')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            <h2 class="title extra-padding">Requests</h2>
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Requests</li>
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
                    Requests
                    <div class="right">
                        <a href="{{ url('profile') }}" class="accept">Go to Profile</a>
                    </div>
                </div>
                <div class="input-info-box mt-30">
                    <div class="content">
                        <section class="product-details-section tabs_section">
                            <div class="overlay">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item text-center">
                                        <a class="nav-link active" data-toggle="tab" href="#frist">
                                            <i class="fas fa-heartbeat"></i>
                                            Requests
                                        </a>
                                    </li>
                                    <li class="nav-item text-center">
                                        <a class="nav-link" data-toggle="tab" href="#second">
                                            <i class="fas fa-heartbeat"></i>
                                            View Sent Requests
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active frist" id="frist">
                                        <div class="tab-content-wrapper">
                                            <div class="profile-main-content">
                                                <h5 class="mt-30">Pending Requests </h5><span> for view your private photos.</span>
                                                <div class="profile-friends">
                                                    @if(!$pending->isEmpty())
                                                    @foreach($pending as $request)
                                                    <div class="single-friend ">
                                                        @php
                                                        $data1 = get_single_row('users', 'id', $request->config_user_id, '', '', '', '');
                                                        @endphp
                                                        @if(!empty($data1->profile_image))
                                                        <a href="{{ url('public_profile') }}/{{ $data1->unique_id }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/app_images') }}/{{$data1->profile_image}}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @else
                                                        <a href="{{ url('public_profile') }}/{{ $data1->unique_id }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/images/cummunity/img1.jpg') }}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @endif
                                                        <div class="content">
                                                            <a href="{{ url('public_profile') }}/{{ $data1->unique_id }}" class="name" target="_blank">
                                                                {{ $data1->first_name.' '. $data1->last_name }},
                                                                {{ number_format($data1->age, 0) }}
                                                            </a>
                                                            <p class="date">
                                                                {{ $data1->city }}, {{ $data1->country }}<br>
                                                                {{ $data1->iam }}
                                                            </p>
                                                            <a href="javascript:void(0)" class="connnect-btn onnnect_btn btn_user_configs" title="Allow this user to view your private photos" data-id="{{ $request->config_user_id }}" data-requested-id="{{ $request->id }}" data-action="allow_private_photos">Approve</a>
                                                            <div class="right float-right">
                                                                <a href="javascript:void(0)" class="app_button btn_user_configs" title="Block this user to view your private photos" data-id="{{ $request->config_user_id }}" data-action="block_private_photos">Decline</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <div class="alert alert-primary mt-4" role="alert">
                                                        <span>Currently, there is no one who sends you the request to see your private photos.</span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <hr>
                                                <h5 class="mt-30">Approved Requests </h5> <span> for view your private photos.</span>
                                                <div class="profile-friends">
                                                    @if(!$approved->isEmpty())
                                                    @foreach($approved as $approve)
                                                    <div class="single-friend ">
                                                        @php
                                                        $data2 = get_single_row('users', 'id', $approve->config_user_id, '', '', '', '');
                                                        @endphp
                                                        @if(!empty($data2->profile_image))
                                                        <a href="{{ url('public_profile') }}/{{ $data2->unique_id }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/app_images') }}/{{$data2->profile_image}}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @else
                                                        <a href="{{ url('public_profile') }}/{{ $data2->unique_id }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/images/cummunity/img1.jpg') }}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @endif
                                                        <div class="content">
                                                            <a href="{{ url('public_profile') }}/{{ $data2->unique_id }}" class="name" target="_blank">
                                                                {{ $data2->first_name.' '. $data2->last_name }},
                                                                {{ number_format($data2->age, 0) }}
                                                            </a>
                                                            <p class="date">
                                                                {{ $data2->city }}, {{ $data2->country }}<br>
                                                                {{ $data2->iam }}
                                                            </p>
                                                            <a href="javascript:void(0)" class="connnect-btn btn_user_configs" title="Block this user to view your private photos" data-id="{{ $approve->config_user_id }}" data-action="block_private_photos">Decline</a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <div class="alert alert-primary mt-4" role="alert">
                                                        <span>Currently, there is no one who can see your private photos.</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="second">
                                        <div class="tab-content-wrapper-second">
                                            <div class="profile-main-content">
                                                <h5 class="mt-30">Pending Requests </h5><span> for view users private photos.</span>
                                                <div class="profile-friends">
                                                    @if(!$my_pending->isEmpty())
                                                    @foreach($my_pending as $my_reqt)
                                                    <div class="single-friend ">
                                                        @php
                                                        $data3 = get_single_row('users', 'id', $my_reqt->user_id, '', '', '', '');
                                                        @endphp
                                                        @if(!empty($data3->profile_image))
                                                        <a href="{{ url('public_profile') }}/{{ $data3->unique_id }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/app_images') }}/{{$data3->profile_image}}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @else
                                                        <a href="{{ url('public_profile') }}/{{ $data3->unique_id }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/images/cummunity/img1.jpg') }}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @endif
                                                        <div class="content">
                                                            <a href="{{ url('public_profile') }}/{{ $data3->unique_id }}" class="name" target="_blank">
                                                                {{ $data3->first_name.' '. $data3->last_name}}
                                                                {{ number_format($data3->age, 0) }}
                                                            </a>
                                                            <p class="date">
                                                                {{ $data3->city }}, {{ $data3->country }}<br>
                                                                {{ $data3->iam }}
                                                            </p>
                                                            <a href="javascript:void(0)" class="connnect-btn onnnect_btn btn_user_configs" title="Delete Request" data-id="{{ $my_reqt->user_id }}" data-requested-id="{{ $my_reqt->id }}" data-action="delete_request">Delete</a>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <div class="alert alert-primary mt-4" role="alert">
                                                        <span>Currently, there is no one who sends you the request to see your private photos.</span>
                                                    </div>
                                                    @endif
                                                </div>
                                                <hr>
                                                <h5 class="mt-30">Approved Requests </h5><span> for view users private photos.</span>
                                                <div class="profile-friends">
                                                    @if(!$my_approved->isEmpty())
                                                    @foreach($my_approved as $my_app)
                                                    <div class="single-friend ">
                                                        @php
                                                        $data4 = get_single_row('users', 'id', $my_app->user_id, '', '', '', '');
                                                        @endphp
                                                        @if(!empty($data4->profile_image))
                                                        <a href="{{ url('public_profile') }}/{{ $data4->unique_id }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/app_images') }}/{{$data4->profile_image}}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @else
                                                        <a href="{{ url('public_profile') }}/{{ $data4->unique_id }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/images/cummunity/img1.jpg') }}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @endif
                                                        <div class="content">
                                                            <a href="{{ url('public_profile') }}/{{ $data4->unique_id }}" class="name" target="_blank">
                                                               {{ $data4->first_name.' '. $data4->last_name}}
                                                                {{ number_format($data4->age, 0) }}
                                                            </a>
                                                            <p class="date">
                                                                {{ $data4->city }}, {{ $data4->country }}<br>
                                                                {{ $data4->iam }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @else
                                                    <div class="alert alert-primary mt-4" role="alert">
                                                        <span>Currently, there is no one who can see your private photos.</span>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
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