@extends('admin.admin_app')
@section('title', 'Contact Us')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-8 col-sm-8 col-xs-8">
		<h2>Contact Us</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('admin/dashboard') }}">Dashboard</a>
			</li>
			<li class="breadcrumb-item active">
				<a href="{{ url('admin/contacts_us') }}"><strong>Contact Us Messages</strong></a>
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
                                 <th>Date&Time</th>
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Message</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                            @php($i = 1)
                            @foreach($contactus_msgs as $contactus_msg)
                            <tr id="tr">
                                <td>{{ $i++ }}</td>
                                <td>{{ month_date_time($contactus_msg->created_at) }}</td>
                                <td>{{ $contactus_msg->name }}</td>
                                <td>{{ $contactus_msg->email }}</td>
                                <td>{!! wordwrap($contactus_msg->message, 120, "<br>\n");  !!}</td>
                                <td>
                                   {{-- <a href="javascript:void(0)" class="btn btn-success btn-sm btn_primary" type="button" data-placement="top" title="Send Email">Send Email</a> --}}
                                   <button class="btn btn-danger btn-sm btn_delete" data-placement="top" data-id="{{ $contactus_msg->id }}" title="Delete">Delete</button>
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
        text: "You want to delete this message!",
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
                url:"{{ url('admin/contacts_us/delete') }}",
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