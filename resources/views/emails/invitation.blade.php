@component('mail::message')
# {{ $details['title'] }}

{{ $details['body'] }}

@component('mail::button', ['url' => $details['link']])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
