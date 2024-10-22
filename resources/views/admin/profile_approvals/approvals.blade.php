@extends('admin.admin_app')
@section('title', 'Profile Change Approval')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2> Profile Approvals </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Profile Approvals </strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form id="search_form" action="{{url('admin/profile_approvals')}}" method="GET" enctype="multipart/form-data">
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search_query" placeholder="Search by username, email" value="{{ old('search_query', $searchParams['search_query'] ?? '') }}">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table id="manage_tbl" class="table table-striped table-bordered dt-responsive" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Sr #</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($approvals as $item)
                                <tr class="gradeX">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->user->username }}</td>
                                    <td>{{ $item->user->email }}</td>
                                    <td>
                                        @if($item->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                        @elseif($item->status == 1)
                                        <span class="badge badge-success">Approved</span>
                                        @else
                                        <span class="badge badge-danger">Declined</span>
                                        @endif
                                    </td>
                                    <td>{{ formated_date($item->created_at)}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm btn_plan_edit" href="{{url('admin/profile_approvals/show/' . $item->id)}}"><i class="fa-solid fa-file"></i> View</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <p>Showing {{ $approvals->firstItem() }} to {{ $approvals->lastItem() }} of {{ $approvals->total() }} entries</p>
                        </div>
                        <div class="col-md-3 text-right">
                            {{ $approvals->links('pagination::bootstrap-4') }}
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
    $('#manage_tbl').dataTable({
        "paging": false,
        "searching": false,
        "bInfo": false,
        "responsive": true,
        "columnDefs": [{
                "responsivePriority": 1,
                "targets": 0
            },
            {
                "responsivePriority": 2,
                "targets": -1
            },
        ]
    });
</script>
@endpush