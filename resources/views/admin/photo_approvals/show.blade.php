@extends('admin.admin_app')
@section('title', 'Photo Change Approval')
@section('content')
@push('styles')
@endpush
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2>Images Approval Page</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin/dashboard') }}" title="Dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/photo_approvals') }}" title="Emails">Photo Approvals</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Images Approval Page</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary t_m_25" href="{{ url('admin/photo_approvals') }}" title="Back To Approval List">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Approval List
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Image Detail</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group">
                        <div class="row">
                            <strong class="col-sm-2">Username: </strong>
                            <label class="col-sm-4"> {{$approval->user->username}} </label>
                            <strong class="col-sm-2">I Am: </strong>
                            <label class="col-sm-4"> {{$approval->user->iam}}</label>
                        </div>
                        <div class="row">
                            <strong class="col-sm-2">Email: </strong>
                            <label class="col-sm-4"> {{$approval->user->email}} </label>
                            <strong class="col-sm-2">Interested In: </strong>
                            <label class="col-sm-4">{{$approval->user->interestedin}}</label>
                        </div>
                        <div class="row">
                            <strong class="col-sm-2"></strong>
                            <label class="col-sm-4"> </label>
                            <strong class="col-sm-2">Image Type: </strong>
                            <label class="col-sm-4">
                                @if($approval->type == 0)
                                Profile Photo
                                @elseif($approval->type == 1)
                                Public Photo
                                @else
                                Private Photo
                                @endif
                            </label>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Profile Image</h4>
                                <img src="{{ asset('assets/app_images/' . $approval->user->profile_image) }}" class="img-thumbnail" alt="Profile Photo" style="width: 100px; height: 100px;">
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Public Images</h4>
                                @foreach(get_photos('user_photos', $approval->user->id, '1', array('1, 2')) as $public)
                                <img src="{{ asset('assets/app_images/user_photos') }}/{{$public->photo}}" class="img-thumbnail fixed_image" alt="Public Photo" style="width: 100px; height: 100px;">
                                @endforeach
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Private Images</h4>
                                @foreach(get_photos('user_photos', $approval->user->id, '2', array('1, 2')) as $public)
                                <img src="{{ asset('assets/app_images/user_photos') }}/{{$public->photo}}" class="img-thumbnail fixed_image" alt="Private Photo" style="width: 100px; height: 100px;">
                                @endforeach
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Image that need approval</h4>
                                @if($approval->type != 0)
                                <img src="{{ asset('assets/app_images/user_photos/' . $approval->photo) }}" class="img-thumbnail" alt="New Photo" style="width: 300px; height: 300px;">
                                @else
                                <img src="{{ asset('assets/app_images/' . $approval->photo) }}" class="img-thumbnail" alt="New Photo" style="width: 300px; height: 300px;">
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <button type="button" class="btn btn-primary " {{$approval->status != 0 ? 'disabled' : ''}} data-id="{{$approval->id}}" id="btn_approve" type="submit">Approve</button>
                                <button type="button" class="btn btn-danger " {{$approval->status != 0 ? 'disabled' : ''}} data-id="{{$approval->id}}" id="btn_decline">Decline</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')

<script>
    $('#btn_approve').click(function() {
        var id = $(this).data('id');
        var url = '{{url("admin/photo_approvals/approve")}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == 'success') {
                    toastr.success(response.message);
                    setTimeout(function() {
                        window.location.href = '{{url("admin/photo_approvals")}}';
                    }, 1000);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });

    $('#btn_decline').click(function() {
        var id = $(this).data('id');
        var url = '{{url("admin/photo_approvals/decline")}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id: id
            },
            success: function(response) {
                if (response.status == 'success') {
                    toastr.success(response.message);
                    setTimeout(function() {
                        window.location.href = '{{url("admin/photo_approvals")}}';
                    }, 1000);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });
</script>
@endpush