@component('mail::message')
    {{-- create a forgot email password --}}

    Hello {{ $user->name }}
    <p>We understand It Happens</p>

    @component('mail::button', ['url' => url('reset/' . $user->remember_token)])
        Reset Your Password
    @endcomponent

    Thanks,
    {{ config('app.name') }}
@endcomponent
