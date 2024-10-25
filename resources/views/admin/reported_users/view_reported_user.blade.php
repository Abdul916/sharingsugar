@extends('admin.admin_app')
@section('title', 'Report Details')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-8 col-sm-8 col-xs-8">
		<h2>Report Details</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('admin/dashboard') }}">Dashboard</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ url('admin/users/reported_users') }}">Reported Users</a>
			</li>
			<li class="breadcrumb-item active">
				<strong>Report Details</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-4 col-sm-4 col-xs-4 text-right">
		<a class="btn btn-primary t_m_25" href="{{ url('admin/users/reported_users') }}" title="Back To Reported Users">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Reported Users
		</a>
	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="wrapper wrapper-content">
		<div class="row animated fadeInRight">
			<div class="col-md-4">
				<div class="ibox ">
					<div class="ibox-title">
						<h5>Reported User</h5>
					</div>
					<div class="ibox-content text-center border-left-right">
						<a href="{{ url('admin/users/profile')}}/{{$user->id}}" class="text-navy" data-placement="top" title="View Profile" target="_blank">
							@if(!empty($user->profile_image))
							<img class="rounded-circle img-fluid" src="{{ asset('assets/app_images')}}/{{$user->profile_image}}">
							@else
							<img class="rounded-circle img-fluid" src="{{ asset('assets/app_images/profile-pic.png') }}" style="width: 22%;">
							@endif
						</a>
					</div>
					<div class="ibox-content text-center profile-content">
						<h4>
							<a href="{{ url('admin/users/profile')}}/{{$user->id}}" class="text-navy" data-placement="top" title="View Profile" target="_blank">
								<strong>{{ucwords( $user->username )}}</strong>
							</a>
							<br>
							<sub> Last Login: {{ time_elapsed_string($user->last_login) }}</sub>
						</h4>
						<p><i class="fa fa-map-marker"></i> {{ $user->city}}, {{ $user->country }}</p>
						<div class="row">
							<div class="col-md-6">
								<strong class="text-navy">i-am</strong>
								<h5 class="col-sm-12">{{ $user->iam }}</h5>
							</div>
							<div class="col-md-6">
								<strong class="text-navy">Interested-in</strong>
								<h5 class="col-sm-12">{{ $user->interestedin }}</h5>
							</div>
						</div>
						<div class="hr-line-dashed"></div>
						<div class="user-button">
							<div class="row">
								<div class="col-md-12">
									{{-- @if($user->status == 1)
									<button type="button" data-id="{{ $user->id }}" data-action="2" class="btn btn-danger btn-block btn_active_inactive">Block</button>
									@elseif($user->status == 2 || $user->status == 3)
									<button type="button" data-id="{{ $user->id }}" data-action="1" class="btn btn-primary btn-block btn_active_inactive">Activate</button>
									@endif --}}
									<button title="Permanently Delete" data-id="{{ $user->id }}" data-placement="top" type="button" class="btn btn-danger btn-block btn_delete">Delete User Permanently</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="ibox ">
					<div class="ibox-title">
						<h5>Who's Report</h5>
					</div>
					<div class="ibox-content">
						<div class="table-responsive">
							<table id="table_tbl" class=" dataTables-example table table-striped table-bordered dt-responsive nowrap" style="width:100%">
								<thead>
									<tr>
										<th>Sr #</th>
										<th>Who's Report</th>
										<th>Date</th>
										<th>Reason</th>
										<th>Image</th>
									</tr>
								</thead>
								<tbody>
									@php($i = 1)
									@foreach($user_reports as $report)
									<tr id="tr">
										<td>{{ $i++ }}</td>
										<td class="text-center">
											<a href="{{ url('admin/users/profile')}}/{{$report->user_id}}" class="text-navy" data-placement="top" title="View Profile" target="_blank">
												@if(!empty(get_single_value('users', 'profile_image', $report->user_id)))
												<img src="{{ asset('assets/app_images') }}/{{ get_single_value('users', 'profile_image',$report->user_id) }}" class="custom-img-size rounded-circle m-t-xs img-fluid" >
												@else
												<img src="{{ asset('assets/app_images/profile-pic.png') }}" class="custom-img-size rounded-circle m-t-xs img-fluid" >
												@endif
												<br>
												<strong>{{ get_single_value('users', 'username', $report->user_id) }}</strong>
											</a>
										</td>
										<td>{{ month_date_time($report->created_at) }}</td>
										<td>{{ $report->description }}</td>
										<td>
											<img style="max-width: 60px" src="{{ asset('assets/report_images/')}}/{{$report->image}}" alt="No Image" class="m-t-xs img-fluid">
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						@if(!$user_reports->isEmpty())
						<div class="hr-line-dashed"></div>
						<div class="col-lg-12 col-sm-12 col-xs-12">
							<button class="btn btn-white" data-url="{{ url('admin/users/reported_users') }}" title="Cancel">Cancel</button>
							<button type="button" data-id="{{ $user->id }}" id="btn_delete_all_reports" class="btn btn-danger" title="Delete All Reports"> Delete All Reports</button>
						</div>
						@endif
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
// $(document).on("click" , ".btn_active_inactive" , function(){
// 	var id = $(this).attr('data-id');
// 	var action = $(this).attr('data-action');
// 	if(action == "1"){
// 		var title_txt = "You want to activate this user!";
// 	}else if(action == "2"){
// 		var title_txt = "You want to block this user!";
// 	}
// 	swal({
// 		title: "Are you sure?",
// 		text: title_txt,
// 		type: "warning",
// 		showCancelButton: true,
// 		confirmButtonColor: "#DD6B55",
// 		confirmButtonText: "Yes, please!",
// 		cancelButtonText: "No, cancel please!",
// 		closeOnConfirm: false,
// 		closeOnCancel: true
// 	},
// 	function(isConfirm) {
// 		if (isConfirm) {
// 			$(".confirm").prop("disabled", true);
// 			$.ajax({
// 				url:"{{ url('admin/users/change_status') }}",
// 				type:'post',
// 				data: {"_token": "{{ csrf_token() }}", 'id': id, 'action': action},
// 				dataType:'json',
// 				success:function(status){
// 					$(".confirm").prop("disabled", false);
// 					if(status.msg == 'success'){
// 						swal({title: "Success!", text: status.response, type: "success"},
// 							function(data){
// 								location.reload(true);
// 							});
// 					} else if(status.msg=='error'){
// 						swal("Error", status.response, "error");
// 					}
// 				}
// 			});
// 		} else {
// 			swal("Cancelled", "", "error");
// 		}
// 	});
// });

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
			closeOnCancel: true
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

	$(document).on("click" , "#btn_delete_all_reports" , function(){
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
			closeOnCancel: true
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