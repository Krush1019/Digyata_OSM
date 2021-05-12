<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Exception;
use App\Jobs\WelcomeMailJob;
use Illuminate\Http\Request;
use App\client_user\UserManage;
use App\client_user\ClientManage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
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
    protected $redirectTo = '/admin-dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
    protected function validator(array $data)
    {
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
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // Register
    public function showRegistrationForm()
    {
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
    public function showClientRegisterForm()
    {
        return view('pages.client_user.client-register');
    }

    protected function createClient(Request $request)
    {
        $request->validate([
            'captcha' => ['required', 'captcha'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\client_user\ClientManage,sClEmail'],
            'mobile' => ['required', 'numeric', 'digits:10'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        ClientManage::create([
            'sClientID' => $this->getGenerateID("sClientID"),
            'sClName' => $request->name,
            'sClEmail' => $request->email,
            'sClMobile' => $request->mobile,
            'sClGender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);
        if (Auth::guard('client')->attempt(['sClEmail' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            dispatch(new WelcomeMailJob($request->all()));
            return redirect()->intended(route('client-dashboard'));
        }
        return redirect()->intended(route('login-page'));
    }


    /**
     *  CUSTOMER REGISTER
     */

    public function showCustomerRegisterForm()
    {
        return view('pages.client_user.user-register');
    }

    protected function createCustomer(Request $request)
    {
        $request->validate([
            'captcha' => ['required', 'captcha'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:App\client_user\UserManage,sUserEmail'],
            'mobile' => ['required', 'numeric', 'digits:10'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        // $this->validator($request->all())->validate();

        UserManage::create([
            'sUserID' => $this->getGenerateID("sUserID"),
            'sUserName' => $request->name,
            'sUserEmail' => $request->email,
            'sUserMobile' => $request->mobile,
            'sUserGender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        if (Auth::guard('customer')->attempt(['sUserEmail' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended(route('home'));
        }
        return redirect()->intended(route('login-page'));
    }

    /**
     *  LOGIN & REGISTER WITH GOOGLE
     */

    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return \Illuminate\Http\Response
     */

    // GOOGLE -- CLIENT
    public function handleProviderCallbackClient()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = ClientManage::where('google_id', $user->id)->first();
            if ($findUser) {
                Auth::guard('client')->login($findUser);
                return redirect()->intended(route('home'));
            } else {
                $checkuser = ClientManage::where('sClEmail', $user->email)->first();
                if ($checkuser) {
                    ClientManage::where('id', $checkuser->id)->update([
                        "google_id" => $user->id
                    ]);
                    Auth::guard('customer')->login($checkuser);
                } else {
                    $newUser = ClientManage::create([
                        'sClientID' => $this->getGenerateID("sClientID"),
                        'sClName' => $user->name,
                        'sClEmail' => $user->email,
                        'google_id' => $user->id,
                        'password' => Hash::make('digit@l$@h@y@t@'),
                    ]);
                    Auth::guard('client')->login($newUser);
                    dispatch(new WelcomeMailJob($request->all()));
                }
                return redirect()->intended(route('home'));
            }
        } catch (Exception $e) {
            return redirect(route('login-page'));
        }
    }



    // GOOGLE -- CUSTOMER
    public function handleProviderCallbackCustomer()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = UserManage::where('google_id', $user->id)->first();
            if ($findUser) {
                Auth::guard('customer')->login($findUser);
                return redirect()->intended(route('home'));
            } else {
                $checkuser = UserManage::where('sUserEmail', $user->email)->first();
                if ($checkuser) {
                    UserManage::where('id', $checkuser->id)->update([
                        "google_id" => $user->id
                    ]);
                    Auth::guard('customer')->login($checkuser);
                } else {
                    $newUser = UserManage::create([
                        'sUserID' => $this->getGenerateID("sUserID"),
                        'sUserName' => $user->name,
                        'sUserEmail' => $user->email,
                        'google_id' => $user->id,
                        'password' => Hash::make('digit@l$@h@y@t@'),
                    ]);
                    Auth::guard('customer')->login($newUser);
                }
                return redirect()->intended(route('home'));
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            return redirect(route('login-page'));
        }
    }

    
    // Generate ID
    private function getGenerateID($col_name)
    {
        $temp = "GI-";
        if ($col_name == "sClientID") {
            $tbl = new ClientManage();
            $temp = "CI-";
        } else if ($col_name == "sUserID") {
            $tbl = new ClientManage();
            $temp = "UI-";
        }

        newGenerateID:
        $id = $temp . date('ym') . rand(100, 999);
        $count = $tbl->where($col_name, $id)->count();
        if ($count == 0)
            return $id;
        else
            goto newGenerateID;
    }
}
