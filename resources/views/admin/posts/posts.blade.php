@extends('admin.admin_app')
@section('title', 'Posts')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8 col-sm-8 col-xs-8">
        <h2>Posts</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('admin/dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <a href="{{ url('admin/posts') }}"><strong>Posts</strong></a>
            </li>
        </ol>
    </div>
    <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
        <a class="btn btn-primary t_m_25" href="{{ url('admin/posts/create') }}" title="Add New Post">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New Post
        </a >
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
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($posts as $post)
                                <tr id="tr">
                                    <td>{{ $i++ }}</td>
                                    <td>
                                        @if(!empty($post->thumbnail))
                                        <a href="{{ asset('assets/posts_img') }}/{{$post->thumbnail}}" target="_blank">
                                            <img style="width: 50px;" class="rounded-circle" src="{{ asset('assets/posts_img') }}/{{$post->thumbnail}}">
                                        </a>
                                        @else
                                        <a href="{{ asset('assets/posts_img/no_image.jpg') }}" target="_blank">
                                            <img style="width: 50px;" class="rounded-circle" src="{{ asset('assets/posts_img/no_image.jpg') }}">
                                        </a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ mb_strimwidth($post->title, 0, 70, '...') }}
                                    </td>
                                    <td>{{ date_formated($post->created_at) }}</td>
                                    <td>
                                        @if($post->status == '1')
                                        <span class="label label-primary">Active</span></td>
                                        @else
                                        <span class="label label-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/posts/edit') }}/{{$post->id}}" class="btn btn-primary btn-sm" title="Edit"> Edit </a>
                                        <a href="{{ url('blog-detail') }}/{{$post->slug}}" target="_blank" class="btn btn-success btn-sm btn-view" title="View Post">View</a>
                                        <button type="button" data-id="{{$post->id}}" class="btn btn-danger btn-sm btn_delete" title="Delete">Delete</button>
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

    $(document).on("click" , ".btn_delete" , function(){
        var id = $(this).attr('data-id');
        swal({
            title: "Are you sure?",
            text: "You want to delete this post!",
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
                    url:"{{ url('admin/posts/delete') }}",
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