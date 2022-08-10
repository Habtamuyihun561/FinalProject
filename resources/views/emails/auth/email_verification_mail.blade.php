@component('mail::message')

Hello {{$user->name}}

@component('mail::button', ['url' => ''])
Click Hear to Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
