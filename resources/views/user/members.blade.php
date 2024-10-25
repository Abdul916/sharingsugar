@extends('app')
@section('title', 'Members')
@section('content')
<script>
    function OnlyPhotosGet(e) {
        if (e.checked) {
            $('#check_only_photos').prop('checked', true);
        } else {
            $('#check_only_photos').prop('checked', false);
        }
        $('#search-form').submit();
    }
    function NameSearchGet(e) {
        $('#search_name').val($('#name_search').val());
        $('#search-form').submit();
    }
</script>
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
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-sliders-h"></i> Filter your search
                        </a>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#mapModal">
                            <i class="fas fa-map-marker"></i> Map
                        </a>
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="only_photos" class="form-label"><input type="checkbox" class="form-control" {{isset($parameters['only_photos']) ? 'checked' : ''}} onchange="OnlyPhotosGet(this)" name="only_photos" id="only_photos" value="1" style="display: inline-block; width: 14px; height: 14px; color: #5650ce; z-index: -9; text-align: center;"> Only Photos</label>
                        </div>
                    </div>
                    <div>
                        <div class="form-group d-flex">
                            <input type="text" name="name_search" class="form-control" id="name_search" value="{{isset($parameters['name']) ? $parameters['name'] : ''}}" placeholder="Search by name" onkeypress="if(event.key === 'Enter') { NameSearchGet(this); }">
                            <button type="button" onclick="NameSearchGet(this)" class="namebtn"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="right">
                        {{-- <span class="span">Sort By :</span> --}}
                        <div class="filter-right">
                            <select name="sorting" onchange="$('#sorter').val(this.value); $('#search-form').submit();" class="nice-select select-bar">
                                <option value="" selected>Sort By</option>
                                <option value="last_login" {{isset($parameters['sorting']) ? ($parameters['sorting'] == 'last_login' ? 'selected' : '') : ''}}>Sort By Last Login</option>
                                <option value="distance" {{isset($parameters['sorting']) ? ($parameters['sorting'] == 'distance' ? 'selected' : '') : ''}}>Sort By Distance</option>
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
            <div class="col-lg-4 col-md-6">
                <div class="single-community-box">
                    <a href="{{ url('public_profile') }}/{{ $user->unique_id }}" class="title">
                        <div class="img">
                            @if(!empty($user->profile_image))
                            <img src="{{ asset('assets/app_images') }}/{{$user->profile_image}}" alt="" style="width: 360px; height: 225px;">
                            @else
                            <img src="{{ asset('assets/app_images/user.png') }}" alt="" style="width: 360px; height: 225px;">
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
        <div class="row">
            <div class="col-md-9">
                <p>Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries</p>
            </div>
            <div class="col-md-3 text-right">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</section>

