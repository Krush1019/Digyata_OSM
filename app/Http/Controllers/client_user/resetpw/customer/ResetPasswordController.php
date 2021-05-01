<?php

namespace App\Http\Controllers\client_user\resetpw\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;


class ResetPasswordController extends Controller
{

  use ResetsPasswords;



/**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:customer');
    }


    public function showResetForm(Request $request, $token = null)
    {
        return view('/auth/passwords/customer/reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'sUserEmail', 'password', 'password_confirmation', 'token'
        );
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'sUserEmail' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }

    public function broker()
    {
        return Password::broker('customer');
    }
    protected function guard()
    {
        return Auth::guard('customer');
    }
}
