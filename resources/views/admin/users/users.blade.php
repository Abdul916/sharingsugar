@extends('admin.admin_app')
@section('title', 'Users')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2>Users</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin/dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ url('admin/users') }}"><strong>Users</strong></a>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="table_tbl" class=" dataTables-example table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($users as $user)
                                <tr id="tr">
                                    <td>{{ $i++ }}</td>
                                    <td class="text-center">
                                        @if(!empty($user->profile_image))
                                        <img class="rounded-circle" style="width: 50px;" src="{{ asset('assets/app_images')}}/{{$user->profile_image }}">
                                        @else
                                        <img class="rounded-circle" style="width: 50px;" src="{{ asset('assets/app_images/profile-pic.png') }}">
                                        @endif
                                        <br><span class="text-center">{{$user->username}}</span>
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->city}}</td>
                                    <td>
                                        @if($user->status == 1)
                                        <label class="label label-primary">Active</label>
                                        @elseif($user->status == 2)
                                        <label class="label label-danger">Blocked</label>
                                        @elseif($user->status == 3)
                                        <label class="label label-danger">Softly Deleted</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/users/profile')}}/{{$user->id}}" class="btn btn-success btn-sm" data-placement="top" title="View Profile">View</a>
                                        @if($user->status == 1)
                                        <button class="btn btn-dark btn-sm btn_active_inactive" title="Block" data-id="{{ $user->id }}" data-action="2" type="button" data-placement="top">Block</button>
                                        @elseif(($user->status == 2) || ($user->status == 3))
                                        <button class="btn btn-primary btn-sm btn_active_inactive" title="Activate" data-id="{{ $user->id }}" data-action="1" type="button" data-placement="top">Activate</button>
                                        @endif
                                        <button class="btn btn-sm btn-danger btn_delete" title="Permanently Delete" data-id="{{ $user->id }}" data-placement="top" type="button">Delete</button>

                                        <button class="btn btn-sm btn-info btn_generate_new_passwprd" title="Generate New Passowrd" data-id="{{ $user->id }}" data-placement="top" type="button">Generate New Passowrd</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#table_tbl').dataTable({
        "paging": true,
        "searching": true,
        "bInfo":true,
        "responsive": true,
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "columnDefs": [
            { "responsivePriority": 1, "targets": 0 },
            { "responsivePriority": 2, "targets": -1 },
            { "responsivePriority": 3, "targets": -2 },
            ]
    });
    $(document).on("click" , ".btn_active_inactive" , function(){
        var id = $(this).attr('data-id');
        var action = $(this).attr('data-action');
        if(action == "1"){
            var title_txt = "You want to activate this user!";
        }else if(action == "2"){
            var title_txt = "You want to block this user!";
        }
        swal({
            title: "Are you sure?",
            text: title_txt,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, please!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                $(".confirm").prop("disabled", true);
                $.ajax({
                    url:"{{ url('admin/users/change_status') }}",
                    type:'post',
                    data: {"_token": "{{ csrf_token() }}", 'id': id, 'action': action},
                    dataType:'json',
                    success:function(status){
                        $(".confirm").prop("disabled", false);
                        if(status.msg == 'success'){
                            swal({title: "Success!", text: status.response, type: "success"},
                                function(data){
                                    location.reload(true);
                                });
                        } else if(status.msg=='error'){
                            swal("Error", status.response, "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });

    $(document).on("click" , ".btn_delete" , function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You want to permanently delete this user!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, please!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                $(".confirm").prop("disabled", true);
                $.ajax({
                    url:"{{ url('admin/users/delete') }}",
                    type:'post',
                    data:{"_token": "{{ csrf_token() }}", 'id': id},
                    dataType:'json',
                    success:function(status){
                        $(".confirm").prop("disabled", false);
                        if(status.msg == 'success'){
                            swal({title: "Success!", text: status.response, type: "success"},
                                function(data){
                                    location.reload(true);
                                });
                        } else if(status.msg=='error'){
                            swal("Error", status.response, "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });

    $(document).on("click" , ".btn_generate_new_passwprd" , function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You want to generate new passwprd!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, please!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                $(".confirm").prop("disabled", true);
                $.ajax({
                    url:"{{ url('admin/users/generate_password') }}",
                    type:'post',
                    data:{"_token": "{{ csrf_token() }}", 'id': id},
                    dataType:'json',
                    success:function(status){
                        $(".confirm").prop("disabled", false);
                        if(status.msg == 'success'){
                            swal({title: "Success!", text: status.response, type: "success"},
                                function(data){
                                    location.reload(true);
                                });
                        } else if(status.msg=='error'){
                            swal("Error", status.response, "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });
</script>
@endpush