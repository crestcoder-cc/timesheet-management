@component('mail::message')
# Hello {{ $details['name'] }},
{{$details['mail_title']}}
@component('mail::button', ['url' => $details['actionUrl']])
Reset Password
@endcomponent
Thanks
@endcomponent
