@component('mail::message')

Hello {{ $user->name }}, click on the button below to reset your password

{{-- {{ $user->remember_token }} --}}

@component('mail::button',['url' => route('account.resetPassword', ['token' => $user->remember_token])])
  Reset Your Password
@endcomponent

<p>In case you have any issues recovering your password, please contact us.</p>

From,<br>
{{ config('app.name') }}

@endcomponent