@extends('admin.admin_app')
@section('title', 'Send Emails')
@section('content')
@push('styles')
<link href="{{ asset('admin_assets/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
<style>
    .note-editable{
        height: 370px;
    }
</style>
@endpush
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2>Send New Email</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin/dashboard') }}" title="Dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/emails') }}" title="Emails">Dispatched Emails</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ url('admin/emails/create') }}" title="Create Email"><strong>Send New Email</strong></a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary t_m_25" href="{{ url('admin/emails') }}" title="Back To Emails">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Emails
        </a >
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Email Template</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="" id="add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Title</strong>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" required id="title" placeholder="title">
                            </div>
                        </div>
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Body</strong>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="7" name="body" placeholder="Add your message"></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <strong class="col-sm-2 col-offset-3"></strong>
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-primary" id="btn_save" required title="Submit">Dispatch</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script>

    $(document).on("click" , "#btn_save" , function() {
        // validate form
        if($("#add_form")[0].checkValidity() == false) {
            $("#add_form")[0].reportValidity();
            return false;
        }
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData =  new FormData($("#add_form")[0]);
        $.ajax({
            url:"{{ url('admin/emails/dispatch') }}",
            type: 'POST',
            data: formData,
            dataType:'json',
            cache: false,
            contentType: false,
            processData: false,
            success:function(status){
                if(status.msg=='success') {
                    toastr.success(status.response,"Success");
                    $('#add_form')[0].reset();
                    setTimeout(function(){
                        location.reload(true);
                    }, 2000);
                } else if(status.msg == 'error') {
                    btn.ladda('stop');
                    toastr.error(status.response,"Error");
                } else if(status.msg == 'lvl_error') {
                    btn.ladda('stop');
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