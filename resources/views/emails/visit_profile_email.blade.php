<h3>Hello {{ $data['vuser']['username'] }},</h3>
<p>{{ Auth::user()->username }} just visit your profile</p>
<a href="{{ url('public_profile') }}/{{ Auth::user()->unique_id }}" target="_blank" title="Visit Profile" class="custom-button">  Visit Profile</a>
<p>If you have any questions, please do not hesitate to contact us. You can refer to our contact page here:</p>
<a href="{{ url('contact_us') }}" target="_blank" title="Contact Us" class="custom-button">Contact Us</a>
<p>Thankyou!</p>
