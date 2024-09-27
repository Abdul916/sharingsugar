@extends('admin.admin_app')
@section('title', 'Dashboard')
@section('content')
<div class="wrapper wrapper-content animated fadeIn">
	<div class="row">
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Total</span>
					<h5>Users</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">{{count_table_records('users')}}</h1>
					<div class="stat-percent font-bold text-primary"><a href="{{ url('admin/users') }}"><span class="label label-primary">View</span></a></div>
					<small>Users</small>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Total</span>
					<h5>Reported Users</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">
						@php
						echo $total = DB::table('user_configs')
						->where('type', 4)
						->count();
						@endphp
					</h1>
					<div class="stat-percent font-bold text-primary"><a href="{{ url('admin/reported_users') }}"><span class="label label-primary">View</span></a></div>
					<small>Reported Users</small>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Total</span>
					<h5>Posts</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">{{count_table_records('posts')}}</h1>
					<div class="stat-percent font-bold text-primary"><a href="{{ url('admin/posts') }}"><span class="label label-primary">View</span></a></div>
					<small>Posts</small>
				</div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Total</span>
					<h5>Messages</h5>
				</div>
				<div class="ibox-content">
					<h1 class="no-margins">{{count_table_records('contactus_msgs')}}</h1>
					<div class="stat-percent font-bold text-primary"><a href="{{ url('admin/contacts_us') }}"><span class="label label-primary">View</span></a></div>
					<small>Messages</small>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection