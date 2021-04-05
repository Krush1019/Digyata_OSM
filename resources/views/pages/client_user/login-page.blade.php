@extends('layouts.client_user.fullLayoutMaster')

@section('title', 'Login Page')

@section('specific-style')
<link href="{{ asset('client_user/css/detail-page.css') }}" rel="stylesheet">
<link href="{{asset('client_user/css/submit.css')}}" rel="stylesheet">
<link href="{{asset('client_user/css/account.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{ asset('client_user/css/custom.css') }}" rel="stylesheet">
@endsection

@section('header-class', 'header header_in shadow clearfix')

@section('header')
@include('panels.client_user.header')    
@endsection

@section('content')
<div class="bg_gray pattern_mail">
      <div id="login" class="container position-relative w-100 bg-transparent min-h-none">
            <div class="row justify-content-center">
                  <div class="col-xl-4 col-md-5 col-sm-7">
                        <div class="box_general pt-5 mb-0 padding">

                              <div class="radio_select type">
                                    <ul>
                                          <li class="w-49">
                                                <a id="radio_user" name="radio_user">
                                                      <label for="radio_user" class="selected"> <i class="icon-users"></i> User</label>
                                                </a>
                                          </li>
                                          <li class="w-49">
                                                <a id="radio_client" name="radio_client">
                                                      <label for="radio_client"><i
                                                                  class="fa fa-users pb-1"></i>Client</label>
                                                </a>
                                          </li>
                                    </ul>
                              </div>
                                   
                              <form id="login-form" method="POST" class="mt-3" action="@if ($errors->all() && session()->has('passlink')) 
                                    {{session()->get('passlink')}}
                                    @else
                                    {{route('login.customer')}}
                                    @endif">
                                    @csrf
                                    <div class="main_title center">
                                          <p>Login as a Customer</p>
                                    </div>
                                    <div class="form-group">
                                          <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" id="email"  value="{{ old('email') }}" required placeholder="Email">
                                          <i class="icon_mail_alt"></i>
                                          @error('email')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                    </div>
                                    <div class="form-group">
                                          <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="password" required placeholder="Password">
                                          <i class="icon_lock_alt"></i>
                                          @error('password')
                                          <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                          </span>
                                          @enderror
                                    </div>
                                    <div class="clearfix add_bottom_30">
                                          <div class="checkboxes float-left">
                                                <label class="container_check">Remember me
                                                      <input type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                                      <span class="checkmark"></span>
                                                </label>
                                          </div>
                                          <div class="float-right"><a id="forgot" href="javascript:void(0);">Forgot
                                                      Password?</a></div>
                                    </div>
                                    <button type="submit" class="btn_1 full-width">Login to Digyata</button>
                                    <div class="text-center add_top_10">New to Digyata? <strong><a
                                                      href="{{route('customer.register')}}">Sign up!</a></strong></div>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
      <!-- /container -->
</div>
@endsection

@section('page-script')
<script src="{{ asset('client_user/js/UI/login-page.js') }}"></script>
@endsection