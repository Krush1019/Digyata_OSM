@extends('layouts.client_user.fullLayoutMaster')

@section('title', 'Reset Password')

@section('specific-style')
<link href="{{ asset('client_user/css/detail-page.css') }}" rel="stylesheet">
<link href="{{asset('client_user/css/submit.css')}}" rel="stylesheet">
<link href="{{asset('client_user/css/account.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
<link href="{{asset('client_user/css/custom.css')}}" rel="stylesheet">
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
				<div class="box_general padding my-4 my-sm-5">
					<form id="reset-passwod-form" action="{{route('client.pwdreset')}}" method="POST" class="mt-3 mt-sm-2" action="">
						<div class="main_title center">
							<p>Reset Password</p>
						</div>
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
						<p>Please enter your new password.</p>
						<div class="form-group">
							<input type="email" class="form-control @error('email') is-invalid @enderror" value="{{$email}}" name="sClEmail" id="email" required
								placeholder="Email">
							<i class="icon_mail_alt"></i>
              @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
						</div>
						<div class="form-group">
							<input type="password" class="form-control @error('password') is-invalid @enderror"
								name="password" id="password" required placeholder="Password">
							<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							<i class="icon_lock_alt"></i>
							@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
							@enderror
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password_confirmation" id="cnf-password"
								required placeholder="Confirm Password">
							<i class="icon_lock_alt"></i>
						</div>
						<div class="mt-4">
							<button type="submit" class="btn_1 full-width float-right">Reset</button>
							<a href="{{ route('login-page') }}" class="btn_1 mt-2 outline full-width float-left">Back to
								Login</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /container -->
</div>
@endsection
