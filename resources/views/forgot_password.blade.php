<!DOCTYPE html>
<html lang="en">
<head>
	@include('common.styles')
	<title>Forgot Password &#8211; {{ get_section_content('project', 'site_title') }}</title>
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
				<div class="image image-log"></div>
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
								To reset your account password, enter the email address you registered with and we will send your instructions on their way.
							</p>
						</div>
						<div class="main-content inloginp">
							<h4 class="content-title">Did you forget your password?</h4>
							@if(session()->has('success'))
							<div class="alert alert-success" role="alert">
								<span class="icon"><i class="far fa-check-circle"></i></span> {{ session()->get('success') }}<br>
							</div>
							@endif
							@if($errors->any())
							<div class="alert alert-danger" role="alert">
								@foreach($errors->all() as $error)
								<span class="icon"><i class="far fa-times-circle"></i></span> {{ $error }}<br>
								@endforeach
							</div>
							@endif
							<form method="POST" action="{{ url('forgot_password') }}" id="submit_form">
								@csrf
								<div class="form-group">
									<label for="">Email</label>
									<input type="text" name="email" class="my-form-control" placeholder="Enter Your Email">
								</div>
								<p class="f-pass">
									<a href="{{ url('login') }}"> Back to Login</a>
								</p>
								<div class="button-wrapper">
									<button type="submit" class="custom-button" name="disabled_btn">Recover Password</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@include('common.scripts')
</body>
</html>