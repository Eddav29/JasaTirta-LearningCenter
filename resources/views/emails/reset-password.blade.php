@component('mail::message')
# Reset Password

Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.

@component('mail::button', ['url' => $actionUrl])
Reset Password
@endcomponent

Link reset password ini akan kadaluarsa dalam {{ $count }} menit.

Jika Anda tidak meminta reset password, tidak ada tindakan lebih lanjut yang diperlukan.

Terima kasih,<br>
{{ config('app.name') }}

@component('mail::subcopy')
Jika Anda kesulitan mengklik tombol "Reset Password", salin dan tempel URL berikut ke browser web Anda: [{{ $actionUrl }}]({{ $actionUrl }})
@endcomponent
@endcomponent