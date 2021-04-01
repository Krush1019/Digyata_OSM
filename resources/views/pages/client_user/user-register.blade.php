@extends('layouts.client_user.fullLayoutMaster')

@section('title', 'User Register')

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
        <a href="{{route('index-page')}}"><img src="{{asset('client_user/img/logo.svg')}}" width="150" height="35" alt="" class="logo_sticky"></a>
      </figure>

      <form autocomplete="off" id="User-register" method="POST" action="{{ route('register.customer') }}">
        @csrf      
          <div class="form-group">
            <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Name" value="{{ old('name') }}" name="name" id="User_name">
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
            <i class="icon_pencil-edit"></i>
          </div>
        <div class=" form-group">
          <span class="mr-3">
            <label for="gender" class="">Gender:</label>
          </span>
          <span class="mr-2">
            <input type="radio" name="gender" value="male" checked>
            <label> Male</label>
          </span>
          <span class="mr-2">
            <input type="radio" name="gender" value="female">
          <label> Female</label>
          </span>
        </div>
        <div class="form-group">
          <input class="form-control @error('email') is-invalid @enderror" type="email" placeholder="Email" value="{{ old('email') }}" name="email" id="User_email">
          @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          <i class="icon_mail_alt"></i>
        </div>
        <div class="form-group">
          <input type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile No." value="{{ old('mobile') }}" name="mobile" id="User_mobile">
          @error('mobile')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          <i class="icon_mobile"></i>
        </div>
        <div class="form-group">
          <input class="form-control new-password @error('password') is-invalid @enderror" type="password" id="User_password" name="password" placeholder="Password">
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          <i class="icon_lock_alt"></i>
        </div>
        <div class="form-group">
          <input class="form-control cnfm-new-password" type="password" id="User_cnf_password" name="password_confirmation"
                 placeholder="Confirm Password">
          <i class="icon_lock_alt"></i>
        </div>
        <div id="pass-info" class="clearfix"></div>
        <div class="row">
          <div class="col-sm-5 ">
            <div class="form-group">
              <input type="text" id="captcha_register" class="form-control @error('captcha') is-invalid @enderror" placeholder="Enter Captcha" name="captcha" id="User_captcha">
              @error('captcha')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
            </div>
          </div>
          <div class="captcha col-sm-7">
            <span>{!! captcha_img() !!}</span>
            <button type="button" class="btn btn-danger" class="reload" id="reload">&#x21bb;</button>
          </div>
        </div>

        <button type="submit" id="us_sub_btn" class="btn_1 rounded full-width">Register Now!</button>
        <div class="text-center add_top_10">Already have an acccount? <strong><a id="URGLink" href="{{route('login-page')}}">Sign In</a></strong>
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
