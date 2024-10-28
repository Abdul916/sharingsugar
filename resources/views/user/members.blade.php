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

            <div class="modal-body product-category">
                <form id="search-form" action="members" method="GET">
                    <div class="join-now-box">
                        <label class="title">Interested In</label>
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
                        <div class="single-option mt-3">
                            <div class="option" style="width: 100% !important;">
                                <div class="row" style="width: 100% !important;">
                                    <div class="col-md-4">
                                        <input type="checkbox" name="Age" id="toggle_age_slider" value="Age" {{isset($parameters['Age']) ? 'checked' : ''}}><label for="toggle_age_slider">Age</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="age-range-slider mt-3">
                                            <div id="age-slider"></div>
                                            <input type="hidden" value="{{isset($parameters['age']) ? $parameters['minAge'] : '18'}}" id="ageSlider1" name="minAge" disabled>
                                            <input type="hidden" value="{{isset($parameters['age']) ? $parameters['maxAge'] : '50'}}" id="ageSlider2" name="maxAge" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-option mt-3">
                            <div class="option" style="width: 100% !important;">
                                <div class="row" style="width: 100% !important;">
                                    <div class="col-md-4">
                                        <input type="checkbox" name="Height" id="toggle_height_slider" value="Height" {{isset($parameters['Height']) ? 'checked' : ''}}><label for="toggle_height_slider">Height</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="height-range-slider  mt-3">
                                            <div id="height-slider"></div>
                                            <input type="hidden" value="{{isset($parameters['Height']) ? $parameters['minHeight'] : '25'}}" id="heightSlider1" name="minHeight" disabled>
                                            <input type="hidden" value="{{isset($parameters['Height']) ? $parameters['maxHeight'] : '180'}}" id="heightSlider2" name="maxHeight" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-option mt-3">
                            <div class="option" style="width: 100% !important;">
                                <div class="row" style="width: 100% !important;">
                                    <div class="col-md-4">
                                        <input type="checkbox" name="Weight" id="toggle_weight_slider" value="Weight"><label for="toggle_weight_slider">Weight</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="weight-range-slider  mt-3">
                                            <div id="weight-slider"></div>
                                            <input type="hidden" value="{{isset($parameters['Weight']) ? $parameters['minWeight'] : '30'}}" id="weightSlider1" name="minWeight" disabled>
                                            <input type="hidden" value="{{isset($parameters['Weight']) ? $parameters['maxWeight'] : '150'}}" id="weightSlider2" name="maxWeight" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-option mt-3">
                            <div class="option" style="width: 100% !important;">
                                <div class="row" style="width: 100% !important;">
                                    <div class="col-md-4">
                                        <input type="checkbox" name="Children" id="toggle_child_slider" value="Children" {{isset($parameters['Children']) ? 'checked' : ''}}><label for="toggle_child_slider">Children</label>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="child-range-slider  mt-3">
                                            <div id="child-slider"></div>
                                            <input type="hidden" value="{{isset($parameters['Children']) ? $parameters['minChildren'] : '1'}}" id="childrenSlider1" name="minChildren" disabled>
                                            <input type="hidden" value="{{isset($parameters['Children']) ? $parameters['maxChildren'] : '9'}}" id="childrenSlider2" name="maxChildren" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="single-option mb-2">
                            <div class="option title">
                                <div class="mr-1">
                                    <input type="checkbox" onchange="showLocationSection(this)" name="locationsec" {{isset($parameters['locationsec']) ? 'checked' : ''}} id="locationsec" value="1"><label for="locationsec">Location</label>
                                </div>
                            </div>
                        </div>
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
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@include('user.map_init')
<script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/price-range.js') }}"></script>
<script>
    $(document).ready(function() {
        let isage_slider = localStorage.getItem('age_slider') === 'true';
        $('#toggle_age_slider').prop('checked', isage_slider);
        $('#ageSlider1').prop('disabled', false);
        $('#ageSlider2').prop('disabled', false);
        $('#age-slider').slider("option", "disabled", !isage_slider);

        let isheight_slider = localStorage.getItem('height_slider') === 'true';
        $('#toggle_height_slider').prop('checked', isheight_slider);
        $('#heightSlider1').prop('disabled', false);
        $('#heightSlider2').prop('disabled', false);
        $('#height-slider').slider("option", "disabled", !isheight_slider);

        let isweight_slider = localStorage.getItem('weight_slider') === 'true';
        $('#toggle_weight_slider').prop('checked', isweight_slider);
        $('#weightSlider1').prop('disabled', false);
        $('#weightSlider2').prop('disabled', false);
        $('#weight-slider').slider("option", "disabled", !isweight_slider);

        let ischild_slider = localStorage.getItem('child_slider') === 'true';
        $('#toggle_child_slider').prop('checked', ischild_slider);
        $('#childrenSlider1').prop('disabled', false);
        $('#childrenSlider2').prop('disabled', false);
        $('#child-slider').slider("option", "disabled", !ischild_slider);
    });
    $('#toggle_age_slider').change(function() {
        let isChecked = $(this).is(':checked');
        $('#age-slider').slider("option", "disabled", !isChecked);
        $('#ageSlider1').prop('disabled', !isChecked);
        $('#ageSlider2').prop('disabled', !isChecked);
        localStorage.setItem('age_slider', isChecked);
    });
    $('#toggle_height_slider').change(function() {
        let isChecked = $(this).is(':checked');
        $('#height-slider').slider("option", "disabled", !isChecked);
        $('#heightSlider1').prop('disabled', !isChecked);
        $('#heightSlider2').prop('disabled', !isChecked);
        localStorage.setItem('height_slider', isChecked);
    });
    $('#toggle_weight_slider').change(function() {
        let isChecked = $(this).is(':checked');
        $('#weight-slider').slider("option", "disabled", !isChecked);
        $('#weightSlider1').prop('disabled', !isChecked);
        $('#weightSlider2').prop('disabled', !isChecked);
        localStorage.setItem('weight_slider', isChecked);
    });
    $('#toggle_child_slider').change(function() {
        let isChecked = $(this).is(':checked');
        $('#child-slider').slider("option", "disabled", !isChecked);
        $('#childrenSlider1').prop('disabled', !isChecked);
        $('#childrenSlider2').prop('disabled', !isChecked);
        localStorage.setItem('child_slider', isChecked);
    });
    function showLocationSection(elm) {
        if (elm.checked) {
            $('#loc-check').prop('checked', true);
            $('#locationSection').removeClass('d-none');
        } else {
            $('#loc-check').prop('checked', false);
            $('#locationSection').addClass('d-none');
        }
    }

    $(document).ready(function() {
        var storedSearchParams = localStorage.getItem('searchParameters');
        if (storedSearchParams) {
            var formData = JSON.parse(storedSearchParams);
            formData.forEach(function(item) {
                var inputField = $('[name="' + item.name + '"]');
                if (item.name === 'age') {
                    inputField.prop('checked', true);
                }
                if (item.name === 'children') {
                    inputField.prop('checked', true);
                }
                if (item.name === 'height') {
                    inputField.prop('checked', true);
                }
                if (item.name === 'weight') {
                    inputField.prop('checked', true);
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
                    if (item.name === 'searchByLocation') {
                        showLocationSection(inputField[0]);
                    }
                } else {
                    inputField.val(item.value);
                }
            });
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