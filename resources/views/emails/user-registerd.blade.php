

@component('mail::message')
# Welcome to Digyata

Dear {{$name}},

Congratulations! You have successfully registered on Digyata.

In case you'd need any support, you can write to <a href="mailto:digyata125@gmail.com">support@digyata.com</a>.

@component('mail::button', ['url' => '', 'color' => 'success'])
Visit To Digyata
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
