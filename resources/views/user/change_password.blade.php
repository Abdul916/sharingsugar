@extends('app')
@section('title', 'Update Password')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Update Password</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Update Password</li>
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
                    Change Password
                    <div class="right">
                        <a href="{{ url('profile') }}" class="accept">Go to Profile</a>
                    </div>
                </div>
                <div class="input-info-box mt-30">
                    <form id="update_form" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="content">
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="my-input-box">
                                        <label for="">Confirm your Current Password</label>
                                        <input type="password" name="old_password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-input-box">
                                        <label for="">New Password</label>
                                        <input type="password" name="new_password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="my-input-box">
                                        <label for="">Confirm New Password</label>
                                        <input type="password" name="confirm_password">
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
            url:'{{ url('update_password') }}',
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
                        location.reload(true);
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