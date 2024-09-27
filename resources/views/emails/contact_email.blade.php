<h3>Hello, Admin</h3>
{{ $data['name'] }} send contact us email from <a href="{{ url('/') }}"> {{ get_section_content('project', 'site_title') }}</a>.

<p>Email: {{ $data['email'] }}</p>
<p>Message: {{ $data['message'] }}</p>

<a href="{{ url('/') }}"> {{ get_section_content('project', 'site_title') }}</a>.
<h1>{{ get_section_content('project', 'site_title') }}</h1>
<h4>Thank you!</h4>