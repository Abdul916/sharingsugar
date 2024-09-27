@extends('app')
@section('title', 'Members')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Members</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Members</li>
            </ul>
        </div>
    </div>
</section>

<section class="community-section inner-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="top-filter">
                    <div class="left">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter">
                            <i class="fas fa-sliders-h"></i>  Filter your search
                        </a>
                    </div>
                    <div class="right">
                        <span class="span">
                            Order By :
                        </span>
                        <div class="filter-right">
                            <select class="nice-select select-bar">
                                <option value="">Sort By</option>
                                <option value="">Sort By Last Login</option>
                                <option value="">Sort By Distance</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($users as $user)

            @php
            $liked = check_record_existing('user_configs', 'user_id', Auth::user()->id, 'config_user_id', $user->id, 'type', '2', '', '');
            $blocked = check_record_existing('user_configs', 'user_id', Auth::user()->id, 'config_user_id', $user->id, 'type', '3', '', '');
            @endphp
            <?php
            if($blocked){
                continue;
            } ?>

            <div class="col-lg-4 col-md-6">
                <div class="single-community-box">
                    <a href="{{ url('public_profile') }}/{{ $user->unique_id }}" class="title">
                        <div class="img">
                            @if(!empty($user->profile_image))
                            <img src="{{ asset('assets/app_images') }}/{{$user->profile_image}}" alt="" style="width: 360px; height: 225px;">
                            @else
                            <img src="{{ asset('assets/images/cummunity/img1.jpg') }}" alt="" style="width: 360px; height: 225px;">
                            @endif
                        </div>
                    </a>
                    <div class="content">
                        <p class="date">Last login: {{ time_elapsed_string($user->last_login) }}</p>
                        <a href="{{ url('public_profile') }}/{{ $user->unique_id }}" class="title">
                            {{ $user->username }}, {{ number_format($user->age, 0) }} <br>
                            {{ $user->first_name }} {{ $user->last_name }}
                        </a>
                    </div>

                    <div class="box-footer">
                        @if($liked)
                        <div class="right change_bg">
                            <a href="javascript:void(0)" class="btn_user_configs color_white" data-id="{{ $user->id }}" data-action="unlike"><i class="fas fa-thumbs-up"></i> Liked</a>
                        </div>
                        @else
                        <div class="right">
                            <a href="javascript:void(0)" class="btn_user_configs color_black" data-id="{{ $user->id }}" data-action="like"><i class="fas fa-thumbs-up"></i> Like</a>
                        </div>
                        @endif
                        <div class="right">
                            <a href="{{ url('chat') }}?q={{ $user->unique_id }}" target="_blank" class="color_black"><i class="fas fa-comments"></i> Chat</a>
                        </div>
                        <div class="right">
                            <a href="javascript:void(0)" class="btn_user_configs color_black" data-id="{{ $user->id }}" data-action="block"><i class="fas fa-ban"></i> Block</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="pagination-area text-center">
                    <a href="#"><i class="fas fa-angle-double-left"></i><span></span></a>
                    <a href="#">1</a>
                    <a href="#">2</a>
                    <a href="#" class="active">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#"><i class="fas fa-angle-double-right"></i></a>
                </div>
            </div>
        </div> --}}
    </div>
</section>


<div class="modal fade filter-p" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h6 class="modal-title" id="exampleModalCenterTitle">Filter your search</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="join-now-box">
                    <div class="single-option">
                        <p class="title">
                            I am a :
                        </p>
                        <div class="option">
                            <div class="s-input mr-3">
                                <input type="radio" name="gender" id="male"><label for="male">Male</label>
                            </div>
                            <div class="s-input">
                                <input type="radio" name="gender" id="female"><label for="female">Female</label>
                            </div>
                        </div>
                    </div>
                    <div class="single-option gender">
                        <p class="title">
                            Seeking a :
                        </p>
                        <div class="option">
                            <div class="s-input mr-4">
                                <input type="radio" name="seeking" id="males"><label for="males">Man</label>
                            </div>
                            <div class="s-input">
                                <input type="radio" name="seeking" id="females"><label for="females">Woman</label>
                            </div>
                        </div>
                    </div>
                    <div class="single-option age">
                        <p class="title">
                            Ages :
                        </p>
                        <div class="option">
                            <div class="s-input mr-3">
                                <select class="select-bar">
                                    <option value="">18</option>
                                    <option value="">20</option>
                                    <option value="">24</option>
                                </select>
                            </div>
                            <div class="separator">
                                -
                            </div>
                            <div class="s-input ml-3">
                                <select class="select-bar">
                                    <option value="">30</option>
                                    <option value="">35</option>
                                    <option value="">40</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="single-option last">
                        <p class="title">
                            Country :
                        </p>
                        <div class="option">
                            <div class="s-input mr-3">
                                <select class="select-bar">
                                    <option >Select Country</option>
                                    <option value="">India</option>
                                    <option value="">Japan</option>
                                    <option value="">England</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="joun-button">
                        <button class="custom-button">Join Now!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
</script>
@endpush