<div class="modal fade filter-p" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h6 class="modal-title" id="exampleModalTitle">Filter your search</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="search-form" action="members" method="GET">
                    <div class="join-now-box">
                        <label class="title">Interested In</label>

                        <div class="price-range-slider">
                            <div id="slider"></div>
                        </div>

                        <div class="single-option">
                            <div class="option">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="radio" name="interestedin" id="Sugar Baby (Hombre / Man)" {{isset($parameters['interestedin']) && $parameters['interestedin'] === 'Sugar Baby (Hombre / Man)' ? 'checked' : ''}} value="Sugar Baby (Hombre / Man)"><label for="Sugar Baby (Hombre / Man)">Sugar Baby (Man)</label>
                                        <input type="radio" name="interestedin" id="Sugar Daddy" {{isset($parameters['interestedin']) && $parameters['interestedin'] === 'Sugar Daddy' ? 'checked' : ''}} value="Sugar Daddy"><label for="Sugar Daddy">Sugar Daddy</label>
                                        <input type="radio" name="interestedin" id="Sugar Baby (Trans)" {{isset($parameters['interestedin']) && $parameters['interestedin'] === 'Sugar Baby (Trans)' ? 'checked' : ''}} value="Sugar Baby (Trans)"><label for="Sugar Baby (Trans)">Sugar Baby (Trans)</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" name="interestedin" id="Sugar Baby (Mujer / Woman)" {{isset($parameters['interestedin']) && $parameters['interestedin'] === 'Sugar Baby (Mujer / Woman)' ? 'checked' : ''}} value="Sugar Baby (Mujer / Woman)"><label for="Sugar Baby (Mujer / Woman)">Sugar Baby (Woman)</label>
                                        <input type="radio" name="interestedin" id="Sugar Mommy" {{isset($parameters['interestedin']) && $parameters['interestedin'] === 'Sugar Mommy' ? 'checked' : ''}} value="Sugar Mommy"><label for="Sugar Mommy">Sugar Mommy</label>
                                        {{-- <input type="radio" name="interestedin" id="Sugar Daddy Mommy" {{isset($parameters['interestedin']) && $parameters['interestedin'] === 'Sugar Daddy Mommy' ? 'checked' : ''}} value="Sugar Daddy Mommy"><label for="Sugar Daddy Mommy">Sugar Daddy Mommy</label> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="title mt-2">Body Type</label>
                        <div class="single-option">
                            <div class="option">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="checkbox" name="Skinny" id="Skinny" value="Skinny" {{isset($parameters['Skinny']) ? 'checked' : ''}}><label for="Skinny">Skinny</label>
                                        <input type="checkbox" name="Tiny" id="Tiny" value="Tiny" {{isset($parameters['Tiny']) ? 'checked' : ''}}><label for="Tiny">Tiny</label>
                                        <input type="checkbox" name="Median" id="Median" value="Median" {{isset($parameters['Median']) ? 'checked' : ''}}><label for="Median">Median</label>
                                        <input type="checkbox" name="Mascular" id="Mascular" value="Mascular" {{isset($parameters['Mascular']) ? 'checked' : ''}}><label for="Mascular">Mascular</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="checkbox" name="Athletic" id="Athletic" value="Athletic" {{isset($parameters['Athletic']) ? 'checked' : ''}}><label for="Athletic">Athletic</label>
                                        <input type="checkbox" name="Curvilinear" id="Curvilinear" value="Curvilinear" {{isset($parameters['Curvilinear']) ? 'checked' : ''}}><label for="Curvilinear">Curvilinear</label>
                                        <input type="checkbox" name="Full_Height" id="Full Height" value="Full Height" {{isset($parameters['Full_Height']) ? 'checked' : ''}}><label for="Full Height">Full Height</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- <label class="title mt-2">Age</label> --}}
                        <div class="single-option">
                            <div class="option">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="checkbox" class="mt-2" name="Age" id="Age" value="Age" onchange="showAgeSlider(this)" {{isset($parameters['Age']) ? 'checked' : ''}}><label for="Age">Age</label>
                                        <input type="checkbox" class="mt-2" name="Height" id="Height" onchange="showHeightSlider(this)" value="Height" {{isset($parameters['Height']) ? 'checked' : ''}}><label for="Height">Height</label>
                                        <input type="checkbox" class="mt-2" name="Weight" id="Weight" value="Weight" onchange="showWeightSlider(this)" {{isset($parameters['Weight']) ? 'checked' : ''}}><label for="Weight">Weight</label>
                                        <input type="checkbox" class="mt-2" name="Children" id="Children" value="Children" onchange="showChildSlider(this)" {{isset($parameters['Children']) ? 'checked' : ''}}><label for="Children">Children</label>
                                        <input type="checkbox" class="mt-2" name="locationsec" onchange="showLocationSection(this)" {{isset($parameters['locationsec']) ? 'checked' : ''}} id="locationsec" value="1"><label for="locationsec">Location</label>
                                    </div>
                                    <div class="col-md-8">



                                        <div class="" id="ageSlider3">
                                            <div class="values">
                                                <span id="range1">
                                                    <span id="minAgeSpan">{{isset($parameters['Age']) ? $parameters['minAge'] : '18'}}</span>
                                                </span>
                                                <span> &dash; </span>
                                                <span id="range2">
                                                    <span id="maxAgeSpan">{{isset($parameters['Age']) ? $parameters['maxAge'] : '40'}}</span>
                                                </span>
                                            </div>
                                            <div class="container1">
                                                <div class="slider-track"></div>
                                                <input type="range" class="xl_bordernone" min="18" max="100" value="{{isset($parameters['age']) ? $parameters['minAge'] : '18'}}" id="slider-1" name="minAge" oninput="slideOne()" disabled>
                                                <input type="range" class="xl_bordernone" min="18" max="100" value="{{isset($parameters['age']) ? $parameters['maxAge'] : '40'}}" id="slider-2" name="maxAge" oninput="slideTwo()" disabled>
                                            </div>
                                        </div>

                                        <div class="height" id="heightSlider3">
                                            <div class="values">
                                                <span id="heightRange1">
                                                    <span id="minHeightSpan">{{isset($parameters['Height']) ? $parameters['minHeight'] : '120'}}</span>

                                                </span>
                                                <span> &dash; </span>
                                                <span id="heightRange2">
                                                    <span id="maxHeightSpan">{{isset($parameters['Height']) ? $parameters['maxHeight'] : '150'}}</span>

                                                </span>
                                            </div>
                                            <div class="container1">
                                                <div class="slider-track height-slider-track"></div>
                                                <input type="range" class="xl_bordernone" min="100" max="200" value="{{isset($parameters['Height']) ? $parameters['minHeight'] : '120'}}" id="heightSlider1" name="minHeight" oninput="slideHeightOne()">
                                                <input type="range" class="xl_bordernone" min="100" max="200" value="{{isset($parameters['Height']) ? $parameters['maxHeight'] : '150'}}" id="heightSlider2" name="maxHeight" oninput="slideHeightTwo()">
                                            </div>
                                        </div>
                                        <div class="" id="weightSlider3">
                                            <div class="values">
                                                <span id="weightRange1">
                                                    <span id="minWeightSpan">{{isset($parameters['Weight']) ? $parameters['minWeight'] : '55'}}</span>

                                                </span>
                                                <span> &dash; </span>
                                                <span id="weightRange2">
                                                    <span id="maxWeightSpan">{{isset($parameters['Weight']) ? $parameters['maxWeight'] : '85'}}</span>

                                                </span>
                                            </div>
                                            <div class="container1">
                                                <div class="slider-track weight-slider-track"></div>
                                                <input type="range" class="xl_bordernone" min="40" max="150" value="{{isset($parameters['Weight']) ? $parameters['minWeight'] : '120'}}" id="weightSlider1" name="minWeight" oninput="slideWeightOne()">
                                                <input type="range" class="xl_bordernone" min="40" max="150" value="{{isset($parameters['Weight']) ? $parameters['maxWeight'] : '150'}}" id="weightSlider2" name="maxWeight" oninput="slideWeightTwo()">
                                            </div>
                                        </div>

                                        <div class="children" id="childSlider3">
                                            <div class="values">
                                                <span id="childrenRange1">
                                                    <span id="minChildrenSpan">{{isset($parameters['Children']) ? $parameters['minChildren'] : '0'}}</span>
                                                </span>
                                                <span> &dash; </span>
                                                <span id="childrenRange2">
                                                    <span id="maxChildrenSpan">{{isset($parameters['Children']) ? $parameters['maxChildren'] : '9'}}</span>
                                                </span>
                                            </div>
                                            <div class="container1">
                                                <div class="slider-track children-slider-track"></div>
                                                <input type="range" class="xl_bordernone" min="0" max="9" value="{{isset($parameters['Children']) ? $parameters['minChildren'] : '1'}}" id="childrenSlider1" name="minChildren" oninput="slideChildrenOne()">
                                                <input type="range" class="xl_bordernone" min="0" max="9" value="{{isset($parameters['Children']) ? $parameters['maxChildren'] : '9'}}" id="childrenSlider2" name="maxChildren" oninput="slideChildrenTwo()">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>



                        {{-- <style>
                            .xlcustomsize {
                                display: inline-block;
                                width: 14px;
                                height: 14px;
                                color: #5650ce;
                                z-index: -9;
                                text-align: center;
                            }
                        </style>

                        <div class="row">
                            <div class="col-md-4">
                                <input type="checkbox" class="xlcustomsize" name="Age" id="Age" value="Age" onchange="showAgeSlider(this)" {{isset($parameters['Age']) ? 'checked' : ''}}><label for="Age"> Age </label>
                            </div>
                            <div class="col-md-8">
                                <div class="" id="ageSlider">
                                    <div class="wrapper">
                                        <div class="values">
                                            <span id="range1">
                                                <span id="minAgeSpan">{{isset($parameters['Age']) ? $parameters['minAge'] : '18'}}</span>

                                            </span>
                                            <span> &dash; </span>
                                            <span id="range2">
                                                <span id="maxAgeSpan">{{isset($parameters['Age']) ? $parameters['maxAge'] : '40'}}</span>

                                            </span>
                                        </div>
                                        <div class="container1">
                                            <div class="slider-track"></div>
                                            <input type="range" class="xl_bordernone" min="18" max="100" value="{{isset($parameters['age']) ? $parameters['minAge'] : '18'}}" id="slider-1" name="minAge" oninput="slideOne()">
                                            <input type="range" class="xl_bordernone" min="18" max="100" value="{{isset($parameters['age']) ? $parameters['maxAge'] : '40'}}" id="slider-2" name="maxAge" oninput="slideTwo()">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="single-option"> --}}
                            {{-- <div class="option"> --}}
                                {{-- <div class="row">
                                    <div class="col-md-6">
                                        <span>
                                            <input type="checkbox" name="Age" id="Age" value="Age" onchange="showAgeSlider(this)" {{isset($parameters['Age']) ? 'checked' : ''}}><label for="Age">Age</label>
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <div>
                                            <div class="wrapper">
                                                <div class="values">
                                                    <span id="range1">
                                                        <span id="minAgeSpan">{{isset($parameters['Age']) ? $parameters['minAge'] : '18'}}</span>

                                                    </span>
                                                    <span> &dash; </span>
                                                    <span id="range2">
                                                        <span id="maxAgeSpan">{{isset($parameters['Age']) ? $parameters['maxAge'] : '40'}}</span>

                                                    </span>
                                                </div>
                                                <div class="container1">
                                                    <div class="slider-track"></div>
                                                    <input type="range" class="xl_bordernone" min="18" max="100" value="{{isset($parameters['age']) ? $parameters['minAge'] : '18'}}" id="slider-1" name="minAge" oninput="slideOne()">
                                                    <input type="range" class="xl_bordernone" min="18" max="100" value="{{isset($parameters['age']) ? $parameters['maxAge'] : '40'}}" id="slider-2" name="maxAge" oninput="slideTwo()">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            {{-- </div> --}}
                        {{-- </div> --}}

                        {{-- <div class="single-option">
                            <div class="option">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="checkbox" name="Age" id="Age" value="Age" onchange="showAgeSlider(this)" {{isset($parameters['Age']) ? 'checked' : ''}}><label for="Age">Age</label>
                                    </div>
                                    <div class="col-md-6">

                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="{{isset($parameters['Age']) ? 'd-block' : 'd-none'}} age" id="ageSlider">
                            <div class="wrapper">
                                <div class="values">
                                    <span id="range1">
                                        <span id="minAgeSpan">{{isset($parameters['Age']) ? $parameters['minAge'] : '18'}}</span>

                                    </span>
                                    <span> &dash; </span>
                                    <span id="range2">
                                        <span id="maxAgeSpan">{{isset($parameters['Age']) ? $parameters['maxAge'] : '40'}}</span>

                                    </span>
                                </div>
                                <div class="container1">
                                    <div class="slider-track"></div>
                                    <input type="range" class="xl_bordernone" min="18" max="100" value="{{isset($parameters['age']) ? $parameters['minAge'] : '18'}}" id="slider-1" name="minAge" oninput="slideOne()">
                                    <input type="range" class="xl_bordernone" min="18" max="100" value="{{isset($parameters['age']) ? $parameters['maxAge'] : '40'}}" id="slider-2" name="maxAge" oninput="slideTwo()">
                                </div>
                            </div>
                        </div> --}}

                        {{-- <div class="single-option mb-2">
                            <div class="option title">
                                <div class="mr-1">
                                    <input type="checkbox" name="Height" id="Height" onchange="showHeightSlider(this)" value="Height" {{isset($parameters['Height']) ? 'checked' : ''}}><label for="Height">Height</label>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="height {{isset($parameters['Height']) ? 'd-block' : 'd-none'}}" id="heightSlider">
                            <div class="wrapper">
                                <div class="values">
                                    <span id="heightRange1">
                                        <span id="minHeightSpan">{{isset($parameters['Height']) ? $parameters['minHeight'] : '120'}}</span>

                                    </span>
                                    <span> &dash; </span>
                                    <span id="heightRange2">
                                        <span id="maxHeightSpan">{{isset($parameters['Height']) ? $parameters['maxHeight'] : '150'}}</span>

                                    </span>
                                </div>
                                <div class="container1">
                                    <div class="slider-track height-slider-track"></div>
                                    <input type="range" class="xl_bordernone" min="100" max="200" value="{{isset($parameters['Height']) ? $parameters['minHeight'] : '120'}}" id="heightSlider1" name="minHeight" oninput="slideHeightOne()">
                                    <input type="range" class="xl_bordernone" min="100" max="200" value="{{isset($parameters['Height']) ? $parameters['maxHeight'] : '150'}}" id="heightSlider2" name="maxHeight" oninput="slideHeightTwo()">
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="single-option mb-2">
                            <div class="option title">
                                <div class="mr-1">
                                    <input type="checkbox" name="Weight" id="Weight" value="Weight" onchange="showWeightSlider(this)" {{isset($parameters['Weight']) ? 'checked' : ''}}><label for="Weight">Weight</label>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="{{isset($parameters['Weight']) ? 'd-block' : 'd-none'}} weight" id="weightSlider">
                            <div class="wrapper">
                                <div class="values">
                                    <span id="weightRange1">
                                        <span id="minWeightSpan">{{isset($parameters['Weight']) ? $parameters['minWeight'] : '55'}}</span>

                                    </span>
                                    <span> &dash; </span>
                                    <span id="weightRange2">
                                        <span id="maxWeightSpan">{{isset($parameters['Weight']) ? $parameters['maxWeight'] : '85'}}</span>

                                    </span>
                                </div>
                                <div class="container1">
                                    <div class="slider-track weight-slider-track"></div>
                                    <input type="range" class="xl_bordernone" min="40" max="150" value="{{isset($parameters['Weight']) ? $parameters['minWeight'] : '120'}}" id="weightSlider1" name="minWeight" oninput="slideWeightOne()">
                                    <input type="range" class="xl_bordernone" min="40" max="150" value="{{isset($parameters['Weight']) ? $parameters['maxWeight'] : '150'}}" id="weightSlider2" name="maxWeight" oninput="slideWeightTwo()">
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="single-option mb-2">
                            <div class="option title">
                                <div class="mr-1">
                                    <input type="checkbox" name="Children" id="Children" value="Children" onchange="showChildSlider(this)" {{isset($parameters['Children']) ? 'checked' : ''}}><label for="Children">Children</label>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="children {{isset($parameters['Children']) ? 'd-block' : 'd-none'}}" id="childSlider">
                            <div class="wrapper">
                                <div class="values">
                                    <span id="childrenRange1">
                                        <span id="minChildrenSpan">{{isset($parameters['Children']) ? $parameters['minChildren'] : '0'}}</span>
                                    </span>
                                    <span> &dash; </span>
                                    <span id="childrenRange2">
                                        <span id="maxChildrenSpan">{{isset($parameters['Children']) ? $parameters['maxChildren'] : '9'}}</span>
                                    </span>
                                </div>
                                <div class="container1">
                                    <div class="slider-track children-slider-track"></div>
                                    <input type="range" class="xl_bordernone" min="0" max="9" value="{{isset($parameters['Children']) ? $parameters['minChildren'] : '1'}}" id="childrenSlider1" name="minChildren" oninput="slideChildrenOne()">
                                    <input type="range" class="xl_bordernone" min="0" max="9" value="{{isset($parameters['Children']) ? $parameters['maxChildren'] : '9'}}" id="childrenSlider2" name="maxChildren" oninput="slideChildrenTwo()">
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="single-option mb-2">
                            <div class="option title">
                                <div class="mr-1">
                                    <input type="checkbox" onchange="showLocationSection(this)" name="locationsec" {{isset($parameters['locationsec']) ? 'checked' : ''}} id="locationsec" value="1"><label for="locationsec">Location</label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="d-none">
                            <input type="text" name="name" id="search_name" value="{{isset($parameters['name']) ? $parameters['name'] : ''}}">
                            <input type="text" name="sorting" id="sorter" value="{{isset($parameters['sorting']) ? $parameters['sorting'] : 'last_login'}}">
                            <input type="checkbox" name="only_photos" {{isset($parameters['only_photos']) ? 'checked' : ''}} id="check_only_photos">
                        </div>
                        <div class="location">
                            <div class="wrapper">
                                <div class="row {{isset($parameters['locationsec']) ? 'd-block' : 'd-none'}}" id="locationSection">
                                    <div class="col-12 mt-2">
                                        <label for="form-label">Distance (KM)</label>
                                        <input type="number" class="form-control" onchange="checkLocation()" min="10" value="{{isset($parameters['locationsec']) ? $parameters['distance'] : '10'}}" name="distance" id="distance">
                                    </div>
                                    <div class="col-12 mt-2">
                                        <label for="form-label">Address</label>
                                        <textarea class="form-control" id="address" rows="1" name="address" onchange="checkLocation()">{{isset($parameters['locationsec']) ? $parameters['address'] : (Auth()->user()->address ?? '')}}</textarea>

                                    </div>
                                    <div class="col-12 mt-2">
                                        <label for="form-label">City</label>
                                        <input type="text" class="form-control" value="{{isset($parameters['locationsec']) ? $parameters['city'] : (Auth()->user()->city ?? '')}}" name="city" id="city">
                                    </div>
                                    <div class="col-12 mt-2">
                                        <label for="form-label">State</label>
                                        <input type="text" class="form-control" value="{{isset($parameters['locationsec']) ? $parameters['state'] : (Auth()->user()->state ?? '')}}" name="state" id="state">
                                    </div>
                                    <div class="col-12 mt-2">
                                        <label for="form-label">Country</label>
                                        <input type="text" class="form-control" value="{{isset($parameters['locationsec']) ? $parameters['country'] : (Auth()->user()->country ?? '')}}" name="country" id="country">
                                    </div>
                                    <div class="col-12 mt-2 d-none">
                                        <label for="form-label">Latitude</label>
                                        <input type="text" class="form-control" value="{{isset($parameters['locationsec']) ? $parameters['latitude'] : (Auth()->user()->latitude ?? '')}}" readonly name="latitude" id="latitude">
                                    </div>
                                    <div class="col-12 mt-2 d-none">
                                        <label for="form-label">Longitude</label>
                                        <input type="text" class="form-control" value="{{isset($parameters['locationsec']) ? $parameters['longitude'] : (Auth()->user()->longitude ?? '')}}" readonly name="longitude" id="longitude">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="joun-button mt-2">
                            <button type="submit" class="custom-button">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <div id="map" style="height: 50vh;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')

<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/price-range.js') }}"></script>

<script>
    function showHeightSlider(elm) {
        if (elm.checked) {
            $('#heightSlider').removeClass('d-none');
        } else {
            $('#heightSlider').addClass('d-none');
        }
    }

    function showAgeSlider(elm) {
        if (elm.checked) {
            $('#ageSlider').removeClass('d-none');
        } else {
            $('#ageSlider').addClass('d-none');
        }
    }

    function showWeightSlider(elm) {
        if (elm.checked) {
            $('#weightSlider').removeClass('d-none');
        } else {
            $('#weightSlider').addClass('d-none');
        }
    }

    function showChildSlider(elm) {
        if (elm.checked) {
            $('#childSlider').removeClass('d-none');
        } else {
            $('#childSlider').addClass('d-none');
        }
    }

    function showLocationSection(elm) {
        if (elm.checked) {
            $('#loc-check').prop('checked', true);
            $('#locationSection').removeClass('d-none');
        } else {
            $('#loc-check').prop('checked', false);
            $('#locationSection').addClass('d-none');
        }
    }
    window.onload = function() {
        fillColor();
        fillHeightColor();
        fillWeightColor();
        fillChildrenColor();
    }

    let sliderOne = document.getElementById("slider-1");
    let sliderTwo = document.getElementById("slider-2");
    let displayValOne = document.getElementById("range1");
    let displayValTwo = document.getElementById("range2");
    let sliderTrack = document.querySelector(".slider-track");
    let minGap = 0;

    // Function to update height slider values
    function slideOne() {
        if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
            sliderOne.value = parseInt(sliderTwo.value) - minGap;
        }
        displayValOne.textContent = sliderOne.value;
        fillColor();
    }

    function slideTwo() {

        if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
            sliderTwo.value = parseInt(sliderOne.value) + minGap;
        }
        displayValTwo.textContent = sliderTwo.value;
        fillColor();
    }

    function fillColor() {
        let minSliderValue = parseInt(sliderOne.min);
        let maxSliderValue = parseInt(sliderOne.max);

        let percent1 = ((sliderOne.value - minSliderValue) / (maxSliderValue - minSliderValue)) * 100;
        let percent2 = ((sliderTwo.value - minSliderValue) / (maxSliderValue - minSliderValue)) * 100;

        sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}%, #3264fe ${percent1}%, #3264fe ${percent2}%, #dadae5 ${percent2}%)`;
    }



    let heightSlider1 = document.getElementById("heightSlider1");
    let heightSlider2 = document.getElementById("heightSlider2");
    let heightDisplayValOne = document.getElementById("heightRange1");
    let heightDisplayValTwo = document.getElementById("heightRange2");
    let heightSliderTrack = document.querySelector(".height-slider-track");

    // Function to update height slider values

    function slideHeightOne() {
        // document.getElementById("height").checked = true;
        if (parseInt(heightSlider2.value) - parseInt(heightSlider1.value) <= minGap) {
            heightSlider1.value = parseInt(heightSlider2.value) - minGap;
        }
        heightDisplayValOne.textContent = heightSlider1.value;
        fillHeightColor();
    }

    function slideHeightTwo() {
        // document.getElementById("height").checked = true;
        if (parseInt(heightSlider2.value) - parseInt(heightSlider1.value) <= minGap) {
            heightSlider2.value = parseInt(heightSlider1.value) + minGap;
        }
        heightDisplayValTwo.textContent = heightSlider2.value;
        fillHeightColor();
    }

    function fillHeightColor() {
        let minSliderValue = parseInt(heightSlider1.min);
        let maxSliderValue = parseInt(heightSlider1.max);

        let percent1 = ((heightSlider1.value - minSliderValue) / (maxSliderValue - minSliderValue)) * 100;
        let percent2 = ((heightSlider2.value - minSliderValue) / (maxSliderValue - minSliderValue)) * 100;

        heightSliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}%, #3264fe ${percent1}%, #3264fe ${percent2}%, #dadae5 ${percent2}%)`;
    }
    let weightSlider1 = document.getElementById("weightSlider1");
    let weightSlider2 = document.getElementById("weightSlider2");
    let weightDisplayValOne = document.getElementById("weightRange1");
    let weightDisplayValTwo = document.getElementById("weightRange2");
    let weightSliderTrack = document.querySelector(".weight-slider-track");

    // Function to update weight slider values
    function slideWeightOne() {
        // document.getElementById("weight").checked = true;
        if (parseInt(weightSlider2.value) - parseInt(weightSlider1.value) <= minGap) {
            weightSlider1.value = parseInt(weightSlider2.value) - minGap;
        }
        weightDisplayValOne.textContent = weightSlider1.value;
        fillWeightColor();
    }

    function slideWeightTwo() {
        // document.getElementById("weight").checked = true;
        if (parseInt(weightSlider2.value) - parseInt(weightSlider1.value) <= minGap) {
            weightSlider2.value = parseInt(weightSlider1.value) + minGap;
        }
        weightDisplayValTwo.textContent = weightSlider2.value;
        fillWeightColor();
    }

    function fillWeightColor() {
        let minSliderValue = parseInt(weightSlider1.min);
        let maxSliderValue = parseInt(weightSlider1.max);

        let percent1 = ((weightSlider1.value - minSliderValue) / (maxSliderValue - minSliderValue)) * 100;
        let percent2 = ((weightSlider2.value - minSliderValue) / (maxSliderValue - minSliderValue)) * 100;

        weightSliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}%, #3264fe ${percent1}%, #3264fe ${percent2}%, #dadae5 ${percent2}%)`;
    }

    let childrenSlider1 = document.getElementById("childrenSlider1");
    let childrenSlider2 = document.getElementById("childrenSlider2");
    let childrenDisplayValOne = document.getElementById("childrenRange1");
    let childrenDisplayValTwo = document.getElementById("childrenRange2");
    let childrenSliderTrack = document.querySelector(".children-slider-track");

    // Function to update children slider values
    function slideChildrenOne() {
        // document.getElementById("children").checked = true;
        if (parseInt(childrenSlider2.value) - parseInt(childrenSlider1.value) <= minGap) {
            childrenSlider1.value = parseInt(childrenSlider2.value) - minGap;
        }
        childrenDisplayValOne.textContent = childrenSlider1.value;
        fillChildrenColor();
    }

    function slideChildrenTwo() {
        // document.getElementById("children").checked = true;
        if (parseInt(childrenSlider2.value) - parseInt(childrenSlider1.value) <= minGap) {
            childrenSlider2.value = parseInt(childrenSlider1.value) + minGap;
        }
        childrenDisplayValTwo.textContent = childrenSlider2.value;
        fillChildrenColor();
    }

    function fillChildrenColor() {
        let minSliderValue = parseInt(childrenSlider1.min);
        let maxSliderValue = parseInt(childrenSlider1.max);

        let percent1 = ((childrenSlider1.value - minSliderValue) / (maxSliderValue - minSliderValue)) * 100;
        let percent2 = ((childrenSlider2.value - minSliderValue) / (maxSliderValue - minSliderValue)) * 100;

        childrenSliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}%, #3264fe ${percent1}%, #3264fe ${percent2}%, #dadae5 ${percent2}%)`;
    }
