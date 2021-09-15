@component('mail::message')
# {{ $details['title'] }}

{{ $details['body'] }}

@component('mail::button', ['url' => $details['link']])
Register
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
