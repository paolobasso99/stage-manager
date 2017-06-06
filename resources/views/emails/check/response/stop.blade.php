@component('mail::message')

The website {{ $site->url }} does not respond from {{ $site->response_down_from }}.
This is the last warning email.

@component('mail::button', ['url' => route('voyager.sites.show', $site)])
Manage site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
