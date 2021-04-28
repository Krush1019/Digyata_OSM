<?php

namespace App\Http\Controllers\client_user\resetpw\client;

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
    protected $redirectTo = '/client-dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:client');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('/auth/passwords/client/reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function credentials(Request $request)
    {
        return $request->only(
            'sClEmail', 'password', 'password_confirmation', 'token'
        );
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'sClEmail' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function broker()
    {
        return Password::broker('client');
    }
    protected function guard()
    {
        return Auth::guard('client');
    }
}
