@component('mail::message')
# Your Verify Code

This Mail sent for the reason your Registration.
**If You haven't Registration Prevent This Mail.**

@component('mail::panel')
verify Code : {{  $code  }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
