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
@include('panels.client_user.client.styles')

</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
{{-- Include naviation bar --}}
@include('panels.client_user.client.navbar')
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
{{-- Include breadcrumb --}}
      @include('panels.client_user.client.breadcrumb')

{{-- Include Content --}}
@yield('content')

    </div>
    <!-- /.container-fluid-->
  </div>
  <!-- /.container-wrapper-->
{{-- Include footer --}}
  @include('panels.client_user.client.footer')

  <!-- Scroll to Top Button-->
  <a class=" scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

{{-- Include core speccific and custom script --}}
@include('panels.client_user.client.scripts')

</body>
</html>


