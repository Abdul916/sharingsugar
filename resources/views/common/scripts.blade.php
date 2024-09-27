<script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('assets/js/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/heandline.js') }}"></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/countdown.min.js') }}"></script>
<script src="{{ asset('assets/js/odometer.min.js') }}"></script>
<script src="{{ asset('assets/js/viewport.jquery.js') }}"></script>
<script src="{{ asset('assets/js/nice-select.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

<script>
	$('form#submit_form').submit(function(){
		$(this).find(':input[type=submit]').prop('disabled', true);
		$(this).find(':input[type=submit]').text('Please wait...');
	});

	$(document).on("click" , ".btn_delete_photos" , function(){
		var id = $(this).attr('data-id');
		swal({
			title: "Are you sure?",
			text: "You want to delete this photo!",
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
					url:'{{ url('delete_photos') }}',
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

	$(document).on("click" , ".btn_user_configs" , function() {
		var id = $(this).attr('data-id');
		var action = $(this).attr('data-action');
		var requested_id = "";
		requested_id = $(this).attr('data-requested-id');

		if(action == "favorite"){
			var title_txt = "You want to add this user in favorite list!";
		}else if(action == "like"){
			var title_txt = "You want to like this user!";
		}else if(action == "block"){
			var title_txt = "You want to block this user!";
		}else if(action == "report"){
			var title_txt = "You want to report this user!";
		}else if(action == "unlike"){
			var title_txt = "You want to unlike this user!";
		}else if(action == "unfavorite"){
			var title_txt = "You want to remove this user from favorite list!";
		}else if(action == "unblock"){
			var title_txt = "You want to unblock this user!";
		}else if(action == "allow_private_photos"){
			var title_txt = "You want to allow this user to view your private photos!";
		}else if(action == "request_private_photos"){
			var title_txt = "You want to request for private photos!";
		}else if(action == "block_private_photos"){
			var title_txt = "You want to block this user to view your private photos!";
		}else if(action == "delete_request"){
			var title_txt = "You want to delete your request!";
		}else{
			var title_txt = "You want to like this user!";
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
					url:'{{ url('add_remover_user_configuration') }}',
					type:'post',
					data:{"_token": "{{ csrf_token() }}", 'id': id, 'action': action, 'requested_id': requested_id},
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

	$(document).on("click" , ".btn_like_photos" , function() {
		var id = $(this).attr('data-id');
		var action = $(this).attr('data-action');
		var user_id = $(this).attr('data-user-id');
		var photo_user_id = $(this).attr('photo-user-id');

		if(action == "like"){
			var title_txt = "You want to like this photo!";
		}else if(action == "unlike"){
			var title_txt = "You want to unlike this photo!";
		}else{
			var title_txt = "You want to like this photo!";
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
					url:'{{ url('like_user_photos') }}',
					type:'post',
					data:{"_token": "{{ csrf_token() }}", 'id': id, 'action': action, 'user_id': user_id, 'photo_user_id': photo_user_id},
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

	$(document).on("click", ".btn_read_delete_notifications", function() {
		var notification_type = '0';
		var user_id = '0';
		var action = $(this).attr('data-action');
		var id = $(this).attr('data-id');
		notification_type = $(this).attr('data-type');
		user_id = $(this).attr('data-user-id');
		$.ajax({
			url:'{{ url('update_delete_notifications') }}',
			type:'post',
			data:{"_token": "{{ csrf_token() }}", 'action': action, 'id': id},
			dataType:'json',
			success:function(status){
				if(action == 'read_one'){
					if(notification_type == '4'){
						setTimeout(function(){
							window.location.href = '{{ url('chat') }}?q='+user_id;
						}, 100);
					} else if (notification_type == '5') {
						setTimeout(function(){
							window.location.href = '{{ url('requests') }}';
						}, 100);
					} else if (notification_type == '1') {
						setTimeout(function(){
							window.location.href = '{{ url('public_profile') }}/'+user_id;
						}, 100);
					} else {
						setTimeout(function(){
							location.reload(true);
						}, 100);
					}
				}else{
					setTimeout(function(){
						location.reload(true);
					}, 100);
				}
			}
		});
	});

	$(document).on("click" , ".btn_delete_chat" , function() {
		var id = $(this).attr('data-id');
		swal({
			title: "Are you sure?",
			text: "You want to delete chat!",
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
					url:'{{ url('delete_user_chats') }}',
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

	$(document).on("click" , ".btn_report_user_modalbox" , function() {
		var id = $(this).attr('data-id');
		$("#report_user_id").val(id);
		$('#report_user_modalbox').modal('show');
	});
</script>
<script>
	$(document).on("click" , ".btn_report_user" , function() {
		$(".btn_report_user").text('Please wait...');
		$(".btn_report_user").prop('disabled', 'true');
		var formData =  new FormData($("#report_user_form")[0]);
		$.ajax({
			url:'{{ url('add_remover_user_configuration') }}',
			type: 'POST',
			data: formData,
			dataType:'json',
			cache: false,
			contentType: false,
			processData: false,
			success:function(status){
				if(status.msg=='success') {
					$('.btn_report_user').prop("disabled", false);
					$(".btn_report_user").text('Report User');
					toastr.success(status.response,"Success");
					$('#report_user_form')[0].reset();
					setTimeout(function(){
						location.reload(true);
					}, 2000);
				} else if(status.msg == 'error') {
					$(".btn_report_user").prop('disabled', false);
					$(".btn_report_user").text('Report User');
					toastr.error(status.response,"Error");
				} else if(status.msg == 'lvl_error') {
					$(".btn_report_user").prop('disabled', false);
					$(".btn_report_user").text('Report User');
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
@stack('scripts')