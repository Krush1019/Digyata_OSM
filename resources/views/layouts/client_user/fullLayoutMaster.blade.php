<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Digyata">
  <meta name="author" content="Team Digyata">
  <title>@yield('title') - Digyata</title>

  <!-- Favicons-->
  <link rel="shortcut icon" href="{{asset('client_user/img/logo-icon.ico')}}" type="image/x-icon">
  <link rel="apple-touch-icon" type="image/x-icon" href="{{asset('client_user/img/apple-touch-icon-57x57-precomposed.png')}}">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="{{asset('client_user/img/apple-touch-icon-72x72-precomposed.png')}}">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="{{asset('client_user/img/apple-touch-icon-114x114-precomposed.png')}}">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="{{asset('client_user/img/apple-touch-icon-144x144-precomposed.png')}}">

  {{-- Include core specific custom Styles --}}
  @include('panels.client_user.styles')

</head>

<body id="@yield('bodyId')">

{{-- include content --}}
@yield('content')

{{-- include scripts --}}
@include('panels.client_user.scripts')

</body>
</html>

