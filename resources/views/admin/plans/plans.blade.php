@extends('admin.admin_app')
@section('title', 'Plans')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2> Membership Plans </h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <strong> Membership Plans </strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary text-white t_m_25" data-toggle="modal" data-target="#add_modalbox">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New Plan
        </a>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form id="search_form" action="{{url('admin/plans')}}" method="GET" enctype="multipart/form-data">
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search_query" placeholder="Search by Plan Title" value="{{ old('search_query', $searchParams['search_query'] ?? '') }}">
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
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Price</th>
                                    <th>% Off</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($plans as $item)
                                <tr class="gradeX">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $item->name  }}</td>
                                    <td>{{ $item->subtitle  }}</td>
                                    <td>{{ '$'.$item->price}}</td>
                                    <td>{{ $item->off_percent.'%' }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm btn_plan_edit" data-id="{{$item->id}}" type="button"><i class="fa-solid fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm btn_delete" data-id="{{$item->id}}" data-text="you want to delete this plan?" type="button" data-placement="top" title="Delete">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <p>Showing {{ $plans->firstItem() }} to {{ $plans->lastItem() }} of {{ $plans->total() }} entries</p>
                        </div>
                        <div class="col-md-3 text-right">
                            {{ $plans->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal inmodal show fade" id="add_modalbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content animated flipInY">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title">Add New Membership Plan</h5>
            </div>
            <div class="modal-body">
                <form id="add_plan_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>Title</strong></label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>Subtitle</strong></label>
                        <div class="col-sm-8">
                            <input type="text" name="subtitle" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>Percentage Off</strong></label>
                        <div class="col-sm-8">
                            <input type="number" min="0" max="99" name="off_percent" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>Price</strong></label>
                        <div class="col-sm-8">
                            <input type="text" name="price" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"><strong>Description</strong></label>
                        <div class="col-sm-8">
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_plan_button"> Submit </button>
            </div>
        </div>
    </div>
</div>
<div class="modal inmodal show fade" id="edit_modalbox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content animated flipInY" id="edit_modalbox_body">
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
    $(document).on("click", ".btn_delete", function() {
        var id = $(this).attr('data-id');
        var show_text = $(this).attr('data-text');
        swal({
            title: "Are you sure",
            text: show_text,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, please!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $(".confirm").prop("disabled", true);
                $.ajax({
                    url: "{{ url('admin/plans/delete') }}",
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'id': id,
                    },
                    dataType: 'json',
                    success: function(status) {
                        $(".confirm").prop("disabled", false);
                        if (status.msg == 'success') {
                            swal({
                                title: "Success!",
                                text: status.response,
                                type: "success"
                            },
                            function(data) {
                                location.reload();
                            });
                        } else if (status.msg == 'error') {
                            swal("Error", status.response, "error");
                        }
                    }
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });

    $(document).on("click", "#save_plan_button", function() {
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData = new FormData($("#add_plan_form")[0]);
        $.ajax({
            url: "{{ url('admin/plans/store') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(status) {
                console.log(status);
                if (status.msg == 'success') {
                    $("#add_plan_form")[0].reset();
                    btn.ladda('stop');
                    toastr.success(status.response, "Success");
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                } else if (status.msg == 'error') {
                    btn.ladda('stop');
                    toastr.error(status.response, "Error");
                } else if (status.msg == 'lvl_error') {
                    btn.ladda('stop');
                    var message = "";
                    $.each(status.response, function(key, value) {
                        message += value + "<br>";
                    });
                    toastr.error(message, "Error");
                }
            }
        });
    });
    $(document).on("click", ".btn_plan_edit", function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ url('admin/plans/show') }}",
            type: 'POST',
            dataType: 'json',
            data: {
                "_token": "{{ csrf_token() }}",
                'id': id
            },
            success: function(status) {
                $("#edit_modalbox_body").html(status.response);
                $("#edit_modalbox").modal('show');
            }
        });
    });
    $(document).on("click", "#update_plan_button", function() {
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData = new FormData($("#edit_plan_form")[0]);
        $.ajax({
            url: "{{ url('admin/plans/update') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(status) {
                if (status.msg == 'success') {
                    toastr.success(status.response, "Success");
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                } else if (status.msg == 'error') {
                    btn.ladda('stop');
                    toastr.error(status.response, "Error");
                } else if (status.msg == 'lvl_error') {
                    btn.ladda('stop');
                    var message = "";
                    $.each(status.response, function(key, value) {
                        message += value + "<br>";
                    });
                    toastr.error(message, "Error");
                }
            }
        });
    });
</script>
@endpush