@extends('app')
@section('title', 'Favorites')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Favorites</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Favorites</li>
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
                    My Favorites
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
                                            My Favorites ( {{ check_record_existing('user_configs', 'user_id', Auth::user()->id, '', '', 'type', '1', '', '') }} )
                                        </a>
                                    </li>
                                    <li class="nav-item text-center">
                                        <a class="nav-link" data-toggle="tab" href="#second">
                                            <i class="fas fa-heartbeat"></i>
                                            People Who Favorited Me ( {{ check_record_existing('user_configs', 'config_user_id', Auth::user()->id, '', '', 'type', '1', '', '') }} )
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active frist" id="frist">
                                        <div class="tab-content-wrapper">
                                            <div class="profile-main-content">
                                                <div class="profile-friends">
                                                    @foreach(get_complete_table('user_configs', 'user_id', Auth::user()->id, '1', '', '', '' ) as $my_favorite)
                                                    <div class="single-friend">
                                                        <?php $user_image = get_single_value('users', 'profile_image', $my_favorite->config_user_id); ?>
                                                        @if(!empty($user_image))
                                                        <a href="{{ url('public_profile') }}/{{ get_single_value('users', 'unique_id', $my_favorite->config_user_id) }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/app_images') }}/{{$user_image}}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @else
                                                        <a href="{{ url('public_profile') }}/{{ get_single_value('users', 'unique_id', $my_favorite->config_user_id) }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/images/cummunity/img1.jpg') }}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @endif

                                                        <div class="content">
                                                            <a href="{{ url('public_profile') }}/{{ get_single_value('users', 'unique_id', $my_favorite->config_user_id) }}" class="name" target="_blank">
                                                                {{ get_single_value('users', 'username', $my_favorite->config_user_id) }}
                                                                <div class="isvarify">
                                                                    <i class="fas fa-check-circle"></i>
                                                                </div>
                                                            </a>
                                                            <p class="date">
                                                                {{ get_single_value('users', 'iam', $my_favorite->config_user_id) }}
                                                            </p>
                                                            <a href="javascript:void(0)" class="connnect-btn btn_user_configs" title="Remove from my favorite" data-id="{{ $my_favorite->config_user_id }}" data-action="unfavorite">Unfavorite</a>
                                                            {{-- <div class="right">
                                                                <a href="javascript:void(0)" class="app_button mb-2" title="Chat">Chat</a>
                                                                <a href="javascript:void(0)" class="app_button mb-2 btn_user_configs" title="Remove from my favorite" data-id="{{ $my_favorite->config_user_id }}" data-action="unfavorite">Unfavorite</a>
                                                            </div> --}}
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="second">
                                        <div class="tab-content-wrapper-second">
                                            <div class="profile-main-content">
                                                <div class="profile-friends">
                                                    @foreach(get_complete_table('user_configs', 'config_user_id', Auth::user()->id, '1', '', '', '') as $me_favorite)
                                                    <div class="single-friend">
                                                        <?php $user_image = get_single_value('users', 'profile_image', $me_favorite->user_id); ?>
                                                        @if(!empty($user_image))
                                                        <a href="{{ url('public_profile') }}/{{ get_single_value('users', 'unique_id', $me_favorite->user_id) }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/app_images') }}/{{$user_image}}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @else
                                                        <a href="{{ url('public_profile') }}/{{ get_single_value('users', 'unique_id', $me_favorite->user_id) }}" class="name" target="_blank">
                                                            <img src="{{ asset('assets/images/cummunity/img1.jpg') }}" alt="" style="width: 80px; height: 95px;">
                                                        </a>
                                                        @endif
                                                        <div class="content">
                                                            <a href="{{ url('public_profile') }}/{{ get_single_value('users', 'unique_id', $me_favorite->user_id) }}" class="name" target="_blank">
                                                                {{ get_single_value('users', 'username', $me_favorite->user_id) }}
                                                                <div class="isvarify">
                                                                    <i class="fas fa-check-circle"></i>
                                                                </div>
                                                            </a>

                                                            <p class="date">
                                                                {{ get_single_value('users', 'iam', $me_favorite->user_id) }}
                                                            </p>
                                                            <a href="javascript:void(0)" class="connnect-btn" title="Chat">Chat</a>
                                                        </div>
                                                    </div>
                                                    @endforeach
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