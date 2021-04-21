<?php

namespace App\Http\Controllers;

use App\ReviewOrders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReviewOrdersController extends Controller {
    public function __construct() {
      $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $breadcrumbs = [['link' => "admin-dashboard", 'name' => "Home"], ['name' => "Review Order"]];
      return view('/pages/review-order', [
        'breadcrumbs' => $breadcrumbs
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReviewOrders  $reviewOrders
     * @return \Illuminate\Http\Response
     */
    public function show(ReviewOrders $reviewOrders, Request $request) {
      $reviews = DB::table('tbl_review_orders')
                ->join('tbl_ser_list', 'tbl_ser_list.ser_id', '=', 'tbl_review_orders.ser_id')
                ->join('tbl_client_manage', 'tbl_client_manage.id', '=', 'tbl_ser_list.client_id')
                ->join('tbl_user_manage', 'tbl_user_manage.id', '=', 'tbl_review_orders.uID')
                ->select('ser_pro_name',DB::raw('(Res_R1+Ser_R2+Com_R3+Price_R4)/4 as rating'),'sClientID','sUserID','Feedback')
                ->take(200)
                ->get();

      $newData = []; $i = 0;
      foreach ($reviews as $user) {
        $arr = array(
          
          'service-name' => $user->ser_pro_name,
          'clientId'=> '#' . $user->sClientID,
          'userId'=> '#' . $user->sUserID,
          'rating' => $user->rating,
          'feedback' => $user->Feedback,
        );
        $newData[$i] = $arr;
        $i++;
      }
      return json_encode($newData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReviewOrders  $reviewOrders
     * @return \Illuminate\Http\Response
     */
    public function edit(ReviewOrders $reviewOrders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReviewOrders  $reviewOrders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReviewOrders $reviewOrders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReviewOrders  $reviewOrders
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReviewOrders $reviewOrders)
    {
        //
    }
}
