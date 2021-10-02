@component('mail::message')
# Halo {{ $user->name }}

Selamat datang.

Anda telah diundang oleh Admin untuk masuk platform.
Berikut data akun Anda:

@component('mail::panel')
Username: {{ $user->email }} <br>
Password: {{ $pwd }}
@endcomponent

@component('mail::button', ['url' => route('dashboard.index')])
LOGIN
@endcomponent

Terima kasih,<br>
{{ config('app.name') }}
@endcomponent
