@extends('admin.admin_app')
@section('title', 'Add Post')
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
        <h2>Posts</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin/dashboard') }}" title="Dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/posts') }}" title="Posts"><strong>Posts</strong></a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ url('admin/posts/create') }}" title="Add New Post"><strong> Add New Post</strong></a>
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
                </div>
                <div class="ibox-content">
                    <form method="post" action="" id="add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Thumbnail</strong>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="thumbnail">
                            </div>
                        </div>
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Category</strong>
                            <div class="col-sm-10">
                                <select class="form-control" name="category" id="category">
                                    <option value="">Select category</option>
                                    <?php foreach (get_complete_table('categories', '', '', '', '1', '', '') as $category) { ?>
                                        <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Title</strong>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" id="title" placeholder="title">
                            </div>
                        </div>
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">SEO Keywords</strong>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keywords" id="keywords" placeholder="SEO Keywords">
                                <code>Write multiple SEO keywords seperated by comma like: (keyword1, keyword2, keyword3).</code>
                            </div>
                        </div>
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Short Description</strong>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="short_description" placeholder="Short Description" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Description</strong>
                            <div class="col-sm-10">
                                <textarea class="form-control summernote" name="description" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <strong class="col-sm-2 col-offset-3"></strong>
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-white cancel_btn" data-url="{{ url('admin/posts') }}" title="Cancel">Cancel</button>
                                <button type="button" class="btn btn-primary" id="btn_save" title="Submit">Submit</button>
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
        $('.summernote').summernote({
        });
    });

    $(document).on("click" , "#btn_save" , function() {
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData =  new FormData($("#add_form")[0]);
        $.ajax({
            url:"{{ url('admin/posts/store') }}",
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