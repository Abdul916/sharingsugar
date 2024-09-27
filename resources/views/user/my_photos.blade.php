@extends('app')
@section('title', 'My Photos')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">My Photos</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>My Photos</li>
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
                    My Photos
                    <div class="right">
                        <a href="{{ url('profile') }}" class="accept">Go to Profile</a>
                    </div>
                </div>
                <div class="input-info-box mt-30">
                    <div class="content">
                        <section class="product-details-section tabs_section">
                            <div class="overlay">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item text-center">
                                                <a class="nav-link active" data-toggle="tab" href="#frist">
                                                    <i class="fas fa-eye"></i>
                                                    Public Photos
                                                </a>
                                            </li>
                                            <li class="nav-item text-center">
                                                <a class="nav-link" data-toggle="tab" href="#second">
                                                    <i class="fas fa-eye-slash"></i>
                                                    Private Photos
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active frist" id="frist">
                                                <div class="tab-content-wrapper">
                                                    <h4 class="title mt-30">Public Photos:</h4>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <form id="public_photos_form" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                                <input type="hidden" name="type" value="1">
                                                                <div class="up-photo-card mb-30 upload_div" onclick="document.getElementById('upload_public_photos').click();">
                                                                    <input type="file" style="display:none;" id="upload_public_photos" name="my_photos[]" accept="image/*" multiple>
                                                                    <div class="icon">
                                                                        <i class="fas fa-user"></i>
                                                                    </div>
                                                                    <div class="content">
                                                                        <h4>Upload Photos</h4>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        @php($i = 1)
                                                        @foreach(get_photos('user_photos', Auth::user()->id, '1', array('1, 2')) as $public)
                                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                                            <div class="my-col">
                                                                <div class="img">
                                                                    <img src="{{ asset('assets/app_images/user_photos') }}/{{$public->photo}}" alt="" class="fixed_image">
                                                                    <a href="javascript:void(0)" class="t_icon btn_delete_photos" data-id="{{ $public->id }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="second">
                                                <div class="tab-content-wrapper-second">
                                                    <h4 class="title mt-30">Private Photos:</h4> No one can see without your premission.
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <form id="private_photos_form" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                                <input type="hidden" name="type" value="2">
                                                                <div class="up-photo-card mb-30 upload_div" onclick="document.getElementById('upload_private_photos').click();">
                                                                    <input type="file" style="display:none;" id="upload_private_photos" name="my_photos[]" accept="image/*" multiple>
                                                                    <div class="icon">
                                                                        <i class="fas fa-user"></i>
                                                                    </div>
                                                                    <div class="content">
                                                                        <h4>Upload Photos</h4>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        @php($i = 1)
                                                        @foreach(get_photos('user_photos', Auth::user()->id, '2', array('1, 2')) as $private)
                                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                                            <div class="my-col">
                                                                <div class="img">
                                                                    <img src="{{ asset('assets/app_images/user_photos') }}/{{$private->photo}}" alt=""  class="fixed_image">
                                                                    <a href="javascript:void(0)" class="t_icon btn_delete_photos" data-id="{{ $private->id }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
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
    $(document).on("change" , "#upload_public_photos" , function() {
        var formData =  new FormData($("#public_photos_form")[0]);
        $.ajax({
            url:'{{ url('upload_photos') }}',
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
    $(document).on("change" , "#upload_private_photos" , function() {
        var formData =  new FormData($("#private_photos_form")[0]);
        $.ajax({
            url:'{{ url('upload_photos') }}',
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