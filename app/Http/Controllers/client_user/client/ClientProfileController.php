<?php

namespace App\Http\Controllers\client_user\client;

use App\client_user\client\ClientProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientProfileController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware("auth:client");
    }
    public function index() {
      $breadcrumbs = [['link' => "/client-dashboard", 'name' => "Dashboard"], ['name' => "My Profile"]];
      return view('/pages/client_user/client/client-profile', [
        'breadcrumbs' => $breadcrumbs
      ]);
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
     * @param  \App\client_user\client\ClientProfile  $clientProfile
     * @return \Illuminate\Http\Response
     */
    public function show(ClientProfile $clientProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client_user\client\ClientProfile  $clientProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientProfile $clientProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client_user\client\ClientProfile  $clientProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientProfile $clientProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client_user\client\ClientProfile  $clientProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientProfile $clientProfile)
    {
        //
    }
}
