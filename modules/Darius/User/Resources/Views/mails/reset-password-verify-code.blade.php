@component('mail::message')
# Your Password Reset Code

This Mail sent for the reason your Password Reset.
**If You haven't Requested Prevent This Mail.**

@component('mail::panel')
Password Reset Code : {{  $code  }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
