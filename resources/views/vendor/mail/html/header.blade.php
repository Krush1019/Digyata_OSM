<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('client_user/img/logo.svg') }}" class="logo" alt="Digyata Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
