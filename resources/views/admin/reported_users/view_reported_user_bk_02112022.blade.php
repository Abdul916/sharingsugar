@extends('admin.admin_app')
@section('title', 'Report Details')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-8 col-sm-8 col-xs-8">
		<h2>Reported Users</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('admin/dashboard') }}">Dashboard</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ url('admin/reported_user') }}">Reported Users</a>
			</li>
			<li class="breadcrumb-item active">
				<a href="{{ url('admin/reported_user/view_report')}}/{{ $reported_user->id }}"><strong>{{ $reported_user->username }}</strong></a>
			</li>
		</ol>
	</div>
	<!-- <div class="col-lg-4 col-sm-4 col-xs-4 text-right">
		<a class="btn btn-primary t_m_25" href="{{ url('admin/reported_user') }}" title="Back To Reported User List">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Reported User List
		</a >
	</div> -->
	<div class="col-lg-4 col-sm-4 col-xs-4 text-right">
		@if($reported_user->status ==1)
		<button type="button" data-id="{{ $reported_user->id }}" class="btn btn-danger t_m_25" id="btn_block" title="Block">Block</button>
		@elseif($reported_user->status ==2)
		<button class="btn btn-warning t_m_25">Blocked</button>
		@endif
		<a class="btn btn-white t_m_25" href="{{ url('admin/reported_user') }}" title="Cancel">Cancel</a>
	</div>
</div>

	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="wrapper wrapper-content">
			<div class="row animated fadeInRight">
				<div class="col-md-12">
					<div class="ibox ">
						<div class="ibox-title">
							<h5>All Reports Details</h5>
						</div>
						<div class="ibox-content">
							<div>
								<div class="feed-activity-list">
									<div class="feed-element">
										<div class="media-body ">
											<div class="row">
												@foreach($user_reports as $user_report)
												<div  class="col-lg-6">
													<div style="min-height: 200px" class="contact-box">
														<div class="row">
															<div class="col-4">
																<div class="text-center">
																	@if( empty( get_single_value('users', 'profile_image',$user_report->user_id)))
																	<img src="{{ asset('assets/app_images/profile-pic.png') }}" class="custom-img-size rounded-circle m-t-xs img-fluid" >
																	@else
																	<img src="{{ asset('assets/app_images') }}/{{ get_single_value('users', 'profile_image',$user_report->user_id) }}" class="custom-img-size rounded-circle m-t-xs img-fluid" >
																	@endif
																	<h3><strong>{{ get_single_value('users', 'username',$user_report->user_id) }}</strong></h3>

																</div>
															</div>
															<div class="col-4">
																<label class="text-info">Reported at:</label>
																<p>{{ $user_report->created_at }}</p>
																<label class="text-danger">Report Reason</label>
																<p>{{ $user_report->description }}</p>

															</div>
															<div class="col-4">
																@if(empty($user_report->image))
																<img src="{{ asset('assets/report_images/report-img.jpg') }}"class="m-t-xs img-fluid" >
																@else
																<img src="{{ asset('assets/report_images/'.$user_report->image) }}" alt="Report Image" class="m-t-xs img-fluid" >
																@endif
															</div>
														</div>
													</div>
												</div>
												@endforeach
											</div>
										</div>
									</div>
								</div>
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
		$(document).on("click" , "#btn_block" , function() {
			var id = $(this).attr('data-id');
			$.ajax({
				url:"{{ url('admin/reported_user/block_user') }}",
				type: 'POST',
				dataType:'json',
				data: {"_token": "{{ csrf_token() }}", 'id': id},
				success:function(status){
					if(status.msg=='success') {
						toastr.success(status.response,"Success");
						setTimeout(function(){
							window.location = "{{ url('admin/reported_user') }}";
							// location.reload(true);
						}, 2000);
					} else if(status.msg == 'error') {
						toastr.error(status.response,"Error");
					} else if(status.msg == 'lvl_error') {
						var message = "";
						$.each(status.response, function (key, value) {
							message += value+"<br>";
						});
						toastr.error(message, "Error");
					}
				}
			});
		});
	</script>
	@endpush