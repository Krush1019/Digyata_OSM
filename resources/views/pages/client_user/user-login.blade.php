@extends('layouts.client_user.fullLayoutMaster')

@section('title', 'login')

@section('specific-style')
  <link href="{{asset('client_user/css/account.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('bodyId', 'login_bg')

@section('content')
  <div id="preloader">
    <div data-loader="circle-side"></div>
  </div>
  <!-- End Preload -->

  <div id="login">
    <aside>
      <figure class="px-0">
        <a href="{{route('index-page')}}"><img src="{{asset('client_user/img/logo.png')}}" width="250" height="80" alt="" class="logo_sticky"></a>
      </figure>
      <form>
        <div class="access_social">
          <a href="#0" class="social_bt facebook">Login with Facebook</a>
          <a href="#0" class="social_bt google">Login with Google</a>
        </div>
        <div class="divider"><span>Or</span></div>
        <div class="form-group">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email">
          <i class="icon_mail_alt"></i>
        </div>
        <div class="form-group">
          <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password">
          <i class="icon_lock_alt"></i>
        </div>
        <div class="clearfix add_bottom_30">
          <div class="checkboxes float-left">
            <label class="container_check">Remember me
              <input type="checkbox">
              <span class="checkmark"></span>
            </label>
          </div>
          <div class="float-right"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
        </div>
        <a href="#0" class="btn_1 full-width">Login to Digyata</a>
        <div class="text-center add_top_10">New to Digyata? <strong><a href="{{route('user-register')}}">Sign up!</a></strong></div>
      </form>
      <div class="copy">© 2021 Digyata</div>
    </aside>
  </div>
  <!-- /login -->

@endsection

@section('specific-script')
  <script src="{{asset('client_user/js/UI/user-register.js')}}"></script>
  <script src="{{asset('client_user/js/pw_strenght.js')}}"></script>
@endsection
