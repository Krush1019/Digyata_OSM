<?php

namespace App\Http\Controllers\client_user\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClientReviewController extends Controller
{
  public function __construct() {
    $this->middleware("auth:client");
}

    public function index(){

      $reviews = DB::table('tbl_review_orders')
                 ->join('tbl_user_manage as tum', 'tbl_review_orders.uID', '=', 'tum.id')
                 ->rightJoin('tbl_ser_list','tbl_review_orders.ser_id','=','tbl_ser_list.ser_id')
                 ->join('tbl_service_catalogs', 'tbl_ser_list.ser_cat_id', '=', 'tbl_service_catalogs.id')
                 ->where([['client_id','=',auth()->guard('client')->user()->id],['RoID','!=','null']])
                 ->paginate(10);
      $breadcrumbs = [['link' => "/client-dashboard", 'name' => "Dashboard"], ['name' => "Reviews"]];
      return view('/pages/client_user/client/client-review', [
        'breadcrumbs' => $breadcrumbs
      ])->with('reviews',$reviews);
    }
}
