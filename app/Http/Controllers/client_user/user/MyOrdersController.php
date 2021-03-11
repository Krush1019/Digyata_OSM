<?php

namespace App\Http\Controllers\client_user\user;

use App\client_user\user\MyOrders;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/pages/client_user/user/my-order');
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
     * @param  \App\client_user\user\MyOrders  $myOrders
     * @return \Illuminate\Http\Response
     */
    public function show(MyOrders $myOrders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\client_user\user\MyOrders  $myOrders
     * @return \Illuminate\Http\Response
     */
    public function edit(MyOrders $myOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\client_user\user\MyOrders  $myOrders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MyOrders $myOrders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\client_user\user\MyOrders  $myOrders
     * @return \Illuminate\Http\Response
     */
    public function destroy(MyOrders $myOrders)
    {
        //
    }
}
