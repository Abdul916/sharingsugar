<div>
	<div class="modal-header">
		<h5 class="modal-title">Edit Profile</h5>
	</div>
	<div class="modal-body">
		<form id="edit_form" enctype="multipart/form-data">
			@csrf
			<input type="hidden" name="id" class="form-control" value="{{$profile->id}}">
			<div class="form-group row">
				<label class="col-sm-3 col-form-label"> User Name </label>
				<div class="col-sm-9">
					<input type="text" name="name" class="form-control input-sm" placeholder="User Name" value="{{$profile->name}}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-3 col-form-label"> Email </label>
				<div class="col-sm-9">
					<input type="email" name="email" class="form-control input-sm" placeholder="User Email" value="{{$profile->email}}">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-3 col-form-label"> Address </label>
				<div class="col-sm-9">
					<input type="text" name="address" class="form-control input-sm" placeholder="Address" value="{{$profile->city}}">
				</div>
			</div>
		</form>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-primary" id="update_button"> Save Changes </button>
	</div>
</div>