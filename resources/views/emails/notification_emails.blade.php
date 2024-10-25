<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>{{ get_section_content('project', 'site_title') }}</title>
</head>
<body>
	<div class="content">
		<h3>Hello {{ $user['username'] }},</h3>
		<span>{{$user['inner_text']}} ({{ get_section_content('project', 'site_title') }}).</span><br>
		<span>Thank you!</span><br>
		<span><a href="{{ url('/') }}">Visit site</a></span>
	</div>
</body>
</html>
