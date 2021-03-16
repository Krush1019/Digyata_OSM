@extends('layouts.client_user.fullLayoutMaster')

@section('title', 'Register')

@section('specific-style')
  <link href="{{asset('client_user/css/account.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
@endsection

@section('bodyId', 'register_bg')

@section('content')
  <nav id="menu" class="fake_menu"></nav>

  <div id="login">
    <aside>
      <figure class="px-0">
        <a href="{{route('index-page')}}"><img src="{{asset('client_user/img/logo.png')}}" width="250" height="80" alt="" class="logo_sticky"></a>
      </figure>
      <div class="access_social">
        <a href="#0" class="social_bt facebook">Register with Facebook</a>
        <a href="#0" class="social_bt google">Register with Google</a>
      </div>
      <div class="divider"><span>Or</span></div>
      <form autocomplete="off" id="User-register">
        <div class="row">
          <div class="form-group col-6">
            <input class="form-control" type="text" placeholder="First Name" name="User_fname" id="User_fname">
            <i class="icon_pencil-edit"></i>
          </div>
          <div class="form-group col-6">
            <input class="form-control" type="text" placeholder="Last Name" name="User_lname" id="User_lname">
            <i class="icon_pencil-edit"></i>
          </div>
        </div>
        <div class=" form-group">
          <span class="mr-3">
            <label for="User_gender" class="">Gender:</label>
          </span>
          <span class="mr-2">
            <input type="radio" name="User_gender" value="male" checked>
            <label> Male</label>
          </span>
          <span class="mr-2">
            <input type="radio" name="User_gender" value="female">
          <label> Female</label>
          </span>
        </div>
        <div class="form-group">
          <input class="form-control" type="email" placeholder="Email" name="User_email" id="User_email">
          <i class="icon_mail_alt"></i>
        </div>
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Mobile No." name="User_mobile" id="User_mobile">
          <i class="icon_mobile"></i>
        </div>
        <div class="form-group">
          <input class="form-control" type="password" id="User_password" name="User_password" placeholder="Password">
          <i class="icon_lock_alt"></i>
        </div>
        <div class="form-group">
          <input class="form-control" type="password" id="User_cnf_password" name="User_cnf_password"
                 placeholder="Confirm Password">
          <i class="icon_lock_alt"></i>
        </div>
        <div class="row">
          <div class="col-sm-5 ">
            <div class="form-group">
              <input type="text" id="captcha_register" class="form-control" placeholder="Enter Captcha"
                     name="User_captcha" id="User_captcha">
            </div>
          </div>
          <div class="captcha col-sm-7">
            <span>{!! captcha_img() !!}</span>
            <button type="button" class="btn btn-danger" class="reload" id="reload">&#x21bb;</button>
          </div>
        </div>
        <button type="submit" class="btn_1 rounded full-width">Register Now!</button>
        <div class="text-center add_top_10">Already have an acccount? <strong><a id="URGLink" href="/index">Sign In</a></strong>
        </div>
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
