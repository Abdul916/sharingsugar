@extends('admin.admin_app')
@section('title', 'Edit Post')
@section('content')
@push('styles')
<link href="{{ asset('admin_assets/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
@endpush
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2>Posts</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin/dashboard') }}" title="Dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/posts') }}" title="Posts"><strong>Posts</strong></a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ url('admin/posts/edit') }}/{{$post->id}}" title="Edit Post"><strong> Edit Post</strong></a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary t_m_25" href="{{ url('admin/posts') }}" title="Back To Posts">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Posts
        </a >
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Post Detail</h5>
                    <div class="pull-right" style="top: 8px;">
                        <a href="{{url('blog-detail')}}/{{$post->slug}}" class="btn btn-success" target="_blank">View Post</a>
                    </div>
                </div>
                <div class="ibox-content">
                    <form method="post" id="edit_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Thumbnail</strong>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="thumbnail">
                            </div>
                            <div class="col-sm-1">
                                @if(!empty($post->thumbnail))
                                <a href="{{ asset('assets/posts_img') }}/{{$post->thumbnail}}" target="_blank">
                                    <img src="{{ asset('assets/posts_img') }}/{{$post->thumbnail}}" class="rounded-circle" style="width: 43%;">
                                </a>
                                @else
                                No-Image
                                @endif
                            </div>
                        </div>
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Title</strong>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" id="title" placeholder="title" value="{{$post->title}}">
                            </div>
                        </div>
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Description</strong>
                            <div class="col-sm-10">
                                <textarea class="form-control summernote" name="description" placeholder="Description">{{$post->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row offset-lg-1">
                           <strong class="col-sm-1 col-form-label">Is Active</strong>
                           <div class="col-sm-10">
                            <input class="i-checks" type="checkbox" name="status" @if($post->status == 1) checked @endif>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group row">
                        <strong class="col-sm-2 col-offset-3"></strong>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-white cancel_btn" data-url="{{ url('admin/posts') }}" title="Cancel">Cancel</button>
                            <button type="button" class="btn btn-primary" id="btn_update" title="Submit">Save Changes</button>
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
<script src="{{ asset('admin_assets/js/plugins/summernote/summernote-bs4.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
    $(document).ready(function () {
        $('.summernote').summernote({
        });
    });
    $(document).on("click" , "#btn_update" , function() {
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData =  new FormData($("#edit_form")[0]);
        $.ajax({
            url:"{{ url('admin/posts/update') }}",
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
                        window.location.href = '{{ url('admin/posts') }}';
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