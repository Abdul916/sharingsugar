@extends('app')
@section('title', 'Profile')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Profile</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Profile</li>
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
                    Profile
                    <div class="right">
                        <a type="button" id="change_role_btn" class="accept">Change Role</a>
                        <form action="{{url('change_role')}}" id="changeRoleForm" method="POST">
                            @csrf
                        </form>
                        {{-- <a href="{{ url('profile') }}" class="accept">Back to Profile</a> --}}
                    </div>
                </div>

                <div class="row" style="display: none;">
                    <div class="col-lg-6">
                        <form id="upload_profile_image" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="up-photo-card mb-30 upload_div" onclick="document.getElementById('upload_image').click();">
                                <input type="file" style="display:none;" id="upload_image" name="profile_pic" accept="image/*">
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="content">
                                    <h4>Change Avatar</h4>
                                    <span>120x120p size minimum</span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form id="upload_cover_image" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="up-photo-card upload_div">
                                <div class="icon">
                                    <i class="fas fa-image"></i>
                                </div>
                                <div class="content">
                                    <h4>Change Cover</h4>
                                    <span>1200x300p size minimum</span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="up-photo-card mb-30">
                            <div class="icon"><i class="fas fa-male"></i></div>
                            <div class="content">
                                <h4>I Am a</h4>
                                <span style="color: #d72993">{{ $user->iam}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="up-photo-card">
                            <div class="icon"><i class="fas fa-female"></i></div>
                            <div class="content">
                                <h4>Interested in</h4>
                                <span style="color: #d72993">{{ $user->interestedin}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-info-box">
                    <div class="header">About your Profile</div>
                    <form id="update_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="content">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="my-input-box">
                                        <label for="">First Name</label>
                                        <input type="text" value="{{$user->first_name}}" name="first_name" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-input-box">
                                        <label for="">Last Name</label>
                                        <input type="text" value="{{$user->last_name}}" name="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-input-box">
                                        <label for="">Username</label>
                                        <input type="text" value="{{$user->username}}" name="username" id="username" placeholder="Userame">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-input-box">
                                        <label for="">Email</label>
                                        <input type="text" value="{{$user->email}}" name="email" placeholder="Email" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-input-box">
                                        <label for="">Birthday</label>
                                        <input type="date" value="{{$user->dob}}" name="dob">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-input-box">
                                        <label for="">Gender</label>
                                        <select name="gender" id="wrap_gender">
                                            <option value="2" @if($user->gender == 1) selected @endif>Female</option>
                                            <option value="1" @if($user->gender == 2) selected @endif>Male</option>
                                            <option value="3" @if($user->gender == 3) selected @endif>Trams</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="my-input-box">
                                        <label for="">Height (cm)</label>
                                        <input type="number" name="height" value="{{$user->height}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="my-input-box">
                                        <label for="">Weight (kg)</label>
                                        <input type="number" name="weight" value="{{$user->weight}}">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="my-input-box">
                                        <label for="">Marital Status</label>
                                        <select name="marital_status" id="wrap_marital_status">
                                            <option value="1" @if($user->marital_status == 1) selected @endif>Single</option>
                                            <option value="2" @if($user->marital_status == 2) selected @endif>Married</option>
                                            {{-- <option value="3" @if($user->marital_status == 3) selected @endif>Widowed</option> --}}
                                            <option value="4" @if($user->marital_status == 4) selected @endif>Divorced</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="my-input-box">
                                        <label for="">No of Children</label>
                                        <input type="number" value="{{$user->child}}" name="child" value="0">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="my-input-box">
                                        <label for="">Body Type</label>
                                        <select name="body_type" id="wrap_body_type">
                                            <option value="1" @if($user->body_type == 1) selected @endif>Skinny</option>
                                            <option value="2" @if($user->body_type == 2) selected @endif>Thin</option>
                                            <option value="3" @if($user->body_type == 3) selected @endif>Median</option>
                                            <option value="4" @if($user->body_type == 4) selected @endif>Athletic</option>
                                            <option value="5" @if($user->body_type == 5) selected @endif>Curvilinear</option>
                                            <option value="6" @if($user->body_type == 6) selected @endif>Full Height</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="my-input-box">
                                        <label for="">State</label>
                                        <input type="text" value="{{$user->state}}" name="state">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="my-input-box">
                                        <label for="">Zip Code</label>
                                        <input type="number" value="{{$user->zipcode}}" name="zip_code">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-input-box">
                                        <label for="">Country</label>
                                        <input type="text" value="{{$user->country}}" name="country">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-input-box">
                                        <label for="">City</label>
                                        <input type="text" value="{{$user->city}}" name="city">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="my-input-box">
                                        <label for="">Address</label>
                                        <input type="text" value="{{$user->address}}" id="address" name="address">

                                        <input type="hidden" value="{{$user->latitude}}" id="latitude" name="latitude">
                                        <input type="hidden" value="{{$user->longitude}}" id="longitude" name="longitude">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="my-input-box">
                                        <label for="">What kind of arrangement am I looking for?</label>
                                        <textarea name="about_me" placeholder="What kind of arrangement am I looking for?">{{$user->about_me}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="my-input-box">
                                        <label for="">I am Adult (18+)</label>
                                        <input type="checkbox" class="form-check-input form_check_input" id="eighteen_plus" checked disabled style="height: 34px !important;">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="buttons">
                                        <button type="button" class="custom-button btn_update">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script>
    $('#username').on('input', function() {
        $(this).val($(this).val().replace(/\s+/g, ''));
    });

    $(document).on("click", ".btn_update", function() {
        // 
        $(".btn_update").text('Please wait...');
        $(".btn_update").prop('disabled', 'true');
        var formData = new FormData($("#update_form")[0]);
        console.log(formData);
        $.ajax({
            url: '{{ url("update_profile") }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(status) {
                if (status.msg == 'success') {
                    $('.btn_update').prop("disabled", false);
                    $(".btn_update").text('Save Changes');
                    toastr.success(status.response, "Success");
                    setTimeout(function() {
                        window.location.href = '{{ url("profile") }}';
                    }, 1000);
                    console.log("success");
                } else if (status.msg == 'error') {
                    // $(".btn_update").prop('disabled', false);
                    // $(".btn_update").text('Save Changes');
                    // toastr.error(status.response, "Error");
                    console.log("error from server");
                } else if (status.msg == 'lvl_error') {
                    // $(".btn_update").prop('disabled', false);
                    // $(".btn_update").text('Save Changes');
                    // var message = "";
                    // $.each(status.response, function(key, value) {
                    //     message += value + "<br>";
                    // });
                    // toastr.error(message, "Error");
                    console.log("error from validation");
                }
            }
        });
    });
</script>
<script>
    function initMap() {
        const input = document.getElementById('address');
        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setFields(['geometry', 'formatted_address', 'address_components']);

        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }
            const address = place.formatted_address;
            const latitude = place.geometry.location.lat();
            const longitude = place.geometry.location.lng();
            document.getElementById('address').value = address;
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;

        });
    }

    function getAddressComponent(place, type) {
        for (const component of place.address_components) {
            if (component.types.includes(type)) {
                return component.long_name;
            }
        }
        return '';
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBy2l4KGGTm4cTqoSl6h8UAOAob87sHBsA&libraries=places&callback=initMap" async defer></script>
<script>
    $('#change_role_btn').click(function() {
        $('#change_role_btn').prop('disabled', true);
        var formData = new FormData($("#changeRoleForm")[0]);
        $.ajax({
            url: '{{ url("change_role") }}',
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(status) {
                if (status.msg == 'success') {
                    $('#change_role_btn').prop("disabled", false);
                    toastr.success(status.response, "Success");
                    setTimeout(function() {
                        window.location.href = '{{ url("profile") }}';
                    }, 1000);
                    console.log("success");
                } else if (status.msg == 'error') {
                    toastr.error(status.response, "Error");
                    // enable the button
                    $('#change_role_btn').prop('disabled', false);
                } else if (status.msg == 'lvl_error') {
                    toastr.error(status.response, "Error");
                    
                    $('#change_role_btn').prop('disabled', false);
                }
            }
        });
    });
</script>
@endpush