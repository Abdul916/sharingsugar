<h3>Hi <a href="mailto:{{ $data['user']['email'] }}">{{ $data['user']['email'] }}</a>,</h3>
<p>
    This notice confirms that your password was changed on {{ get_section_content('project', 'site_title') }}.
</p>

<p>
    If you did not change your password, please contact the Site Administrator at <a href="mailto:{{ get_section_content('project', 'admin_email') }}">{{ get_section_content('project', 'admin_email') }}</a>.
</p>
<p>
    This email has been sent to <a href="mailto:{{ $data['user']['email'] }}">{{ $data['user']['email'] }}</a>.
</p>

<p>
    Regards,<br>
    All at {{ get_section_content('project', 'site_title') }}<br>
    <a href="{{ url('/') }}">{{ url('/') }}</a>.
</p>
