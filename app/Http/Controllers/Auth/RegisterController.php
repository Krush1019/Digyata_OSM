<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\client_user\ClientManage;
use App\client_user\UserManage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
     protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
        $this->middleware('guest:client');
        $this->middleware('guest:customer');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:Users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // Register
    public function showRegistrationForm(){
      $pageConfigs = [
          'bodyClass' => "bg-full-screen-image",
          'blankPage' => true
      ];

      return view('/auth/register', [
          'pageConfigs' => $pageConfigs
      ]);
    }

    /**
     *  CLIENT REGISTER
     */
    public function showClientRegisterForm() {
        return view('pages.client_user.client-register');
    }

    protected function createClient(Request $request) {
        $request->validate([
            'captcha' => ['required','captcha'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\client_user\ClientManage,sClEmail'],
            'mobile' => ['required', 'numeric', 'digits:10'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        // $this->validator($request->all())->validate();
        ClientManage::create([
            'sClName' => $request->name,
            'sClEmail' => $request->email,
            'sClMobile' => $request->mobile,
            'sClGender' => $request->gender,
            'sClAddress' => $request->address,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->intended(route('login-page'));
    }


    /**
     *  CUSTOMER REGISTER
     */

    public function showCustomerRegisterForm() {
        return view('pages.client_user.user-register');
    }

    protected function createCustomer(Request $request) {
        $request->validate([
            'captcha' => ['required','captcha'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\client_user\UserManage,sUserEmail'],
            'mobile' => ['required', 'numeric', 'digits:10'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        // $this->validator($request->all())->validate();

        UserManage::create([
            'sUserName' => $request->name,
            'sUserEmail' => $request->email,
            'sUserMobile' => $request->mobile,
            'sUserGender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->intended(route('login-page'));
    }

}
