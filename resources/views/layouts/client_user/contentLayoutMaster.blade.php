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

<body>
{{-- include header --}}
@include('panels.client_user.header')

{{-- include content --}}
<!-- START: Main-->
@yield('content')
<!-- END: Main-->

{{-- include footer --}}
@include('panels.client_user.footer')

<div id="toTop"></div><!-- Back to top button -->

<div class="layer"></div><!-- Opacity Mask Menu Mobile -->


{{--Sign -login-modal--}}
{{-- <div class="modal fade" role="dialog" id="user-login-modal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h3>Sign In</h3>
        <button type="button" class="btn btn-outline-secondary float-right" data-dismiss="modal"><i class="icon_close"></i> </button>
      </div>
      <!-- Modal body -->
      <div class="modal-body container-fluid">
        <form id="signIn-form">
          <div>
            <a href="#0" class="social_bt facebook">Login with Facebook</a>
            <a href="#0" class="social_bt google">Login with Google</a>
            <div class="divider"><span>Or</span></div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="form-control" name="email" id="email" >
              <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" id="password">
              <i class="icon_lock_alt"></i>
            </div>
            <div class="clearfix add_bottom_15">
              <div class="checkboxes float-left">
                <label class="container_check">Remember me
                  <input type="checkbox">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="float-right mt-1"><a id="forgot" href="#forgot_pw">Forgot Password?</a></div>
            </div>
            <div class="text-center">
              <input type="submit" value="Log In" id="signIn-submit" class="btn_1 full-width mb_5">
              Don’t have an account? <a href="{{ route('user-register')}}" id="signup-link">Sign up</a>
            </div>
          </div>
        </form>
        <form id="forgot_pw-form" hidden="hidden">
            <div>
              <div class="form-group">
                <label>Please confirm login email below</label>
                <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                <i class="icon_mail_alt"></i>
              </div>
              <p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
              <div class="text-center"><input id="repasswdbtn" type="submit" value="Reset Password" class="btn_1"><button id="backlgbtn" class="btn_1 outline ml-2">Back To Login</button></div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div> --}}

{{-- include scripts --}}
@include('panels.client_user.scripts')

</body>
</html>

