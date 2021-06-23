@component('mail::message')
    # {{ $details['title'] }}

    {{ $details['body'] }}

    {{ $ad->body }}


    Thanks,
    {{ config('app.name') }}
@endcomponent
