@component('mail::message')
<p>Welcome to Afotracx! Your Timesheet Management Just Got Easier</p>
<p>Hi {{ $details['name'] }},</p><br>
<p>We’re thrilled to welcome you to Afotracx! Your profile has been successfully created, and you're ready to dive into effortless timesheet management.</p>
<p>Login Details:</p><br>
<b>Login Url :</b> <a href="{{$details['login_url']}}" target="_blank">{{ $details['login_url'] }}</a><br>
<b>Login Email : </b>{{ $details['email'] }}<br>
<b>Login Password :</b> {{ $details['password'] }}<br><br>
<p>If you need any assistance, our support team is here for you.</p><br>
<p>Welcome aboard!</p><br>
<p>Best regards,</p><br>
<p>The Afotracx Team</p>
@endcomponent
