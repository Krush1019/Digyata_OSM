<?php

namespace App\Http\Controllers;

use App\ReviewOrders;
use Illuminate\Http\Request;

class ReviewOrdersController extends Controller
{
    public function __construct() {
      $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $tbl = new ReviewOrders();
        $tbl->BsID = 1;
        $tbl->ser_id = 1;
        $tbl->cl_ID = 1;
        $tbl->uID = 1;
        $tbl->ltFeedback = "very good";
        $tbl->iReview_Rating = 3;
        $tbl->iReview_Avg_Rating = 3.5;
        $tbl->bReview_Status = 1;
        $tbl->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReviewOrders  $reviewOrders
     * @return \Illuminate\Http\Response
     */
    public function show(ReviewOrders $reviewOrders, Request $request)
    {
//      $data = ReviewOrders::join('tbl_service_catalogs', 'tbl_review_orders.ser_id', '=', 'tbl_service_catalogs.id')
//        ->join('tbl_user_manage', 'tbl_review_orders.uID', '=', 'tbl_user_manage.uID')
//        ->join('tbl_client_manage', 'tbl_review_orders.cl_ID', '=', 'tbl_client_manage.cl_ID')
//        ->join('tbl_booking_schedule', 'tbl_review_orders.BsID', '=', 'tbl_booking_schedule.BsID')
//        ->orderBy('RoID', 'desc')
//        ->take(200)
//        ->get();

      $searchdata = ReviewOrders::join('tbl_service_catalogs', 'tbl_review_orders.ser_id', '=', 'tbl_service_catalogs.id')
        ->join('tbl_user_manage', 'tbl_review_orders.uID', '=', 'tbl_user_manage.uID')
        ->join('tbl_client_manage', 'tbl_review_orders.cl_ID', '=', 'tbl_client_manage.cl_ID')
        ->join('tbl_booking_schedule', 'tbl_review_orders.BsID', '=', 'tbl_booking_schedule.BsID')
        ->where('tbl_booking_schedule.sOrderId', 'like','%'.$request->text.'%')
        ->orWhere('tbl_user_manage.sUserID', 'like','%'.$request->text.'%')
        ->orWhere('tbl_client_manage.sClientID', 'like','%'.$request->text.'%')
        ->orderBy('RoID', 'desc')
        ->get();

      $newData = []; $i = 0;
      foreach ($searchdata as $user) {
        $arr = array(
          'order-id' => $user->sOrderId,
          'service-name' => $user->serviceName,
          "service-provider" => array('clientName'=>$user->sClName, "clientImg"=>$user->sClPhotoURL),
          "user-name" => array('userName'=>$user->sUserName, "userImg"=>$user->sUserImgURL),
          'rating' => $user->iReview_Rating,
          'feedback' => $user->ltFeedback,
          'avarage-rating' => $user->iReview_Avg_Rating,
          'review-status' => ($user->bReview_Status == 1)? "Good" : "Bad"
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

    public function search(Request $request, ReviewOrders $reviewOrder){
    $search = $request -> text;
    $col = $request -> action;
    $col2 = "";
    switch ($col){
      case 'order id':
        $col2 = 'oderId';
        break;
      case 'service provider':
        $col2 = 'sClientName';
        break;
      case 'user':
        $col2 = 'sUserName';
        break;
    }
    $data = ReviewOrders:: where($col2, '=', $search)->get();
    $newData = [];
    $i = 0;
    foreach ($data as $user) {
      $id = ($user->oderId);
      $arr = array(
        'order-id' => $id,
        'service-name' => $user->sServiceName,
        'rating' => $user->iReview_Rating,
        'service-provider' => $user->sClientName,
        'user-name' => $user->sUserName,
        'feedback' => $user->ltFeedback,
        'avarage-rating' => $user->iReview_Avg_Rating,
        'review-status' => ($user->bReview_Status == 1)? "Good" : "Bad"
      );
      $newData[$i] = $arr;
      $i++;
    }
    return ($newData);
  }
}
