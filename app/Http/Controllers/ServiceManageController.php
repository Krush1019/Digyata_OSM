<?php

namespace App\Http\Controllers;

use App\ServiceManage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceManageController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $breadcrumbs = [['link' => "admin-dashboard", 'name' => "Home"], ['name' => "Service Manage"]];
        return view('/pages/service-manage', [
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
     * @param  \App\ServiceManage  $serviceManage
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceManage $serviceManage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ServiceManage  $serviceManage
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceManage $serviceManage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ServiceManage  $serviceManage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceManage $serviceManage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ServiceManage  $serviceManage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceManage $serviceManage)
    {
        //
    }
}
