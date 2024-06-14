@component('mail::message')
Hi {{ $details['name'] }},
<p>Welcome to Timesheet Management!</p>
<p>Your Registration as successfully</p>
Login Url : {{ $details['login_url'] }},<br>
Login Email : {{ $details['email'] }},<br>
Login Password : {{ $details['password'] }},<br><br>
Warm regards,<br>
The Timesheet Management Team
@endcomponent
