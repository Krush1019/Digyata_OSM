<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Exception;
use Illuminate\Support\Str;
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

    public function redirectToProvider($role)
    {
        session(['role' => $role]);
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
            if (session()->get('role') == "client") {
                return $this->findOrCreateRole($user, ClientManage::class, 'client');
            } else {
                return $this->findOrCreateRole($user, UserManage::class, 'customer');
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
            $tbl = new UserManage();
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

    private function findOrCreateRole($user, $RoleManage, $guard)
    {
        $findUser = $RoleManage::where('google_id', $user->id)->first();
        if (!$findUser) {
            $findUser = $RoleManage::where((($guard == 'client') ? 'sClEmail' : 'sUserEmail'), $user->email)->first();
            if ($findUser) {
                $RoleManage::where('id', $findUser->id)->update([
                    "google_id" => $user->id
                ]);
            } else {
                if ($guard == "client") {
                    $array = [
                        'sClientID' => $this->getGenerateID("sClientID"),
                        'sClName' => $user->name,
                        'sClEmail' => $user->email,
                        'google_id' => $user->id,
                        'password' => Hash::make(Str::random(24)),
                    ];
                } else {
                    $array = [
                        'sUserID' => $this->getGenerateID("sUserID"),
                        'sUserName' => $user->name,
                        'sUserEmail' => $user->email,
                        'google_id' => $user->id,
                        'password' => Hash::make(Str::random(24)),
                    ];
                }
                $findUser = $RoleManage::create($array);
                Auth::guard($guard)->login($findUser);
            }
            return redirect()->intended(route('home'));
        }
        Auth::guard($guard)->login($findUser);
        if ($guard == 'client') {
            return redirect()->intended(route('client-dashboard'));
        } else {
            return redirect()->intended(route('home'));
        }
    }
}
