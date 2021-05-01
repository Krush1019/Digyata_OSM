<?php

namespace App\Http\Controllers\client_user\resetpw\customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{

use SendsPasswordResetEmails;

 public function __construct()
    {
        $this->middleware('guest:customer');
    }

    public function showLinkRequestForm(){

      return view('/auth/passwords/customer/forgot-password');
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    protected function validateEmail(Request $request)
    {
        $request->validate(['sUserEmail' => 'required|email']);
    }

    protected function credentials(Request $request)
    {
        return $request->only('sUserEmail');
    }
    public function broker()
    {
        return Password::broker('customer');
    }
}
