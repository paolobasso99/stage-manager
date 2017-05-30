@component('mail::message')

The SSL certificate of the website {{ $site->url }} does not respond.

@component('mail::button', ['url' => route('voyager.sites.show', $site)])
Manage site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
