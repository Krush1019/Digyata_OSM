<?php

namespace App\Http\Controllers\client_user\client;

use Auth;

use App\ServiceList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\client_user\OrderManage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\client_user\client\ClientDashboard;

class ClientDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware("auth:client");
    }
     
    public function index()
    {
        $id = Auth::guard('client')->user()->id;
        $countService = ServiceList::where('client_id', $id)->count();
        $countOrder = OrderManage::where('client_id', $id)->count();
        $countReview = DB::table('tbl_ser_list') 
        ->join('tbl_review_orders', "tbl_review_orders.ser_id" , '=', 'tbl_ser_list.ser_id')
        ->where('client_id', $id)
        ->whereDate('tbl_review_orders.created_at', '>=' , Carbon::now()->subDays(5))
        ->count();
        
      $breadcrumbs = [['link' => "/client-dashboard", 'name' => "Dashboard"],['name' => "My Dashboard"]];
      return view('/pages/client_user/client/client-dashboard', [
        'breadcrumbs' => $breadcrumbs,
        'countService' => $countService,
        'countOrder' => $countOrder,
        'countReview' => $countReview,
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
