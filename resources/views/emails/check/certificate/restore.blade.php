@component('mail::message')

The SSL certificate of the website {{ $site->url }} is back online.

@component('mail::button', ['url' => route('voyager.sites.show', $site)])
Manage site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