</script>
<!-- Google places scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

@include('user.map_init')

<script>
    $(document).ready(function() {
        $("#resetBtn").click(function() {
            localStorage.clear();
            $('#search-form').trigger("reset");
            $('#ageSlider').addClass('d-none');
            $('#heightSlider').addClass('d-none');
            $('#weightSlider').addClass('d-none');
            $('#childSlider').addClass('d-none');
            $('#locationSection').addClass('d-none');
        });
        var storedSearchParams = localStorage.getItem('searchParameters');
        if (storedSearchParams) {
            var formData = JSON.parse(storedSearchParams);
            formData.forEach(function(item) {
                var inputField = $('[name="' + item.name + '"]');
                if (item.name === 'age') {
                    inputField.prop('checked', true);
                    showAgeSlider(inputField[0]);
                }
                if (item.name === 'children') {
                    inputField.prop('checked', true);
                    showChildSlider(inputField[0]);
                }
                if (item.name === 'height') {
                    inputField.prop('checked', true);
                    showHeightSlider(inputField[0]);
                }
                if (item.name === 'weight') {
                    inputField.prop('checked', true);
                    showWeightSlider(inputField[0]);
                }
                if (item.name === 'minChildren') {
                    $('#minChildrenSpan').text(item.value);
                }
                if (item.name === 'maxChildren') {
                    $('#maxChildrenSpan').text(item.value);
                }
                if (item.name === 'minHeight') {
                    $('#minHeightSpan').text(item.value);
                }
                if (item.name === 'maxHeight') {
                    $('#maxHeightSpan').text(item.value);
                }
                if (item.name === 'minWeight') {
                    $('#minWeightSpan').text(item.value);
                }
                if (item.name === 'maxWeight') {
                    $('#maxWeightSpan').text(item.value);
                }
                if (item.name === 'minAge') {
                    $('#minAgeSpan').text(item.value);
                }
                if (item.name === 'maxAge') {
                    $('#maxAgeSpan').text(item.value);
                }
                if (inputField.attr('type') === 'checkbox' || inputField.attr('type') === 'radio') {
                    inputField.prop('checked', true);
                    // If searchByLocation checkbox then show location section
                    if (item.name === 'searchByLocation') {
                        showLocationSection(inputField[0]);
                    }
                } else {
                    inputField.val(item.value);
                }
            });

            // Manually set the 'interestedin' radio button value
            var interestedinValue = formData.find(function(item) {
                return item.name === 'interestedin';
            });
            if (interestedinValue) {
                $('[name="interestedin"][value="' + interestedinValue.value + '"]').prop('checked', true);
            }

        }
        $('#formSubmitBtn').click(function(event) {
            var formData = $('#search-form').serializeArray();
            $('#search-form').submit();
        });
    });
</script>
@endpush