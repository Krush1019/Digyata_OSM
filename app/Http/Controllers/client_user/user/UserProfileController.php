<?php

namespace App\Http\Controllers\client_user\user;

use App\client_user\user\UserProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\client_user\UserManage;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Validation\Rule;
class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware("auth:customer");
    }


    public function index()
    {
        return view('/pages/client_user/user/user-profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\client_user\user\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client_user\user\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client_user\user\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, UserProfile $userProfile)
    {
        $user = Auth::user();
        $request->validate([
            'sUserName' => ['required', 'string', 'max:255'],
            'sUserEmail' => ['required', 'string', 'email', 'max:255', Rule::unique('tbl_user_manage')->ignore($user)],
            'sUserMobile' => ['required', 'numeric', 'digits:10'],
        ]);
        $tmp = $request->all();
        foreach ($tmp as $key => $value) {
            if(!$value || $key=="_token"){
                unset($tmp[$key]);
            }
        }
    // password checking open
            if ($request->oldpassword || $request->password || $request->password_confirmation) {
                        $request->validate([
                            'oldpassword' => ['required', 'string', 'min:6'],
                            'password' => ['required', 'string', 'min:6', 'confirmed']
                        ]);
                $user = Auth::user();

                    if (Hash::check($tmp['oldpassword'], $user->password)) {

                        $tmp['password'] = Hash::make($tmp['password']);

                    }else{

                        return back()->withErrors(['password' => 'Old Password Does not match with records.']);
                        unset($tmp['password']);

                    }

                    unset($tmp['oldpassword']);
                    unset($tmp['password_confirmation']);
                    
            }
    // password checking close
        $result = UserManage::where('id', Auth::guard('customer')->user()->id)->update($tmp);
        $request->session()->flash('status', 'Updated successfuliy!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client_user\user\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
}
