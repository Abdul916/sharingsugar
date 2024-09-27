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
                        {{-- <a href="{{ url('profile') }}" class="accept">Back to Profile</a> --}}
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-lg-12">
                        <div class="profile-about-box">
                            <div class="top-bg"></div>
                            <div class="p-inner-content">
                                <div class="profile-img">
                                    @if(!empty($user->profile_image))
                                    <img src="{{ asset('assets/app_images') }}/{{$user->profile_image}}" alt="" style="width: 120px;">
                                    @else
                                    <img src="{{ asset('assets/images/profile/profile-user.png') }}" alt="">
                                    @endif
                                    <div class="active-online"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="input-info-box mt-30">
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
                                        <input type="text" value="{{$user->username}}" name="username" placeholder="Userame">
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
                                        <input type="text" value="{{$user->address}}" name="address">
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
    $(document).on("click" , ".btn_update" , function() {
        $(".btn_update").text('Please wait...');
        $(".btn_update").prop('disabled', 'true');
        var formData =  new FormData($("#update_form")[0]);
        $.ajax({
            url:'{{ url('update_profile') }}',
            type: 'POST',
            data: formData,
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            success:function(status){
                if(status.msg=='success') {
                    $('.btn_update').prop("disabled", false);
                    $(".btn_update").text('Save Changes');
                    toastr.success(status.response,"Success");
                    setTimeout(function(){
                        window.location.href = '{{ url('profile') }}';
                    }, 2000);
                } else if(status.msg == 'error') {
                    $(".btn_update").prop('disabled', false);
                    $(".btn_update").text('Save Changes');
                    toastr.error(status.response,"Error");
                } else if(status.msg == 'lvl_error') {
                    $(".btn_update").prop('disabled', false);
                    $(".btn_update").text('Save Changes');
                    var message = "";
                    $.each(status.response, function (key, value) {
                        message += value+"<br>";
                    });
                    toastr.error(message, "Error");
                }
            }
        });
    });
</script>
@endpush