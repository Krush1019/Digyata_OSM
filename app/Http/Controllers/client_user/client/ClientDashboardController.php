<?php

namespace App\Http\Controllers\client_user\client;

use App\client_user\client\ClientDashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $breadcrumbs = [['link' => "/client-dashboard", 'name' => "Dashboard"],['name' => "My Dashboard"]];
      return view('/pages/client_user/client/client-dashboard', [
        'breadcrumbs' => $breadcrumbs
      ]);

//      return view('/pages/client_user/client/client-dashboard');
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
     * @param  \App\client_user\client\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function show(ClientDashboard $clientDashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client_user\client\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientDashboard $clientDashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client_user\client\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientDashboard $clientDashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client_user\client\ClientDashboard  $clientDashboard
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientDashboard $clientDashboard)
    {
        //
    }
}
