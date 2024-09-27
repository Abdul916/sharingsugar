@extends('admin.admin_app')
@section('title', 'User Profile')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-lg-8 col-sm-8 col-xs-8">
		<h2>User</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="{{ url('admin/dashboard') }}">Dashboard</a>
			</li>
			<li class="breadcrumb-item">
				<a href="{{ url('admin/users') }}">Users</a>
			</li>
			<li class="breadcrumb-item active">
				<strong>User Profile</strong>
			</li>
		</ol>
	</div>
	<div class="col-lg-4 col-sm-4 col-xs-4 text-right">
		<a class="btn btn-primary t_m_25" href="{{ url('admin/users') }}" title="Back To Users">
			<i class="fa fa-arrow-left" aria-hidden="true"></i> Back To Users
		</a >
	</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="wrapper wrapper-content">
		<div class="row animated fadeInRight">
			<div class="col-md-4">
				<div class="ibox ">
					<div class="ibox-title">
						<h5>Profile Detail</h5>
					</div>
					<div class="ibox-content text-center border-left-right">
						@if(!empty($user->profile_image))
						<img class="rounded-circle img-fluid" src="{{ asset('assets/app_images/')}}/{{ $user->profile_image }}">
						@else
						<img class="rounded-circle img-fluid" src="{{ asset('assets/app_images/profile-pic.png') }}" style="width: 22%;">
						@endif
					</div>
					<div class="ibox-content  text-center profile-content">
						<h4>
							<strong>{{ucwords( $user->username )}}</strong>
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
									<button title="Permanently Delete" data-id="{{ $user->id }}" data-placement="top" type="button" class="btn btn-danger btn-block btn_delete">Delete User Permanently</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="ibox">
					<div class="ibox-title"><h5>Basic Details</h5></div>
					<div class="ibox-content">
						<div class="media-body">
							<div class="row">
								<strong class="col-sm-2">Name</strong>
								<label class="col-sm-4">{{ ucwords($user->first_name) }} {{ucwords($user->last_name)}}</label>
								<strong class="col-sm-2">Email</strong>
								<label class="col-sm-4"><a href="mailto:{{$user->email}}" class="text-navy">{{$user->email}}</a></label>
							</div>
							<div class="row">
								<strong class="col-sm-2">DOB</strong>
								@if(!empty($user->dob))
								<label class="col-sm-4">{{ date_with_month($user->dob)}}</label>
								@endif
								<strong class="col-sm-2">Age</strong>
								@if(!empty($user->dob))
								<label class="col-sm-4">{{age($user->dob)}} Year Old</label>
								@endif
							</div>
							<div class="row">
								<strong class="col-sm-2">Marital Status</strong>
								@if($user->marital_status == 1)
								<label class="col-sm-4" >Single</label>
								@elseif($user->marital_status == 2)
								<label class="col-sm-4">Married</label>
								@elseif($user->marital_status == 3)
								<label class="col-sm-4">Widowed</label>
								@elseif($user->marital_status == 4)
								<label class="col-sm-4">Divorced</label>
								@endif
								<strong class="col-sm-2">Child</strong>
								@if(!empty($user->child))
								<label class="col-sm-4">{{ $user->child }}</label>
								@endif
							</div>
							<div class="row">
								<strong class="col-sm-2">City</strong>
								@if(!empty($user->city))
								<label class="col-sm-4">{{ $user->city }}</label>
								@endif
								<strong class="col-sm-2">Country</strong>
								@if(!empty($user->country))
								<label class="col-sm-4">{{ $user->country }}</label>
								@endif
							</div>
							<div class="row">
								<strong class="col-sm-2">Status</strong>
								@if($user->status == 1)
								<label class="col-sm-4" ><label class="label label-primary">Active</label></label>
								@elseif($user->status == 2)
								<label class="col-sm-4"><label class="label label-danger">Blocked</label></label>
								@elseif($user->status == 3)
								<label class="col-sm-4"><label class="label label-danger">Softly Deleted</label></label>
								@endif

								<strong class="col-sm-2">Profile Status</strong>
								@if($user->profile_status == 1)
								<label class="col-sm-4" ><label class="label label-danger">Unverified</label></label>
								@elseif($user->profile_status == 2)
								<label class="col-sm-4"><label class="label label-primary">Verified</label></label>
								@endif
							</div>

							<div class="hr-line-dashed"></div>
							<h1><strong>Physical</strong></h1><hr>
							<div class="row">
								<strong class="col-sm-2">Height</strong>
								@if(!empty($user->height))
								<label class="col-sm-4">
									@php
									$inch = $user->height / 2.54;
									$feet   = intval( $inch / 12 );
									$inches = $inch % 12;
									$feet_inch   = $feet.' (ft) & '.$inches.' (ins)';

									$kmeter    = $user->height % 100000;
									$mmeter      = floor($kmeter / 100);
									$cmeter     = $kmeter % 100;
									$meter      = $mmeter.'.'.$cmeter.'(m)';
									@endphp
									{{ $feet_inch }} {{ $meter }}
								</label>
								@endif
								<strong class="col-sm-2">Weight</strong>
								@if(!empty($user->weight))
								<label class="col-sm-4">
									{{ $user->weight }} (kg) | {{ ($user->weight * 2.20462)}} (lbs)
								</label>
								@endif
							</div>

							<div class="row">
								<strong class="col-sm-2">Body Type</strong>
								@if($user->body_type == 1)
								<label class="col-sm-4">Skinny</label>
								@elseif($user->body_type == 2)
								<label class="col-sm-4">Thin</label>
								@elseif($user->body_type == 3)
								<label class="col-sm-4">Median</label>
								@elseif($user->body_type == 4)
								<label class="col-sm-4">Athelatic</label>
								@elseif($user->body_type == 5)
								<label class="col-sm-4">Curvilin</label>
								@elseif($user->body_type == 6)
								<label class="col-sm-4">Full Height</label>
								@endif
							</div>
							<div class="hr-line-dashed"></div>
							<h1><strong>About My Self</strong></h1><hr>
							<div class="row">
								<label class="col-sm-12">{{$user->about_me}}</label>
							</div>
							<div class="hr-line-dashed"></div>
							<div class="row">
								<div class="col-sm-12">
									<button type="button" class="btn btn-white cancel_btn" data-url="{{ url('admin/users') }}" title="Cancel">Cancel</button>
									@if($user->status == 1)
									<button type="button" data-id="{{ $user->id }}" data-action="2" class="btn btn-danger btn_active_inactive" title="Block">Block</button>
									@elseif($user->status == 2 || $user->status == 3)
									<button type="button" data-id="{{ $user->id }}" data-action="1" class="btn btn-primary btn_active_inactive" title="Activate">Activate</button>
									@endif
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