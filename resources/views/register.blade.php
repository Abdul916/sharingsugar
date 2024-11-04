<!DOCTYPE html>
<html lang="en">
<head>
	@include('common.styles')
	<title>Sign up &#8211; {{ get_section_content('project', 'site_title') }}</title>
</head>
<body>
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<section class="log-reg">
		<div class="top-menu-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-5">
						<a href="{{ url('/') }}" class="backto-home"><i class="fas fa-chevron-left"></i> Back to {{ get_section_content('project', 'site_title') }}</a>
					</div>
					<div class="col-lg-7">

					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row justify-content-end">
				<div class="image">
				</div>
				<div class="col-lg-7">
					<div class="log-reg-inner">
						<div class="mb-lg-0 mb-5" style="text-align: center;">
							<a href="{{ url('/') }}">
								<div class="logo">
									<img src="{{ asset('assets/images/logo2.png') }}" alt="logo" style="width: 200px;">
								</div>
							</a>
						</div>
						<div class="section-header inloginp">
							<h2 class="title">
								Welcome to {{ get_section_content('project', 'site_title') }}
							</h2>
							<p>
								Let's create your profile! Just fill in the fields below, and
								we’ll get a new account.
							</p>
						</div>
						<div class="main-content">
							<h4 class="content-title">Create your Account</h4>
							<form id="add_form" method="post" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<label for="">I am*</label>
									<div class="option">
										<div class="s-input mr-3">
											<input type="radio" name="financial_support" id="give_support" value="1" checked><label for="give_support">Willing to give financial support</label>
										</div>
										<div class="s-input">
											<input type="radio" name="financial_support" id="need_support" value="2"><label for="need_support">I need financial support</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="">Interested in*</label>
									<div class="option">
										<div class="s-input mr-3">
											<input type="radio" name="interested_in" id="females" value="2" checked><label for="females">Female</label>
										</div>
										<div class="s-input mr-3">
											<input type="radio" name="interested_in" id="males" value="1"><label for="males">Male</label>
										</div>
										<div class="s-input">
											<input type="radio" name="interested_in" id="trans" value="3"><label for="trans">Trans</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="">Email Address*</label>
									<input type="text" name="email" class="my-form-control" placeholder="Enter Your Email">
								</div>
								<div class="button-wrapper">
									<button type="button" class="custom-button btn_save">Sign Up</button>
								</div>
								<div class="or"><p>OR</p></div>
								<div class="or-content">
									{{-- <p>Sign up with your email</p> --}}
									{{-- <a href="#" class="or-btn"><img src="{{ asset('assets/images/google.png') }}" alt=""> Sign Up with Google</a> --}}
									<p class="or-signup">
										Already have an account? <a href="{{ url('login') }}"> Sign in here </a>
									</p>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<div class="modal fade" id="email-confirm" tabindex="-1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<div class="top-img">
						<img src="{{ asset('assets/images/c-image.png') }}" alt="">
					</div>
					<div class="main-content">
						<h4 class="title" id="response_head"></h4>
						<p id="response_msg"></p>
						{{-- <p class="send-again">
							Didn't get e-mail? <a href="#"> Send it again </a>
						</p> --}}
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	@include('common.scripts')

	<script>
		$(document).on("click" , ".btn_save" , function() {
			$(".btn_save").text('Please wait...');
			$(".btn_save").prop('disabled', 'true');
			var formData =  new FormData($("#add_form")[0]);
			$.ajax({
				url:'{{ url('register_new_users') }}',
				type: 'POST',
				data: formData,
				dataType:'json',
				cache: false,
				contentType: false,
				processData: false,
				success:function(status){
					if(status.msg=='success') {
						$('.btn_save').prop("disabled", false);
						$(".btn_save").text('Sign Up');
						$('#add_form')[0].reset();
						$("#response_head").html(status.response_head);
						$("#response_msg").html(status.response);
						$("#email-confirm").modal('show');
					} else if(status.msg == 'error') {
						$(".btn_save").prop('disabled', false);
						$(".btn_save").text('Sign Up');
						toastr.error(status.response,"Error");
					} else if(status.msg == 'lvl_error') {
						$(".btn_save").prop('disabled', false);
						$(".btn_save").text('Sign Up');
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
</body>
</html>