@extends('admin.admin_app')
@section('title', 'Edit Category')
@section('content')
@push('styles')

@endpush
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2>Categories</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin/dashboard') }}" title="Dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/categories') }}" title="Categories"><strong>Categories</strong></a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ url('admin/categories/edit') }}/{{$category->id}}" title="Edit Category"><strong> Edit Category</strong></a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary t_m_25" href="{{ url('admin/categories') }}" title="Back To Categories">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Categories
        </a >
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Category Detail</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" id="edit_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$category->id}}">
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Thumbnail</strong>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="picture">
                            </div>
                            <div class="col-sm-1">
                                @if(!empty($category->picture))
                                <a href="{{ asset('assets/posts_img') }}/{{$category->picture}}" target="_blank">
                                    <img src="{{ asset('assets/posts_img') }}/{{$category->picture}}" class="rounded-circle" style="width: 43%;">
                                </a>
                                @else
                                No-Image
                                @endif
                            </div>
                        </div>
                        <div class="form-group row offset-lg-1">
                            <strong class="col-sm-1 col-form-label">Title</strong>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" placeholder="title" value="{{$category->name}}">
                            </div>
                        </div>
                        <div class="form-group row offset-lg-1">
                           <strong class="col-sm-1 col-form-label">Is Active</strong>
                           <div class="col-sm-10">
                            <input class="i-checks" type="checkbox" name="status" @if($category->status == 1) checked @endif>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group row">
                        <strong class="col-sm-2 col-offset-3"></strong>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-white cancel_btn" data-url="{{ url('admin/categories') }}" title="Cancel">Cancel</button>
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
<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

    $(document).on("click" , "#btn_update" , function() {
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData =  new FormData($("#edit_form")[0]);
        $.ajax({
            url:"{{ url('admin/categories/update') }}",
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
                        window.location.href = '{{ url('admin/categories') }}';
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