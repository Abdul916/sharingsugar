@extends('admin.admin_app')
@section('title', 'Memberships')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2>Memberships</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin/dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ url('admin/') }}"><strong>Memberships</strong></a>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form id="search_form" action="{{url('admin/memberships')}}" method="GET" enctype="multipart/form-data">
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search_query" placeholder="Search by name, type" value="{{ old('search_query', $searchParams['search_query'] ?? '') }}">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="table_tbl" class=" dataTables-example table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>UserName</th>
                                    <th>Membership start Date</th>
                                    <th>Membership End Date</th>
                                    <th>Membership Type</th>
                                    <th>Membership Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($membership_logs as $logs)
                                <tr id="tr">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $logs->username }}</td>
                                    <td>{{ $logs->membership_start }}</td>
                                    <td>{{ $logs->membership_end }}</td>
                                    <td>
                                        @if($logs->membership_type == 1)
                                        <p>Bronze</p>
                                        @elseif($logs->membership_type == 2)
                                        <p>Silver</p>
                                        @elseif($logs->membership_type == 3)
                                        <p>Gold</p>
                                        @elseif($logs->membership_type == 4)
                                        <p>Platinum</p>
                                        @elseif($logs->membership_type == 5)
                                        <p>Monthly</p>
                                        @elseif($logs->membership_type == 6)
                                        <p>Half-Yearly</p>
                                        @elseif($logs->membership_type == 7)
                                        <p>Yearly</p>
                                        @else
                                        <p>Unknown</p>
                                        @endif

                                    </td>
                                    <td>{{ $logs->membership_price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <p>Showing {{ $membership_logs->firstItem() }} to {{ $membership_logs->lastItem() }} of {{ $membership_logs->total() }} entries</p>
                        </div>
                        <div class="col-md-3 text-right">
                            {{ $membership_logs->links('pagination::bootstrap-4') }}
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

    $('#table_tbl').dataTable({
        "paging": false,
        "searching": false,
        "bInfo":false,
        "responsive": true,
        "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
        "columnDefs": [
            { "responsivePriority": 1, "targets": 0 },
            // { "responsivePriority": 2, "targets": -1 },
            // { "responsivePriority": 3, "targets": -2 },
            ]
    });

    $(document).on("click" , ".btn_delete" , function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You want to delete this User!",
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
</script>
@endpush