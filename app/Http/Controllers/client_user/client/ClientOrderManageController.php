<?php

namespace App\Http\Controllers\client_user\client;

use App\client_user\client\ClientOrderManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientOrderManageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $breadcrumbs = [['link' => "/client-dashboard", 'name' => "Dashboard"], ['name' => "Order Manage"]];
    return view('/pages/client_user/client/client-order-manage', [
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
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param \App\client_user\client\ClientOrderManage $clientOrderManage
   * @return \Illuminate\Http\Response
   */
  public function show(ClientOrderManage $clientOrderManage)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\client_user\client\ClientOrderManage $clientOrderManage
   * @return \Illuminate\Http\Response
   */
  public function edit(ClientOrderManage $clientOrderManage)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param \App\client_user\client\ClientOrderManage $clientOrderManage
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, ClientOrderManage $clientOrderManage)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\client_user\client\ClientOrderManage $clientOrderManage
   * @return \Illuminate\Http\Response
   */
  public function destroy(ClientOrderManage $clientOrderManage)
  {
    //
  }
}
