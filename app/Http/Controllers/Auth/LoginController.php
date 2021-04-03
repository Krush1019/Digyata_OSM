<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin-dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:client')->except('logout');
        $this->middleware('guest:customer')->except('logout');
    }

    // Login
    public function showLoginForm()
    {
        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true
        ];

        return view('/auth/login', [
            'pageConfigs' => $pageConfigs
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {

        $path = '/login';
        if (Auth::guard('client')->check()) {
            $path = route('home');
        }
        
        if (Auth::guard('customer')->check()) {
            $path = route('home');
        }

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect($path);
    }

    /**
     *  CLIENT LOGIN
     *
     * @return void
     */

    public function clientLogin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return back()
                ->with('passlink', route('login.client'))
                ->withErrors($validator)
                ->withInput($request->only('email', 'remember'));
        }

        /* $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]); */

        if (Auth::guard('client')->attempt(['sClEmail' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended(route('client-dashboard'));
        }
        return back()->with('passlink', route('login.client'))->withErrors(['email' => 'These credentials do not match our records.'])->withInput($request->only('email', 'remember'));
    }

    /**
     *  CUSTOMER LOGIN
     *
     * @return void
     */

    public function LoginPageForm()
    {
        return view('/pages/client_user/login-page');
    }



    public function customerLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('customer')->attempt(['sUserEmail' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended(route('index-page'));
        }
        return back()
        ->with('passlink', route('login.customer'))
        ->withErrors(['email' => 'These credentials do not match our records.'])
        ->withInput($request->only('email', 'remember'));
    }
}
