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
					<div class="table-responsive">
						<table id="table_tbl" class=" dataTables-example table table-striped table-bordered dt-responsive nowrap" style="width:100%">
							<thead>
                                <tr>
                                 <th>Sr #</th>
                                 <th>Username</th>
                                 <th>Type</th>
                                 <th>Status</th>
                                 <th>Price</th>
                                 <th>Start</th>
                                 <th>End</th>
                                 <th>Action</th>
                             </tr>
                         </thead>
                         <tbody>
                            @php($i = 1)
                            <tr id="tr">
                                <td>{{ $i++ }}</td>
                                <td>Samar</td>
                                <td>Gold</td>
                                <td>Active</td>
                                <td>50$</td>
                                <td>12-10-2022</td>
                                <td>12-10-2023</td>
                                <td>
                                   <button class="btn btn-primary btn-sm btn_primary" data-placement="top" data-id="#" title="Membership"> Membership</button>

                                   <!-- <a href="{{ url('admin/users/view_profile/') }}" class="btn btn-success btn-sm btn_primary" type="button" data-placement="top" title="Send Email"> Send Email</a> -->
                               </td>
                           </tr>
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