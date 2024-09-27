@extends('app')
@section('content')
<div class="breadcrumb-area">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="breadcrumb_box text-center">
					<h2 class="breadcrumb-title">Reset Password</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="site-wrapper-reveal">

	<div class="contact-us-section-wrappaer section-space--pt_100 section-space--pb_70">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3 col-lg-3"></div>
				<div class="col-lg-6 col-lg-6">
					<div class="contact-form-wrap">
						@if(session()->has('success'))
						<div class="ht-message-box style-success  mb-30" role="alert">
							<span class="icon"><i class="far fa-check-circle"></i></span> {{ session()->get('success') }}<br>
						</div>
						@endif

						@if($errors->any())
						<div class="ht-message-box style-error  mb-30" role="alert">
							@foreach($errors->all() as $error)
							<span class="icon"><i class="far fa-times-circle"></i></span> {{ $error }}<br>
							@endforeach
						</div>
						@endif
						<form method="POST" action="{{ url('reset_password') }}" id="submit_form">
							@csrf
							<input type="hidden" name="token" value="{{ $token }}">
							<div class="contact-form">
								<div class="contact-inner">
									<input type="password" name="password" placeholder="Enter new password">
								</div>
								<div class="d-grid gap-2">
									<button class="btn btn-primary" type="submit">Reset Password</button>
								</div>
							</div>
						</form>
						{{-- <hr>
						<ul class="footer-widget__list">
							<li><a href="{{ url('login') }}" class="hover-style-link text-color-primary"> Go to Login. </a></li>
						</ul> --}}
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
@push('scripts')

@endpush