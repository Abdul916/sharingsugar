@extends('admin.admin_app')
@section('title', 'Profile Change Approval')
@section('content')
@push('styles')
@endpush
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2>View Profile Change Approval</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin/dashboard') }}" title="Dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('admin/profile_approvals') }}" title="Emails">Profile Approvals</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ url('admin/profile_approvals/show/' . $approval->id ) }}" title="View Profile Change Approval<l"><strong>View Profile Change Approval<< /strong></a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary t_m_25" href="{{ url('admin/profile_approvals') }}" title="Back To All Approvals">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back To All Approvals
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Profile Changes</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Attribute</strong>
                        <div class="col-sm-4">
                            <h4>Previous</h4>
                        </div>
                        <div class="col-sm-4">
                            <h4>New</h4>
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">First Name</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="first_name" required id="first_name" value="{{$user->first_name}}" readonly placeholder="first_name">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="first_name" required id="first_name" value="{{$approval_data['first_name']}}" readonly placeholder="first_name">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Last Name</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="last_name" required id="last_name" value="{{$user->last_name}}" readonly placeholder="last_name">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="last_name" required id="last_name" value="{{$approval_data['last_name']}}" readonly placeholder="first_name">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Username</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="username" required id="username" value="{{$user->username}}" readonly placeholder="username">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="username" required id="username" value="{{$approval_data['username']}}" readonly placeholder="username">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">DOB</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="dob" required id="dob" value="{{$user->dob}}" readonly placeholder="dob">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="dob" required id="dob" value="{{$approval_data['dob']}}" readonly placeholder="dob">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Gender</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="gender" required id="gender" value="{{map_gender($user->gender)}}" readonly placeholder="gender">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="gender" required id="gender" value="{{map_gender($approval_data['gender'])}}" readonly placeholder="gender">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Height</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="height" required id="height" value="{{$user->height}}" readonly placeholder="height">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="height" required id="height" value="{{$approval_data['height']}}" readonly placeholder="height">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Weight</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="weight" required id="weight" value="{{$user->weight}}" readonly placeholder="weight">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="weight" required id="weight" value="{{$approval_data['weight']}}" readonly placeholder="weight">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Marital Status</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="marital_status" required id="marital_status" value="{{map_marital_status($user->marital_status)}}" readonly placeholder="marital_status">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="marital_status" required id="marital_status" value="{{map_marital_status($approval_data['marital_status'])}}" readonly placeholder="marital_status">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Children</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="child" required id="child" value="{{$user->child}}" readonly placeholder="child">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="child" required id="child" value="{{$approval_data['child']}}" readonly placeholder="child">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Body Type</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="body_type" required id="body_type" value="{{map_body($user->body_type)}}" readonly placeholder="body_type">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="body_type" required id="body_type" value="{{map_body($approval_data['body_type'])}}" readonly placeholder="body_type">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">State/Province</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="state" required id="state" value="{{$user->state}}" readonly placeholder="state">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="state" required id="state" value="{{$approval_data['state']}}" readonly placeholder="state">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Zip</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="zipcode" required id="zipcode" value="{{$user->zipcode}}" readonly placeholder="zipcode">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="zipcode" required id="zipcode" value="{{$approval_data['zipcode']}}" readonly placeholder="zipcode">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Country</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="country" required id="country" value="{{$user->country}}" readonly placeholder="country">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="country" required id="country" value="{{$approval_data['country']}}" readonly placeholder="country">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">City</strong>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="city" required id="city" value="{{$user->city}}" readonly placeholder="city">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="city" required id="city" value="{{$approval_data['city']}}" readonly placeholder="city">
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">Address</strong>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="2" name="address" readonly>{{$user->address}}</textarea>
                        </div>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="2" name="address" readonly>{{$approval_data['address']}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row offset-lg-1">
                        <strong class="col-sm-2 col-form-label">About Me</strong>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="4" name="about_me" readonly>{{$user->about_me}}</textarea>
                        </div>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="4" name="about_me" readonly>{{$approval_data['about_me']}}</textarea>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group row">
                        <strong class="col-sm-2 col-offset-3"></strong>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-primary {{$approval->status != 0 ? 'disabled' : ''}}" data-id="{{$approval->id}}" id="btn_approve" type="submit">Approve</button>
                            <button type="button" class="btn btn-danger {{$approval->status != 0 ? 'disabled' : ''}}" data-id="{{$approval->id}}" id="btn_decline">Decline</button>
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
        var url = '{{url("admin/profile_approvals/approve")}}';
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
                        window.location.href = '{{url("admin/profile_approvals")}}';
                    }, 1000);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });

    $('#btn_decline').click(function() {
        var id = $(this).data('id');
        var url = '{{url("admin/profile_approvals/decline")}}';
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
                        window.location.href = '{{url("admin/profile_approvals")}}';
                    }, 1000);
                } else {
                    toastr.error(response.message);
                }
            }
        });
    });
</script>
@endpush