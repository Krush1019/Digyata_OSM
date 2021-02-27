<?php

namespace App\Http\Controllers\client_user;

use App\client_user\UserDashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('/pages/client_user/user-dashboard');
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
     * @param  \App\client_user\UserDashboard  $userDashboard
     * @return \Illuminate\Http\Response
     */
    public function show(UserDashboard $userDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client_user\UserDashboard  $userDashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDashboard $userDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client_user\UserDashboard  $userDashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserDashboard $userDashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client_user\UserDashboard  $userDashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDashboard $userDashboard)
    {
        //
    }
}
