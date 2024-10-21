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
                        {{-- <a href="{{ url('public_profile') }}/{{$user->unique_id}}" class="accept">View Profile</a> --}}
                        @if(!is_profile_approval_pending($user->id))
                        <a href="{{ url('edit_profile') }}" class="accept">Edit Profile</a>
                        @endif
                    </div>
                </div>
                @if(is_profile_approval_pending($user->id))
                <div class="alert alert-warning mt-4" role="alert">
                    <span>Your recent profile update is under review. Your profile changes would be propagated once it is approved by the admin.</span>
                </div>
                @endif
                
                @if(is_profile_approval_declined($user->id) == true)
                <div class="alert alert-danger mt-4" role="alert">
                    <span>Your recent profile update is declined by the admin. Please, update your profile again.</span>
                </div>
                @endif
                <div class="row">
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
                @if($user->profile_status == 2)
                <div class="input-info-box">
                    <div class="header">About your Profile</div>
                    <div class="content">
                        <div class="row">
                            <label class="theme_label col-sm-2 col-form-label">Name</label>
                            <span class="col-sm-4 col-form-label">
                                {{ $user->first_name }} {{ $user->last_name}}
                            </span>
                            <label class="theme_label col-sm-2 col-form-label">DOB</label>
                            <span class="col-sm-4 col-form-label">
                                {{ $user->dob }}
                            </span>
                        </div>
                        <div class="row">
                            <label class="theme_label col-sm-2 col-form-label">Username</label>
                            <span class="col-sm-4 col-form-label">
                                {{ $user->username }}
                            </span>
                            <label class="theme_label col-sm-2 col-form-label">Email</label>
                            <span class="col-sm-4 col-form-label">
                                {{ $user->email }}
                            </span>
                        </div>
                        <div class="row">
                            <label class="theme_label col-sm-2 col-form-label">Height (cm)</label>
                            <span class="col-sm-4 col-form-label">
                                {{ $user->height }}
                            </span>
                            <label class="theme_label col-sm-2 col-form-label">Weight (kg)</label>
                            <span class="col-sm-4 col-form-label">
                                {{ $user->weight }}
                            </span>
                        </div>
                        <div class="row">
                            <label class="theme_label col-sm-2 col-form-label">Gender</label>
                            <span class="col-sm-4 col-form-label">
                                @if($user->gender == 1)
                                Male
                                @elseif($user->gender == 2)
                                Female
                                @else
                                Trans
                                @endif
                            </span>
                            <label class="theme_label col-sm-2 col-form-label">Marital (s)</label>
                            <span class="col-sm-4 col-form-label">
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
                        </div>
                        <div class="row">
                            <label class="theme_label col-sm-2 col-form-label">Body Type</label>
                            <span class="col-sm-4 col-form-label">
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
                            <label class="theme_label col-sm-2 col-form-label">Children</label>
                            <span class="col-sm-4 col-form-label">
                                {{ $user->child }}
                            </span>
                        </div>
                        <div class="row">
                            <label class="theme_label col-sm-2 col-form-label">City</label>
                            <span class="col-sm-4 col-form-label">
                                {{ $user->city }}
                            </span>
                            <label class="theme_label col-sm-2 col-form-label">State</label>
                            <span class="col-sm-4 col-form-label">
                                {{ $user->state }}
                            </span>
                        </div>
                        <div class="row">
                            <label class="theme_label col-sm-2 col-form-label">Country</label>
                            <span class="col-sm-4 col-form-label">
                                {{ $user->country }}
                            </span>
                            <label class="theme_label col-sm-2 col-form-label">Zipcode</label>
                            <span class="col-sm-4 col-form-label">
                                {{ $user->zipcode }}
                            </span>
                        </div>
                        <div class="row">
                            <label class="theme_label col-sm-2 col-form-label">Address</label>
                            <span class="col-sm-10 col-form-label">
                                {{ $user->address }}
                            </span>
                        </div>
                        <div class="row">
                            <label class="theme_label col-sm-2 col-form-label">What kind of arrangement am I looking for?</label>
                            <span class="col-sm-10 col-form-label">
                                {{ $user->about_me }}
                            </span>
                        </div>
                        <div class="row">
                            <label class="theme_label col-sm-2 col-form-label">I am Adult (18+)</label>
                            <span class="col-sm-10 col-form-label">Yes</span>
                        </div>
                    </div>
                </div>
                @else
                <div class="alert alert-primary mt-4" role="alert">
                    <span>Please, update your profile first. <a href="{{ url('edit_profile') }}">Go to Update Profile</a></span>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    $(document).on("change" , "#upload_image" , function() {
        var formData =  new FormData($("#upload_profile_image")[0]);
        $.ajax({
            url:"{{ url('upload_profile_image') }}",
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
                        location.reload(true);
                    }, 2000);
                } else if(status.msg == 'error') {
                    toastr.error(status.response,"Error");
                } else if(status.msg == 'lvl_error') {
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