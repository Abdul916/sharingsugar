@extends('admin.admin_app')
@section('title', 'Reported Users')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2>Reported Users</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin/dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ url('admin/users/reported_users') }}"><strong>Reported Users</strong></a>
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
                                    <th>No of Reports</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($reported_users as $report)
                                <tr id="tr">
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        @php($user_image = get_single_value('users', 'profile_image', $report->config_user_id))
                                        <a href="{{ url('admin/users/profile')}}/{{$report->config_user_id}}" class="text-navy" data-placement="top" title="View Profile">
                                            @if(!empty($user_image))
                                            <img alt="" class="rounded-circle img-fluid" src="{{ asset('assets/app_images')}}/{{$user_image}}" style="width: 40px;">
                                            @else
                                            <img alt="" class="rounded-circle img-fluid" src="{{ asset('assets/app_images/profile-pic.png') }}" style="width: 40px;">
                                            @endif
                                            <br><strong>{{ get_single_value('users', 'username', $report->config_user_id) }}</strong>
                                        </a>
                                    </td>
                                    <td><label class="label label-primary">{{$report->total_reports}}</label></td>
                                    <td>
                                        <a href="{{ url('admin/users/view_report') }}/{{$report->config_user_id }}" class="btn btn-primary" data-placement="top" title="View Reports">View Reports</a>
                                        <button type="button" data-id="{{ $report->config_user_id }}" class="btn btn-danger btn_delete_all_reports" title="Delete All Reports">Delete</button>
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
    $(document).on("click" , ".btn_delete_all_reports" , function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You want to delete all reports about this user!",
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
                    url:"{{ url('admin/users/delete_reports') }}",
                    type:'post',
                    data:{"_token": "{{ csrf_token() }}", 'id': id},
                    dataType:'json',
                    success:function(status){
                        $(".confirm").prop("disabled", false);
                        if(status.msg == 'success'){
                            swal({title: "Success!", text: status.response, type: "success"},
                                function(data){
                                    window.location.href = "{{ url('admin/users/reported_users') }}";
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