<h3>Hello, {{ $data['iam'] }}</h3>
Please use the following password to activate your account on {{ get_section_content('project', 'site_title') }}: {{ $data['password'] }}
<br>
<a href="{{ url('login') }}"> Click Here For Login</a>.
<h1>{{ get_section_content('project', 'site_title') }}</h1>
<h4>Thank you!</h4>