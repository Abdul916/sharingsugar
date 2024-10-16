@extends('app')
@section('title', 'Contact Us')
@section('content')
<section class="breadcrumb-area profile-bc-area">
    <div class="container">
        <div class="content">
            {{-- <h2 class="title extra-padding">Contact Us</h2> --}}
            <ul class="breadcrumb-list extra-padding">
                <li>
                    <a href="{{ url('home') }}">Home</a>
                </li>
                <li>Contact Us</li>
            </ul>
        </div>
    </div>
</section>

<section class="contact-section">
    <img class="img-left" src="{{ asset('assets/images/contact/img-left.png') }}" alt="">
    <img class="img-right" src="{{ asset('assets/images/contact/img-right.png') }}" alt="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="content">
                    <div class="section-header">
                        <h6 class="sub-title">
                            Contact Us
                        </h6>
                        <h2 class="title">
                            Get in Touch
                        </h2>
                        <p class="text">
                            We'd love to hear from you! Let us know how we can help.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7">
                <form id="add_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="contact-form-wrapper">
                        <div class="single-input">
                            <i class="far fa-user"></i>
                            <input type="text" name="name" placeholder="Enter Your Full Name">
                        </div>
                        <div class="single-input">
                            <i class="far fa-envelope"></i>
                            <input type="text" name="email" placeholder="Enter Your Email Address">
                        </div>
                        <div class="single-input">
                            <i class="far fa-comments"></i>
                            <textarea name="message" placeholder="Type Your Message"></textarea>
                        </div>
                        <button type="button" data-sitekey="6Lcb6GIqAAAAAK9r5LEIfhFcG0pEEVevVYZfwVYk"
                            data-callback='onSubmit'
                            data-action='submit' class="custom-button btn_save g-recaptcha" class="">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function onSubmit(token) {
        $(".btn_save").text('Please wait...');
        $(".btn_save").prop('disabled', 'true');
        var formData = new FormData($("#add_form")[0]);
        $.ajax({
            url: "{{ url('send_email') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(status) {
                if (status.msg == 'success') {
                    $('.btn_save').prop("disabled", false);
                    $(".btn_save").text('Send Message');
                    $('#add_form')[0].reset();
                    toastr.success(status.response, "Success");
                } else if (status.msg == 'error') {
                    $(".btn_save").prop('disabled', false);
                    $(".btn_save").text('Send Message');
                    toastr.error(status.response, "Error");
                } else if (status.msg == 'lvl_error') {
                    $(".btn_save").prop('disabled', false);
                    $(".btn_save").text('Send Message');
                    var message = "";
                    $.each(status.response, function(key, value) {
                        message += value + "<br>";
                    });
                    toastr.error(message, "Error");
                }
            }
        });
    }

    $(document).on("click", ".btn_save", function() {

    });
</script>
@endpush