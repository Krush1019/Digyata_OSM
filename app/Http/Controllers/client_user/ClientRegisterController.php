<?php

namespace App\Http\Controllers\client_user;

use App\client_user\ClientRegister;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('/pages/client_user/client-register');
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
     * @param  \App\client_user\ClientRegister  $clientRegister
     * @return \Illuminate\Http\Response
     */
    public function show(ClientRegister $clientRegister)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client_user\ClientRegister  $clientRegister
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientRegister $clientRegister)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client_user\ClientRegister  $clientRegister
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientRegister $clientRegister)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client_user\ClientRegister  $clientRegister
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientRegister $clientRegister)
    {

    }
}
